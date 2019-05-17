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
Route::resource('/room_type', 'RoomTypeController');
Route::get('/vue/{vue_capture?}', function () {
    return view('vue');
   })->where('vue_capture', '[\/\w\.-]*');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
