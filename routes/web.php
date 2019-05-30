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


// Route::get('/app/{vue_capture?}', function () {
//     return view('vue');
//    })->where('vue_capture', '[\/\w\.-]*');

Route::get('/', function () {
    return view('vue');
});

Route::resource('/room_type', 'RoomTypeController');
Route::resource('/room', 'RoomController');
Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/manage', 'ManageController@index')->name('manage');
Route::resource('/reservation', 'ReservationController');
Auth::routes();