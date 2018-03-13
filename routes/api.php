<?php

use EEvent\Event;
use EEvent\User;
use EEvent\Attendee;
use EEvent\Payment;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// all users json
Route::get('/users', function () {
    return User::all();
});

// user by id json
Route::get('/users/{id}', function ($id) {
    return User::find($id);
});


// all events json
Route::get('/events', function () {
    return Event::all();
});

// all events json
Route::get('/events/{id}', function ($id) {
    return Event::find($id);
});








Route::get('test/{id}', function($id){
	return Attendee::with('payment')->where('user_id', '=', $id)->where('event_id', '=', 4)->first()->payment->status;
});