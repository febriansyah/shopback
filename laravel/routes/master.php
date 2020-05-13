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

Route::prefix('master')->namespace('Master')->name('master.')->group(function() {



	// login
	Route::match(['get', 'post'], 'login', 'Auth\AuthController@login')
		->name('auth.login');
	// logout
	Route::get('logout', 'Auth\AuthController@logout')
		->name('auth.logout');

	// authenticated user
	Route::middleware('auth.master:backend')->group(function() {


		// dashboard
		Route::get('', 'DashboardController@index')
		->name('index');

		// users
		Route::prefix('users')->group(function() {
			Route::match(['get', 'post'], '', 'UserController@index')
				->name('user.index');
			Route::post('list_data', 'UserController@list_data')
				->name('user.list_data');
			Route::match(['get', 'post'], 'create', 'UserController@create')
				->name('user.create');
			Route::match(['get', 'post'], 'update/{id?}', 'UserController@update')
				->name('user.update');
			Route::delete('delete', 'UserController@delete')
				->name('user.delete');
			Route::post('delete_picture', 'UserController@deletePicture')
				->name('user.delete_picture');
		});

		// usersMenu
		Route::prefix('users_menu')->group(function() {
			Route::match(['get', 'post'], '', 'UserMenuController@index')
				->name('users_menu.index');
			Route::post('list_data', 'UserMenuController@list_data')
				->name('users_menu.list_data');
			Route::match(['get', 'post'], 'create', 'UserMenuController@create')
				->name('users_menu.create');
			Route::match(['get', 'post'], 'update/{id?}', 'UserMenuController@update')
				->name('users_menu.update');
			Route::delete('delete', 'UserMenuController@delete')
				->name('users_menu.delete');

		});
		// groups
		Route::prefix('groups')->group(function() {
			Route::match(['get', 'post'], '', 'GroupController@index')
				->name('groups.index');
			Route::post('list_data', 'GroupController@list_data')
				->name('groups.list_data');
			Route::match(['get', 'post'], 'create', 'GroupController@create')
				->name('groups.create');
			Route::match(['get', 'post'], 'update/{id?}', 'GroupController@update')
				->name('groups.update');
			Route::match(['get', 'post'], 'permissin/{id?}', 'GroupController@permission')
				->name('groups.permission');
			Route::delete('delete', 'GroupController@delete')
				->name('groups.delete');
		});
		// video
		Route::prefix('videos')->group(function() {
            Route::match(['get', 'post'], '', 'VideoController@index')
            ->name('video.index');
			Route::post('list_data/{id?}', 'VideoController@list_data')
				->name('video.list_data');
			Route::match(['get', 'post'], 'create/{id?}', 'VideoController@create')
				->name('video.create');
			Route::match(['get', 'post'], 'update/{id?}', 'VideoController@update')
				->name('video.update');
				Route::delete('delete', 'VideoController@delete')
				->name('video.delete');
				Route::delete('delete_picture', 'VideoController@deletePicture')
				->name('video.delete_picture');
                Route::get('testaja', 'VideoController@testVideo')
                ->name('video.test');

		});

	});
});
