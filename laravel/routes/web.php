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


Route::get('index5.html', 'Frontend\HomeController@index')->name('home');
Route::get('test.html', 'Frontend\HomeController@test')->name('test');
Route::post('setData', 'Frontend\HomeController@saveData')->name('setdata');
Route::get('checkData/{id?}', 'Frontend\HomeController@checkData')->name('checkData');
