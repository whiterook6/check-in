<?php

namespace Checking\Controllers;

class Controller extends App\Http\Controllers\Controller {
	public static $API_ROOT = "/api/v1";

	public static function filterRequest($request, $keys_to_keep) {
		return array_intersect_key($request->all(), array_fill_keys($keys_to_keep, null));
	}
}