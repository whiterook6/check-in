<?php

Route::group(['prefix' => '/api/v1'], function(){
	Route::get(   '/projects.{extension}',              'Checkin\Controllers\ProjectController@index');
	Route::post(  '/projects',                          'Checkin\Controllers\ProjectController@create');
	Route::get(   '/projects/{project_id}.{extension}', 'Checkin\Controllers\ProjectController@read');
	Route::post(  '/projects/{project_id}',             'Checkin\Controllers\ProjectController@update');
	Route::delete('/projects/{project_id}',             'Checkin\Controllers\ProjectController@delete');
});