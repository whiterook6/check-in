<?php

namespace Checkin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Checkin\Controllers\DesignController;

class DesignServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
			Route::get(   '/projects/{project_id}/designs.{extension}', 'Checkin\Controllers\DesignController@index');
			Route::post(  '/projects/{project_id}/designs',             'Checkin\Controllers\DesignController@create');
			Route::get(   '/designs/{design_id}.{extension}',           'Checkin\Controllers\DesignController@read');
			Route::post(  '/designs/{design_id}',                       'Checkin\Controllers\DesignController@update');
			Route::delete('/designs/{design_id}',                       'Checkin\Controllers\DesignController@delete');
		});

		Design::creating(function($design){
			$design['creator'] = Auth::user();
		});

		Design::updating(function($design){
			$design['updator'] = Auth::user();
		});

		Design::saving(function($design){
			$design['updator'] = Auth::user();
		});

		Design::deleting(function($design){
			$design['deletor'] = Auth::user();
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\DesignController', function () {
			return new DesignController();
		});
	}
}