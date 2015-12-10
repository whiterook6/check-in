<?php

namespace Checkin\Providers;

use Checkin\Controllers\AuthController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Route;

class AuthServiceProvider extends ServiceProvider {
	public function boot(Router $router){
		$router->middleware('auth.json', 'Checkin\Middleware\Authenticate');

		Route::group(['prefix' => '/auth'], function(){
			Route::get( 'login',  'Checkin\Controllers\AuthController@login');
			Route::post('login',  'Checkin\Controllers\AuthController@login');
			Route::get( 'logout', 'Checkin\Controllers\AuthController@logout');
			Route::post('logout', 'Checkin\Controllers\AuthController@logout');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\AuthController', function () {
			return new AuthController();
		});
	}
}