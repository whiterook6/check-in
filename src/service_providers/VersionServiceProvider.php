<?php

namespace Checkin\Providers;

use Checkin\Controllers\VersionController;
use Checkin\Models\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class VersionServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
			Route::get(    '/designs/{design_id}/versions.{extension?}',  'Checkin\Controllers\VersionController@index');
			Route::get(    '/versions/{version_id}.{extension?}',         'Checkin\Controllers\VersionController@read');
			Route::delete( '/versions/{version_id}',                      'Checkin\Controllers\VersionController@delete');
			Route::get(    '/versions/{version_id}/comments.{extension}', 'Checkin\Controllers\VersionController@index_comments');
			Route::post(   '/versions/{version_id}/comments',             'Checkin\Controllers\VersionController@create_comment');
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
		$this->app->singleton('Checkin\Controllers\VersionController', function () {
			return new VersionController();
		});
	}
}