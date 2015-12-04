<?php

namespace Checkin\Controllers;

use Auth;
use Checkin\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
	public function index(){
		return User::get();
	}

	public function create(Request $request){
		$input = self::filter_request($request, [
			'name',
			'email',
			'password'
		]);

		$new_user = User::create([
			'name' => $input['name'],
			'email' => $input['email'],
			'password' => bcrypt($input['password']),
		]);

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
			'email'
		]));
		$user->save();
	}

	public function delete($user_id){
		User::destroy($user_id);
	}

	public function login(Request $request){
		$email = $request->input('email');
		$password = $request->input('password');

		if (Auth::attempt([
			'email' => $email,
			'password' => $password
		])){
			return Auth::user();
		} else {
			return [];
		}
	}

	public function logout(){
		Auth::logout();
	}

	public function current(){
		return Auth::user();
	}
}
