<?php

namespace Checkin\Providers;

use Auth;
use Checkin\Controllers\ProjectController;
use Checkin\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class ProjectServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api'], function(){
			Route::get(    '/projects.{extension?}',                           'Checkin\Controllers\ProjectController@index');
			Route::post(   '/projects',                                        'Checkin\Controllers\ProjectController@create');
			Route::get(    '/projects/{project_id}.{extension?}',              'Checkin\Controllers\ProjectController@read');
			Route::post(   '/projects/{project_id}',                           'Checkin\Controllers\ProjectController@update');
			Route::delete( '/projects/{project_id}',                           'Checkin\Controllers\ProjectController@delete');
			Route::get(    '/projects/{project_id}/comments.{extension?}',     'Checkin\Controllers\ProjectController@index_comments');
			Route::post(   '/projects/{project_id}/comments',                  'Checkin\Controllers\ProjectController@create_comment');
			Route::get(    '/projects/{project_id}/requirements.{extension?}', 'Checkin\Controllers\ProjectController@index_requirements');
			Route::post(   '/projects/{project_id}/requirements',              'Checkin\Controllers\ProjectController@create_requirement');
		});
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\ProjectController', function () {
			return new ProjectController();
		});
	}
}