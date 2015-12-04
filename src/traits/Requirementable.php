<?php

namespace Checkin\Traits;

use Checkin\Controllers\Controller;

trait Requirementable {

	// Relations
	public function requirements(){ return $this->morphsMany('Checkin\Models\Requirement', 'requirementable'); }

	public function requirements_url(){
		return $this->read_url().'/requirements';
	}
}