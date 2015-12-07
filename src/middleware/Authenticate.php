<?php

namespace Checkin\Middleware;

use Auth;
use Illuminate\Http\Request;
use Checkin\Exceptions\UnauthenticatedException;
use Closure;

class Authenticate {

	public static function authenticate(Request $request){
		// user is not yet logged in.
		// is user supplying credentials?
		if (!$request->has('email') || !$request->has('password')){
			throw new UnauthenticatedException();
		}

		// if so, validate them
		$validator = \Validator::make($request->all(), [
			'email' => 'required|email', 'password' => 'required',
		]);

		if ($validator->fails()){ // if they don't validate, show those errors.
			throw new UnauthenticatedException();
		}

		// otherwise they do validate, but do these credentials match?
		$credentials = $request->only('email', 'password');

		if (!Auth::attempt($credentials, $request->has('remember'))){
			throw new UnauthenticatedException();
		}
	}

	public function handle(Request $request, Closure $next){
		if (!Auth::check()){
			self::authenticate($request);
		}

		return $next($request);
	}
}