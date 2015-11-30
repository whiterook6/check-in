<?php

Route::group(['prefix' => '/api/v1'], function(){
	Route::get(    '/projects/{project_id}/designs.{extension}', 'Checkin\Controllers\DesignController@index');
	Route::post(   '/projects/{project_id}/designs',             'Checkin\Controllers\DesignController@create');
	Route::get(    '/designs/{design_id}.{extension}',           'Checkin\Controllers\DesignController@read');
	Route::post(   '/designs/{design_id}',                       'Checkin\Controllers\DesignController@update');
	Route::delete( '/designs/{design_id}',                       'Checkin\Controllers\DesignController@delete');
});