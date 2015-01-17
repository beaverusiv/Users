<?php

Route::get('admin/users/browse', ['as' => 'users.adminBrowse', 'uses' => 'UsersController@adminBrowse']);
Route::get('admin/users/edit/{id}', ['as' => 'users.adminEdit', 'uses' => 'UsersController@adminEdit'])->where('id', '[0-9]+');
Route::post('admin/users/edit/{id}', ['as' => 'users.adminSave', 'uses' => 'UsersController@adminSave'])->where('id', '[0-9]+');
Route::post('admin/users/delete/{id}', ['as' => 'users.adminDelete', 'uses' => 'UsersController@adminDelete'])->where('id', '[0-9]+');
Route::get('admin/users/{id}', ['as' => 'users.adminView', 'uses' => 'UsersController@adminView'])->where('id', '[0-9]+');

Route::get('users/login', ['as' => 'users.loginForm', 'uses' => 'UsersController@loginForm']);
Route::post('users/login', ['as' => 'users.login', 'uses' => 'UsersController@login']);
Route::get('users/logout', ['as' => 'users.logout', 'uses' => 'UsersController@logout']);
Route::get('users/register', ['as' => 'users.registerForm', 'uses' => 'UsersController@registerForm']);
Route::post('users/register', ['as' => 'users.register', 'uses' => 'UsersController@register']);