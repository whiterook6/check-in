<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends Model {
	use SoftDeletes;

    protected $table = 'projects';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'description', 'project_id', 'created_by', 'updated_by', 'deleted_by'];

    // Belongs to
    public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
    public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
    public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }
    public function project(){ return $this->belongsTo('Checkin\Models\Project', 'project_id'); }

    // Has Many Designs
    public function versions(){ return $this->hasMany('Checkin\Models\Version', 'design_id'); }

    // Has Many Requirements and Comments, which are polymorphic
    public function requirements(){ return $this->morphsMany('Checkin\Models\Requirement', 'requirementable'); }
    public function comments(){     return $this->morphsMany('Checkin\Models\Comment',     'commentable'); }
}