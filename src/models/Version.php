<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model {
	use SoftDeletes;

	protected $table = 'versions';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['filename', 'design_id', 'created_by', 'updated_by', 'deleted_by'];

	// Belongs to (Users in this case)
	public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
	public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
	public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }

	// Has Many Comments, which are polymorphic
	public function comments(){     return $this->morphsMany('Checkin\Models\Comment',     'commentable'); }

	// Helper Functions
	public static function url($version_id){
		return Controller::API_ROOT."/versions/{$version_id}";
	}

	public static function comments_url($version_id){
		return self::url($version_id)."/comments";
	}
}
