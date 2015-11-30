<?php

Route::group(['prefix' => '/api/v1'], function(){
	Route::get(    '/designs/{design_id}/versions.{extension}', 'Checkin\Controllers\VersionController@index');
	Route::post(   '/designs/{design_id}/versions',             'Checkin\Controllers\VersionController@create');
	Route::get(    '/versions/{version_id}.{extension}',        'Checkin\Controllers\VersionController@read');
	Route::post(   '/versions/{version_id}',                    'Checkin\Controllers\VersionController@update');
	Route::delete( '/versions/{version_id}',                    'Checkin\Controllers\VersionController@delete');
});