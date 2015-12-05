<?php

namespace Checkin\Traits;

use Auth;
use Checkin\Controllers\Controller;

trait Versionable {

	// Relations
	public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
	public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
	public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }

	public static function bootVersionable(){
		self::creating(function($model){
			$model->created_by = Auth::user()->id;
		});

		self::updating(function($model){
			$model->updated_by = Auth::user()->id;
		});

		self::saving(function($model){
			$model->updated_by = Auth::user()->id;
		});

		self::deleting(function($model){
			$model->deleted_by = Auth::user()->id;

			// Since the model isn't loaded like normal here, we have to actually save it :|
			$model->save();
		});
	}

	public function creator_url(){
		return Controller::API_ROOT."/users/{$this->created_by}";
	}

	public function updator_url(){
		return Controller::API_ROOT."/users/{$this->updated_by}";
	}

	public function deletor_url(){
		return Controller::API_ROOT."/users/{$this->deleted_by}";
	}
}