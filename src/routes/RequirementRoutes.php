<?php

Route::group(['prefix' => '/api/v1'], function(){
	Route::get(    '/projects/{project_id}/requirements.{extension}', 'Checkin\Controllers\ProjectController@index_requirements');
	Route::post(   '/projects/{project_id}/requirements',             'Checkin\Controllers\ProjectController@create_requirement');
	Route::get(    '/designs/{design_id}/requirements.{extension}',   'Checkin\Controllers\DesignController@index_requirements');
	Route::post(   '/designs/{design_id}/requirements',               'Checkin\Controllers\DesignController@create_requirement');
	Route::get(    '/requirements/{requirement_id}.{extension}',      'Checkin\Controllers\VersionController@read');
	Route::post(   '/requirements/{requirement_id}',                  'Checkin\Controllers\VersionController@update');
	Route::delete( '/requirements/{requirement_id}',                  'Checkin\Controllers\VersionController@delete');
});