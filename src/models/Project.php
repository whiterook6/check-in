<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Traits\Versionable;
use Checkin\Traits\Commentable;
use Checkin\Traits\Requirementable;

class Project extends Model {
	use SoftDeletes, Versionable, Commentable, Requirementable;

	protected $table = 'projects';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description'];

	// Relationships
	public function designs(){ return $this->hasMany('Checkin\Models\Design', 'project_id'); }

	// Helper Functions
	public static function index_url(){
		return Controller::API_ROOT.'/projects';
	}

	public function read_url(){
		return self::index_url()."/{$this->id}";
	}

	public function designs_url(){
		return $this->read_url().'/designs';
	}
}
