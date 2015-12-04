<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Traits\Versionable;
use Checkin\Traits\Commentable;
use Checkin\Traits\Requirementable;

class Design extends Model {
	use SoftDeletes, Versionable, Commentable, Requirementable;

	protected $table = 'designs';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description'];

	// Relations
	public function project(){  return $this->belongsTo('Checkin\Models\Project', 'project_id'); }
	public function versions(){ return $this->hasMany('Checkin\Models\Version',   'design_id'); }

	// Helper Functions
	public function read_url(){
		return Controller::API_ROOT."/designs/{$this->id}";
	}

	public function project_url(){
		return Controller::API_ROOT."/project/{$this->project_id}";
	}
}