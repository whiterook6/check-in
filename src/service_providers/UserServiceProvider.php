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

		// Version::creating(function($version){
		// 	$version['creator'] = Auth::user();
		// });

		// Version::updating(function($version){
		// 	$version['updator'] = Auth::user();
		// });

		// Version::saving(function($version){
		// 	$version['updator'] = Auth::user();
		// });

		// Version::deleting(function($version){
		// 	$version['deletor'] = Auth::user();
		// });
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\UserController', function () {
			return new UserController();
		});
	}
}