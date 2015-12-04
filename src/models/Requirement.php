<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Checkin\Traits\Versionable;

class Requirement extends Model{
	use SoftDeletes, Versionable;

	protected $table = 'requirements';
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $fillable = ['name', 'description'];

	// Belongs to (Users in this case)
	public function completor(){ return $this->belongsTo('Checkin\Models\User', 'completed_by'); }

	// Polymorphism: Can be used for projects, designs, versions
	public function requirementable(){ return $this->morphTo(); }

	// Helper Functions
	public static function index_url($requirement_id){
		return Controller::API_ROOT."/requirements/{$requirement_id}";
	}
}
