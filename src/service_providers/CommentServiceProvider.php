<?php

namespace Checkin\Providers;

use Checkin\Controllers\CommentController;
use Checkin\Models\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Route;

class CommentServiceProvider extends ServiceProvider {
	public function boot(){
		Route::group(['prefix' => '/api'], function(){
			Route::get(    '/comments/{requirement_id}.{extension?}', 'Checkin\Controllers\CommentController@read');
			Route::post(   '/comments/{requirement_id}',              'Checkin\Controllers\CommentController@update');
			Route::delete( '/comments/{requirement_id}',              'Checkin\Controllers\CommentController@delete');
		});

	}

	public function register(){
		$this->app->singleton('Checkin\Controllers\CommentController', function () {
			return new CommentController();
		});
	}
}