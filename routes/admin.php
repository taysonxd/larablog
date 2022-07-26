<?php

Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function() {

	Route::get('/', 'AdminController@index')->name('dashboard');

	Route::resource('posts', 'PostsController', ['except' => 'show']);
	Route::resource('users', 'UsersController', ['except' => 'edit']);
	Route::resource('roles', 'RolesController');

	Route::middleware('role:Admin')
			->put('users/{user}/roles', 'UserRolesController@update')
			->name('users.roles.update');
	Route::middleware('role:Admin')
			->put('users/{user}/permissions', 'UserPermissionsController@update')
			->name('users.permissions.update');

	Route::post('posts/{post}/photos', 'PhotosController@store')->name('posts.photo.store');
	Route::delete('photos/{photo}', 'PhotosController@destroy')->name('photos.destroy');
});
