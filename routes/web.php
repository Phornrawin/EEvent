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
//Route::get('/home', 'HomeController@index')->name('home');

// all authenticated route
Route::auth();

// all user and profile route
Route::get('/profile', 'UserController@profile')
    ->name('profile')
    ->middleware('auth');
Route::post('/profile', 'UserController@updateAvatar');

// all event crud route
Route::post('/events/attend', 'EventController@attend')
    ->name('events.attend')
    ->middleware('auth');

Route::post('/events/unattend', 'EventController@unAttend')
    ->name('events.unattend')
    ->middleware('auth');
Route::get('/search', 'EventController@search')
    ->name('events.search');

Route::resource('events', 'EventController');


Route::get('/category', function () {
    // to be implemented
    return redirect('/');
});




//all admin route
Route::get('/admin', function () {
    return redirect(route('users.index'));
});

Route::prefix('admin')->group(function () {
    Route::resource('users', 'Admin\UserController')->middleware('auth');
});

