<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User
Route::get('users/{user}', 'UserController@show')->name('user.show');


// Post
Route::get('/post/create', 'PostController@show')->name('home')->middleware('auth');

Route::get('/posts', 'PostController@index')->name('posts.index');

Route::post('/post/save', 'PostController@store');

Route::post('/post/list/{page}', 'PostController@list');

Route::get('/users/follow/{id}', 'UserController@follow');

Route::get('/users/unfollow/{id}', 'UserController@unfollow');

Route::get('/post/edit/{post_id}', 'PostController@edit');

Route::post('/post/update', 'PostController@update');

Route::get('/post/delete/{post_id}', 'PostController@delete');

// follow

Route::post('/following/list', 'UserController@followingList');

Route::post('/can/follow', 'UserController@canFollow');
