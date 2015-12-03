<?php

namespace Checkin\Controllers;

use Checkin\Models\Design;
use Checkin\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller {
	public function index($design_id){
		return Design::where('design_id', $design_id)->get();
	}

	public function read($version_id){
		$version = Design::find($version_id);

		return $version;
	}

	public function delete($version_id){
		Design::destroy($version_id);
	}

	public function index_comments(){}
	public function create_comment(){}
}
