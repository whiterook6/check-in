<?php

namespace Checkin\Controllers;

use Checkin\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
	public function index(){
		return User::get();
	}

	public function create(Request $request){
		$new_user = User::create(self::filter_request($request, [
			'name',
			'email'
		]));

		return $new_user;
	}

	public function read($user_id){
		$user = User::find($user_id);

		return $user;
	}

	public function update($user_id, Request $request){
		$user = User::find($user_id);
		$user->fill(self::filter_request($request, [
			'name',
			'description'
		]));
		$user->save();
	}

	public function delete($user_id){
		User::destroy($user_id);
	}
}
