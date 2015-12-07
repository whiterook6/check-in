<?php

namespace Checkin\Providers;

use Checkin\Controllers\UserController;
use Checkin\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class UserServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api', 'middleware' => 'auth'], function(){
			Route::get(    '/users.{extension?}',           'Checkin\Controllers\UserController@index');
			Route::post(   '/users',                        'Checkin\Controllers\UserController@create');
			Route::get(    '/users/{user_id}.{extension?}', 'Checkin\Controllers\UserController@read');
			Route::post(   '/users/{user_id}',              'Checkin\Controllers\UserController@update');
			Route::delete( '/users/{user_id}',              'Checkin\Controllers\UserController@delete');
			Route::get(    '/users/{user_id}/comments.{extension?}', 'Checkin\Controllers\UserController@comments');
			Route::get(    '/users/current',                'Checkin\Controllers\UserController@current');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\UserController', function () {
			return new UserController();
		});
	}
}