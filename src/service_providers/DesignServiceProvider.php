<?php

namespace Checkin\Providers;

use Auth;
use Checkin\Controllers\DesignController;
use Checkin\Models\Design;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class DesignServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api', 'middleware' => 'auth'], function(){
			Route::get(    '/projects/{project_id}/designs.{extension?}',    'Checkin\Controllers\DesignController@index');
			Route::post(   '/projects/{project_id}/designs',                 'Checkin\Controllers\DesignController@create');
			Route::get(    '/designs/{design_id}.{extension?}',              'Checkin\Controllers\DesignController@read');
			Route::post(   '/designs/{design_id}',                           'Checkin\Controllers\DesignController@update');
			Route::delete( '/designs/{design_id}',                           'Checkin\Controllers\DesignController@delete');
			Route::get(    '/designs/{design_id}/comments.{extension?}',     'Checkin\Controllers\DesignController@index_comments');
			Route::post(   '/designs/{design_id}/comments',                  'Checkin\Controllers\DesignController@create_comment');
			Route::get(    '/designs/{design_id}/requirements.{extension?}', 'Checkin\Controllers\DesignController@index_requirements');
			Route::post(   '/designs/{design_id}/requirements',              'Checkin\Controllers\DesignController@create_requirement');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\DesignController', function () {
			return new DesignController();
		});
	}
}