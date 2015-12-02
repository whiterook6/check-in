<?php

namespace Checkin\Controllers;

use Checking\Models\Project;

class ProjectController extends Controller {
	public function index(){
		return Project::get();
	}

	public function create(Request $request){
		$new_project = Project::create($this->filter_request($request, [
			'name', 'description'
		]));

		return $new_project;
	}

	public function read($project_id){
		$project = Project::find($project_id);

		return $project;
	}

	public function update($project_id, Request $request){
		$project = Project::find($project_id);
		
	}
	public function delete(){}
	public function index_comments(){}
	public function create_comment(){}
	public function index_requirements(){}
	public function create_requirements(){}
}
