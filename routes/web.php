<?php

use App\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index')->name('users.index');

Route::get('posts/{post}/edit', function(Post $post){
	return 'Edit the post ' . $post->title;
});


Route::get('post/{post?}', function (Post $post = null){
	dd($post);
});

Route::get('/usuarios/{user}', 'UserController@show')
	->where('user', '\d+')->name('users.show');


Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');




Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');

Route::get('usuarios/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');