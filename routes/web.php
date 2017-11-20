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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();



Route::post('/home', 'PostController@create')->name('create_post');

Route::get('/user/{user_id}',  'UserController@show')->name('show_user');
Route::post('/user/{user_id}', 'UserController@update')->name('update_user');
Route::post('/users/index',     'UserController@index')->name('filter_users');

Route::post('/user/interest/{user_id}', 'InterestController@create')->name('create_interest');
Route::get('/user/interest/{interest_id}/{user_id}', 'InterestController@delete')->name('delete_interest');


