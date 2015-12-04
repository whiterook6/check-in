<?php

namespace Checkin\Providers;

use Auth;
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
			Route::post(   '/versions/{version_id}/approve',              'Checkin\Controllers\VersionController@approve');
			Route::post(   '/versions/{version_id}/reject',               'Checkin\Controllers\VersionController@reject');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\VersionController', function () {
			return new VersionController();
		});
	}
}