<?php

namespace Checkin\Traits;

use Checkin\Controllers\Controller;

trait Commentable {

	// Relations
	public function comments(){ return $this->morphMany('Checkin\Models\Comment', 'commentable'); }

	public function comments_url(){
		return $this->read_url().'/comments';
	}
}