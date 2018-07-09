<?php

Route::get('/', 'PostsController@index');
Route::get('/blog', 'PostsController@posts');
Route::get('/blog/create', 'PostsController@create');
Route::get('blog/{post}', 'PostsController@show');
Route::get('blog/{id}/edit', 'PostsController@edit');
Route::get('blog/user/{user}', 'PostsController@user');

Route::post('/blog/create', 'PostsController@store');
Route::put('/blog/{id}/edit', 'PostsController@update');
Route::delete('/posts/{id}/destroy', 'PostsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
