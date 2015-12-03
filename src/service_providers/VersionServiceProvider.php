<?php

namespace Checkin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Checkin\Controllers\DesignController;

class DesignServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
			Route::get(    '/designs/{design_id}/versions.{extension}', 'Checkin\Controllers\VersionController@index');
			Route::post(   '/designs/{design_id}/versions',             'Checkin\Controllers\VersionController@create');
			Route::get(    '/versions/{version_id}.{extension}',        'Checkin\Controllers\VersionController@read');
			Route::post(   '/versions/{version_id}',                    'Checkin\Controllers\VersionController@update');
			Route::delete( '/versions/{version_id}',                    'Checkin\Controllers\VersionController@delete');
		});

		Version::creating(function($version){
			$version['creator'] = Auth::user();
		});

		Version::updating(function($version){
			$version['updator'] = Auth::user();
		});

		Version::saving(function($version){
			$version['updator'] = Auth::user();
		});

		Version::deleting(function($version){
			$version['deletor'] = Auth::user();
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\VersionController', function () {
			return new VersionController();
		});
	}
}