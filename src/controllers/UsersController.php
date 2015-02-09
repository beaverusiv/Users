<?php namespace Bocapa\Users\Controllers;

use Illuminate\Routing\Controller;
use Bocapa\Permissions\Models\Group;

class UsersController extends Controller {

    public function adminBrowse()
    {
        return View::make('users::users/admin_browse')->with(['users' => User::paginate(3)]);
    }

    public function adminEdit($id)
    {
        if(0 == $id) {
            $user = User::create([]);
        } else {
            $user = User::findOrFail($id);
        }

        // TODO: more efficient way with array_map?
        // TODO: Should be within group model?
        $group_models = Group::all()->toArray();
        $groups = [];
        foreach($group_models as $group) {
            $groups[$group['id']] = $group['name'];
        }
        $user_groups = $user->groups()->get()->toArray();
        foreach($user_groups as $group) {
            $selected_groups[] = $group['id'];
        }

        return View::make('users::users/admin_edit')
            ->with(compact('user'))
            ->with(compact('groups'))
            ->with(compact('selected_groups'));
    }

    public function adminSave($id)
    {
        if(0 == $id) {
            $user = User::create([]);
        } else {
            $user = User::findOrFail($id);
        }

        $user->fill(Input::except('groups'))->save();
        $id = $user->id;

        foreach(Input::get('groups') as $group_id) {
            $group = Group::find($group_id);
            if(!$user->groups->contains($group_id)) {
                $user->groups()->save($group);
            }
        }

        return Redirect::route('users.adminEdit', ['id' => $id]);
    }

    public function adminDelete($id)
    {
        return 'delete';
    }

    public function loginForm()
    {
        return View::make('users::users/login');
    }

    public function login()
    {
        $attempt = Auth::attempt([
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ]);

        if($attempt) {
            // Redirect admin to /admin and others to /profile
            // TODO: Put in the right routes
            $redirect_route = Auth::user()->groups()->find(Config::get('permissions::admin_id')) ? 'groups.adminBrowse' : 'default.route';
            return Redirect::intended(route(Auth::user()->home_route));
        }

        return Redirect::route('users.loginForm')->withInput();
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

    public function registerForm()
    {
        return View::make('users::users/register');
    }

    public function register()
    {
        // TODO: Form validation
        $user = User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password'))
        ]);

        $default_group = Group::find(Config::get('permissions::default_id'));
        $registered_group = Group::find(Config::get('permissions::registered_id'));

        $user->groups()->save($default_group);
        $user->groups()->save($registered_group);

        $user->home_route = $registered_group->home_route;

        // TODO: duplicated logic, unify login?
        Auth::attempt([
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ]);

        return Redirect::intended(route($user->home_route));
    }
}