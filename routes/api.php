<?php

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
Route::get('/pelumi', function(Request $request) {
    return "hello world";
});
Route::post('/signup', 'SignupController@store');
Route::get('/rooms', 'RoomTypeController@showRoomListing');
Route::get('/rooms/{id}', 'RoomTypeController@showRoomListing');
Route::resource('/reservation', 'ReservationController');