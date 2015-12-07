<?php

namespace Checkin\Controllers;

use Auth;
use Checkin\Models\User;
use Checkin\Middleware\Authenticate;
use Illuminate\Http\Request;

class AuthController extends Controller {
	public function login(Request $request){
		$this->logout();

		Authenticate::authenticate($request);
	}

	public function logout(){
		Auth::logout();
	}
}
