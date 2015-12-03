<?php

namespace Checkin\Providers;

use Checkin\Controllers\RequirementController;
use Checkin\Models\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class RequirementServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
			Route::get(    '/requirements/{requirement_id}.{extension?}', 'Checkin\Controllers\RequirementController@read');
			Route::post(   '/requirements/{requirement_id}',              'Checkin\Controllers\RequirementController@update');
			Route::delete( '/requirements/{requirement_id}',              'Checkin\Controllers\RequirementController@delete');
		});

	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\RequirementController', function () {
			return new RequirementController();
		});
	}
}