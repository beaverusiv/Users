<?php

use Illuminate\Routing\Controller;
use Bocapa\Permissions\Models\Group;

class UsersController extends Controller {

    public function adminBrowse()
    {
        return View::make('users::users/admin_browse')->with(['users' => User::all()]);
    }

    public function adminEdit($id)
    {
        return 'edit';
    }

    public function adminSave($id)
    {
        return Redirect::route('groups.adminEdit', ['id' => $id]);
    }

    public function adminDelete($id)
    {
        return Redirect::route('groups.adminBrowse');
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
            return Redirect::intended(route($redirect_route));
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

        // TODO: duplicated logic, unify login?
        Auth::attempt([
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ]);

        return Redirect::intended('/');
    }
}