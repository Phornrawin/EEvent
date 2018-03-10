<?php

use EEvent\Event;

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
    $recent = Event::orderBy('created_at', 'desc')->limit(6)->get();
    $popular = Event::orderBy('cur_capacity', 'desc')->limit(6)->get();
    return view('welcome', ['recent' => $recent, 'popular' => $popular]);
});
Route::view('/about', 'home.about');

// all authenticated route
Route::auth();

// all user and profile route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/update/avatar', 'ProfileController@updateAvatar')
        ->name('profile.update.avatar');
});


Route::group(['middleware' => 'auth'], function () {
    Route::post('/events/attend/{id}', 'EventController@attend')
        ->name('events.attend');

    Route::post('/events/unattend/{id}', 'EventController@unAttend')
        ->name('events.unattend');
});
// all event crud route


Route::get('/search', 'EventController@search')->name('events.search');
Route::get('/category')->name('events.category');

Route::resource('events', 'EventController');

// Admin route
Route::get('/admin', function () {
   return redirect()->route('admin.users.index');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('users', 'Admin\UserController');
    Route::resource('events', 'Admin\EventController');
});


