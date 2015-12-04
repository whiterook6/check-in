<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Traits\Versionable;
use Checkin\Traits\Commentable;

class Version extends Model {
	use SoftDeletes, Versionable, Commentable;

	protected $table = 'versions';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['filename'];

	// Belongs to
	public function project(){ return $this->belongsTo('Checkin\Models\Design', 'design_id'); }

	// Helper Functions
	public function read_url(){
		return Controller::API_ROOT."/versions/{$this->id}";
	}

	public function design_url(){
		return Controller::API_ROOT."/designs/{$this->design_id}";
	}
}
