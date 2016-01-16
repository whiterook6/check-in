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

	public static function query(array $options = null){
		$query = parent::query();

		if (!empty($options)){
			if (array_key_exists('order_by', $options) && !empty($options['order_by'])){
				$order_by = $options['order_by'];

				if (array_key_exists('order_direction', $options)){
					$order_direction = $options['order_direction'];
				} else {
					$order_direction = 'asc';
				}
				
				switch ($order_by){
					case 'name':
					case 'created_at':
						$query->orderBy($order_by, $order_direction);
						break;
					case 'updated_at':
						$query->orderBy($order_by, $order_direction);
						break;
					case 'created_by':
						$query->select('projects.*')
							->join('users', 'projects.created_by', '=', 'users.id')
							->orderBy('users.name', $order_direction);
				}
			}

			if (array_key_exists('filter', $options) && !empty($options['filter'])){
				$filter_text = $options['filter'];
				$query->where('name', 'like', "%{$filter_text}%");
			}
		}

		return $query;
	}
}
