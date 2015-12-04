<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {
	use SoftDeletes;

	protected $table = 'projects';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description', 'created_by', 'updated_by', 'deleted_by'];

	// Belongs to (Users in this case)
	public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
	public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
	public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }

	// Has Many Designs
	public function designs(){ return $this->hasMany('Checkin\Models\Design', 'project_id'); }

	// Has Many Requirements and Comments, which are polymorphic
	public function requirements(){ return $this->morphMany('Checkin\Models\Requirement', 'requirementable'); }
	public function comments(){     return $this->morphMany('Checkin\Models\Comment',     'commentable'); }

	// Helper Functions
	public static function index_url(){
		return Controller::API_ROOT.'/projects';
	}
	public static function read_url($project_id){
		return self::index_url()."/{$project_id}";
	}

	public static function requirements_url($project_id){
		return self::read_url($project_id)."/requirements";
	}

	public static function comments_url($project_id){
		return self::read_url($project_id)."/comments";
	}
}
