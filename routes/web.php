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
Route::get('/users/{user}', 'UserController@show')->name('user.show');

Route::post('/user/find', 'UserController@find');

Route::get('/user/delete/{user_id}', 'UserController@delete');

Route::get('/user/random', 'UserController@random');


// Admin 
Route::get('/admin', 'AdminController@index');

Route::post('/admin/block', 'AdminController@block');

Route::post('/admin/clear', 'AdminController@clear');


// Post
Route::get('/post/create', 'PostController@show')->name('home')->middleware('auth', 'block');

Route::get('/posts', 'PostController@index')->name('posts.index');

Route::post('/post/save', 'PostController@store');

Route::post('/post/list/{page}', 'PostController@list');

Route::get('/users/follow/{id}', 'UserController@follow');

Route::get('/users/unfollow/{id}', 'UserController@unfollow');

Route::get('/post/edit/{post_id}', 'PostController@edit')->middleware('block');

Route::post('/post/update', 'PostController@update');

Route::get('/post/delete/{post_id}', 'PostController@delete')->middleware('block');

Route::get('/post/read/{post_id}', 'PostController@read');

Route::post('/post/find', 'PostController@find');

Route::get('/post/random', 'PostController@random');


// follow

Route::post('/following/list', 'UserController@followingList');

Route::get('/followers/list', 'UserController@followersList');

Route::post('/can/follow', 'UserController@canFollow');

Route::get('/follow', 'UserController@followDis')->name('follow');


// Chat

// Route::get('/chat', 'ChatController@index');
