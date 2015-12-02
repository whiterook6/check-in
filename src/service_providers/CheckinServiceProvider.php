<?php

namespace Checkin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider {
	public function boot(){
		Model::creating(function($model){
			$model->creator = Auth::user();
		});
		Model::updating(function($model){
			$model->updator = Auth::user();
		});
		Model::deleting(function($model){
			$model->deletor = Auth::user();
		});
	}

	public function register(){}
}