<?php

namespace Checkin\Controllers;

use Checkin\Models\Design;
use Checkin\Models\Project;
use Illuminate\Http\Request;

class DesignController extends Controller {
	
	public function index($project_id){
		return Design::where('project_id', $project_id)->get();
	}

	public function create($project_id, Request $request){
		$project = Project::find($project_id);

		$design = new Design(self::filter_request($request, [
			'name', 'description'
		]));
		$project->designs()->save($design);

		return $design;
	}

	public function read($design_id){
		$design = Design::find($design_id);

		return $design;
	}

	public function update($design_id, Request $request){
		$design = Design::find($design_id);
		$design->fill(self::filter_request($request, [
			'name',
			'description'
		]));
		$design->save();
	}

	public function delete($design_id){
		Design::destroy($design_id);
	}

	public function index_comments(){}
	public function create_comment(){}
	public function index_requirements(){}
	public function create_requirements(){}
}
