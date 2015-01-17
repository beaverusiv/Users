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
            // TODO: Change code to use config group IDs for greater performance.
            // TODO: Redirect admin to /admin and others to /profile
            //$redirect_route = Auth::user()->groups()->contain
            return Redirect::intended('/');
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
        $user = User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password'))
        ]);

        $default_group = Group::where('name', '=', 'Default')->first();
        $registered_group = Group::where('name', '=', 'Registered')->first();

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