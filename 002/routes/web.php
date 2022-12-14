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

Route::get('/', 'UserController@index')->name('users.index');

Auth::routes();

// 後台
Route::resource('posts', 'PostController');
// 前台
Route::get('users/{user}/posts', 'UserController@posts')->name('users.posts.index');
Route::get('users/{user}/posts/{post}', 'UserController@post')->name('users.posts.show');
