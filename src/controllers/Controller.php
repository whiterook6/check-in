<?php

namespace Checkin\Controllers;

use Auth;
use Checkin\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Validator;

class Controller extends \App\Http\Controllers\Controller {
	public static $API_ROOT = "/api/v1";

	public static function filter_request($request, $keys_to_keep) {
		return array_intersect_key($request->all(), array_fill_keys($keys_to_keep, null));
	}

	public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = []){
		$validator = \Validator::make($request->all(), $rules);

		if ($validator->fails()){
			throw new ValidationException($validator);
		}
	}
}