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

Route::view('/', 'welcome');
Route::resource('events', 'EventController');
Route::auth();

Route::get('/profile', 'UserController@profile')->name('profile');
Route::post('/profile', 'UserController@updateAvatar');
Route::get('/home', 'HomeController@index')->name('home');
