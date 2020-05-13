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

Route::prefix('cms')->namespace('Dashboard')->name('dashboard.')->group(function() {



	// login
	Route::match(['get', 'post'], 'login', 'Auth\AuthController@login')
		->name('auth.login');
	// logout
	Route::get('logout', 'Auth\AuthController@logout')
        ->name('auth.logout');

    	// logout
        Route::match(['get', 'post'], 'register', 'Auth\AuthController@signup')
		->name('auth.register');
        // dashboard
        // authenticated user
	Route::middleware('auth.dashboard:dashboard')->group(function() {
        // dd('masuk ya');
        Route::get('', 'DashboardController@index')
        ->name('index');
        Route::prefix('users')->group(function() {
            Route::match(['get', 'post'], 'profile', 'UserController@index')
            ->name('users.profile');

            Route::match(['get', 'post'], 'change_password', 'UserController@change_password')
            ->name('users.change_password');
        });
        Route::prefix('video')->group(function() {
            Route::match(['get', 'post'], '', 'VideoController@index')
            ->name('video.index');
            Route::match(['get', 'post'], 'create', 'VideoController@create')
            ->name('video.create');
            Route::post('list', 'VideoController@list_data')
            ->name('video.list');
            Route::get('detail/{id?}', 'VideoController@update')
             ->name('video.detail');
             Route::get('analitik/{id?}', 'VideoController@analitik')
             ->name('video.analitik');
            Route::match(['get', 'post'], 'delete/{id?}', 'VideoController@delete')
            ->name('video.delete');
        });

    });
});
