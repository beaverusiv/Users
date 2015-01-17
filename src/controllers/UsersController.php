<?php

use Illuminate\Routing\Controller;

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

    public function login()
    {
        return Redirect::to('/');
    }

    public function logout()
    {
        return Redirect::to('/');
    }

    public function register()
    {
        return Redirect::to('/');
    }
}