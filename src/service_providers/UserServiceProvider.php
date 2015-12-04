<?php

namespace Checkin\Providers;

use Checkin\Controllers\UserController;
use Checkin\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class UserServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
			Route::get(    '/users.{extension?}',           'Checkin\Controllers\UserController@index');
			Route::post(   '/users',                        'Checkin\Controllers\UserController@create');
			Route::get(    '/users/{user_id}.{extension?}', 'Checkin\Controllers\UserController@read');
			Route::post(   '/users/{user_id}',              'Checkin\Controllers\UserController@update');
			Route::delete( '/users/{project_id}',           'Checkin\Controllers\UserController@delete');
		});

		Route::group(['prefix' => '/auth'], function(){
			Route::get( 'login',   'Checkin\Controllers\UserController@login');
			Route::post('login',   'Checkin\Controllers\UserController@login');
			Route::get( 'logout',  'Checkin\Controllers\UserController@logout');
			Route::post('logout',  'Checkin\Controllers\UserController@logout');
			Route::get( 'current', 'Checkin\Controllers\UserController@current');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\UserController', function () {
			return new UserController();
		});
	}
}