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
    $recent = Event::with(['category', 'organizer'])->orderBy('created_at', 'desc')->limit(6)->get();
    $popular = Event::with(['category', 'organizer'])->orderBy('cur_capacity', 'desc')->limit(3)->get();
    return view('welcome', ['recent' => $recent, 'popular' => $popular]);
});
Route::view('/about', 'home.about')->name('about');

// all authenticated route
Route::auth();

// all user and profile route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/profile/update/bio', 'ProfileController@editBio')
        ->name('profile.edit.bio');
    Route::post('/profile/update/bio', 'ProfileController@updateBio')
        ->name('profile.update.bio');
    Route::post('/profile/update/avatar', 'ProfileController@updateAvatar')
        ->name('profile.update.avatar');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkin/{event}', 'AttendeeController@checkIn');
    Route::get('/organizer/accept', 'AttendeeController@changeStatus')->name('attendee.accept');


    Route::post('/events/attend/{id}', 'EventController@attend')
        ->name('events.attend');

    Route::post('/events/unattend/{id}', 'EventController@unAttend')
        ->name('events.unattend');


});

// all event crud route
Route::get('/search', 'EventController@search')->name('events.search');
Route::get('/category/{q}', 'EventController@searchCat')->name('events.category');
Route::get('/events/create', function () {
    return view('events.create');
})->middleware('auth');

Route::resource('events', 'EventController');

// Admin route
Route::get('/admin', function () {
    return redirect()->route('admin.users.index');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('users', 'Admin\UserController');
    Route::resource('events', 'Admin\EventController');
});

Route::get('test', function () {
    return Hash::check('eiei', Auth::user()->makeVisible('password')->password);
});


