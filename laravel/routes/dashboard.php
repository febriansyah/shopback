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

        Route::prefix('analitikshare')->group(function() {
            Route::post('getData', 'AnalitikShareController@getData')
            ->name('analitikshare.getData');
            Route::match(['get', 'post'], '{slug?}', 'AnalitikShareController@index')
            ->name('analitikshare.index');


        });
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
            Route::post('upload', 'VideoController@upload')
            ->name('video.upload');
            Route::match(['get', 'post'], 'detail/{id?}', 'VideoController@update')
            ->name('video.detail');
             Route::get('analitik/{id?}', 'VideoController@analitik')
             ->name('video.analitik');
            Route::match(['get', 'post'], 'delete/{id?}', 'VideoController@delete')
            ->name('video.delete');
        });
        Route::prefix('analitik')->group(function() {
            Route::post('getData', 'AnalitikController@getData')
            ->name('analitik.getData');
            Route::post('getViwer', 'AnalitikController@getViwer')
            ->name('analitik.getViwer');
            Route::post('getUniq', 'AnalitikController@getUniq')
            ->name('analitik.getUniq');
            Route::post('getVisitor', 'AnalitikController@getVisitor')
            ->name('analitik.getVisitor');
            Route::post('getAvg', 'AnalitikController@getData')
            ->name('analitik.getAvg');
            Route::post('getDataChart', 'AnalitikController@getDataChart')
            ->name('analitik.getDataChart');
            Route::post('sendemail', 'AnalitikController@sendEmail')
            ->name('analitik.sendemail');
            Route::post('sharelink', 'AnalitikController@shareUrl')
            ->name('analitik.sharelink');
            // Route::post('list', 'AnalitikController@list_data')
            // ->name('analitik.list');
            Route::match(['get', 'post'], '{id?}/{slug?}', 'AnalitikController@index')
            ->name('analitik.index');


        });
        Route::prefix('client')->group(function() {
            Route::get('list', 'ClientController@list_data')
            ->name('client.list');
            Route::get('detail/{id?}', 'ClientController@update')
             ->name('client.detail');
             Route::match(['get', 'post'], 'create', 'ClientController@create')
            ->name('client.create');
            Route::match(['get', 'post'], 'delete', 'ClientController@delete')
            ->name('client.delete');
            Route::post('update', 'ClientController@update')
            ->name('client.update');
        });

    });
});
