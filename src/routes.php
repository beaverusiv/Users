<?php

Route::get('admin/users/browse', ['as' => 'users.adminBrowse', 'uses' => 'UsersController@adminBrowse']);
Route::get('admin/users/edit/{id}', ['as' => 'users.adminEdit', 'uses' => 'UsersController@adminEdit'])->where('id', '[0-9]+');
Route::post('admin/users/edit/{id}', ['as' => 'users.adminSave', 'uses' => 'UsersController@adminSave'])->where('id', '[0-9]+');
Route::post('admin/users/delete/{id}', ['as' => 'users.adminDelete', 'uses' => 'UsersController@adminDelete'])->where('id', '[0-9]+');
Route::get('admin/users/{id}', ['as' => 'users.adminView', 'uses' => 'UsersController@adminView'])->where('id', '[0-9]+');