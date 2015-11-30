<?php

Route::group(['prefix' => '/api/v1'], function(){
	Route::get(    '/projects/{project_id}/comments.{extension}', 'Checkin\Controllers\ProjectController@index_comments');
	Route::post(   '/projects/{project_id}/comments',             'Checkin\Controllers\ProjectController@create_comment');
	Route::get(    '/designs/{design_id}/comments.{extension}',   'Checkin\Controllers\DesignController@index_comments');
	Route::post(   '/designs/{design_id}/comments',               'Checkin\Controllers\DesignController@create_comment');
	Route::get(    '/versions/{version_id}/comments.{extension}', 'Checkin\Controllers\VersionController@index_comments');
	Route::post(   '/versions/{version_id}/comments',             'Checkin\Controllers\VersionController@create_comment');
	Route::get(    '/comments/{requirement_id}.{extension}',      'Checkin\Controllers\CommentController@read');
	Route::post(   '/comments/{requirement_id}',                  'Checkin\Controllers\CommentController@update');
	Route::delete( '/comments/{requirement_id}',                  'Checkin\Controllers\CommentController@delete');
});