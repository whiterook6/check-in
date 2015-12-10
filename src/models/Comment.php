<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Controllers\Controller;
use Checkin\Traits\Versionable;

class Comment extends Model {
	use SoftDeletes, Versionable;

	protected $table = 'comments';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['body'];

	// Polymorphism: Can belong to Projects, Versions, and Designs
	public function commentable(){ return $this->morphTo(); }

	// Helper Functions
	public function read_url(){
		return Controller::API_ROOT."/comments/{$this->id}";
	}
}
