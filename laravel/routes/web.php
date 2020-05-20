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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('shopback.html', 'Frontend\HomeController@index')->name('home');
Route::get('index5.html', 'Frontend\HomeController@index')->name('home');
Route::get('test.html', 'Frontend\HomeController@test')->name('test');
Route::get('analitik.html', 'Frontend\HomeController@analitik')->name('analitik');
Route::post('setData', 'Frontend\HomeController@saveData')->name('setdata');
Route::post('checkData', 'Frontend\HomeController@checkData')->name('checkData');
