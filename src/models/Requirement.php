<?php

namespace Checkin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model{
    use SoftDeletes;

    protected $table = 'requirements';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'name', 'description', 'created_by', 'updated_by', 'completed_by', 'deleted_by'];

    // Belongs to (Users in this case)
    public function creator(){ return $this->belongsTo('Checkin\Models\User', 'created_by'); }
    public function updator(){ return $this->belongsTo('Checkin\Models\User', 'updated_by'); }
    public function completor(){ return $this->belongsTo('Checkin\Models\User', 'completed_by'); }
    public function deletor(){ return $this->belongsTo('Checkin\Models\User', 'deleted_by'); }

    // Polymorphism: Can be used for projects, designs, versions
    public function requirementable(){ return $this->morphTo(); }
}
