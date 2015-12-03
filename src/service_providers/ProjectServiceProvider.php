<?php

namespace Checkin\Providers;

use Checkin\Controllers\ProjectController;
use Checkin\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class ProjectServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api/v1'], function(){
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

		// Project::creating(function($project){
		// 	$project['creator'] = Auth::user();
		// });

		// Project::updating(function($project){
		// 	$project['updator'] = Auth::user();
		// });

		// Project::saving(function($project){
		// 	$project['updator'] = Auth::user();
		// });

		// Project::deleting(function($project){
		// 	$project['deletor'] = Auth::user();
		// });
	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\ProjectController', function () {
			return new ProjectController();
		});
	}
}