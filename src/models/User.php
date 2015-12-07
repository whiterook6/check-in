<?php

namespace Checkin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function comments(){
    	return $this->hasMany('Checkin\Models\Comment');
    }

    // Helper Functions
	public static function index_url(){
		return Controller::API_ROOT.'/users';
	}

	public function read_url(){
		return self::index_url()."/{$this->id}";
	}

	public function comments_url(){
		return $this::read_url()."/comments";
	}
}
