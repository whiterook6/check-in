<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Controllers\Controller;

class Comment extends Model {
	use SoftDeletes;

	protected $table = 'comments';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['body', 'created_by', 'updated_by', 'deleted_by'];

	// Belongs to (Users in this case)
	public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
	public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
	public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }

	// Polymorphism: Can belong to Projects, Versions, and Designs
	public function commentable(){ return $this->morphTo(); }

	// Helper Functions
	public static function url($comment_id){
		return Controller::API_ROOT."/comments/{$comment_id}";
	}
}
