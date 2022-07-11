<?php

Route::middleware('auth')
->namespace('Admin')
->name('admin')
->prefix('admin')
->group(function() {

	Route::get('/', 'AdminController@index')->name('.dashboard');

	Route::get('posts', 'PostsController@index')->name('.posts.index');
	Route::get('posts/create', 'PostsController@create')->name('.posts.create');
	Route::post('posts', 'PostsController@store')->name('.posts.store');
	Route::get('posts/edit/{post}', 'PostsController@edit')->name('.posts.edit');
	Route::put('posts/update/{post}', 'PostsController@update')->name('.posts.update');
	Route::delete('posts/delete/{post}', 'PostsController@destroy')->name('.posts.destroy');

	Route::post('posts/{post}/photos', 'PhotosController@store')->name('.posts.photo.store');

	Route::delete('photos/{photo}', 'PhotosController@destroy')->name('.photos.destroy');
});
