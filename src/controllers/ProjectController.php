<?php

namespace Checkin\Controllers;

use Checkin\Models\Project;
use Checkin\Models\Requirement;
use Checkin\Models\Comment;
use Illuminate\Http\Request;

class ProjectController extends Controller {
	public function index(){
		return Project::get();
	}

	public function create(Request $request){
		$new_project = Project::create(self::filter_request($request, [
			'name',
			'description'
		]));

		return $new_project;
	}

	public function read($project_id){
		$project = Project::find($project_id);

		return $project;
	}

	public function update($project_id, Request $request){
		$project = Project::find($project_id);
		$project->fill(self::filter_request($request, [
			'name',
			'description'
		]));
		$project->save();
	}

	public function delete($project_id){
		Project::destroy($project_id);
	}

	public function index_comments($project_id){
		$project = Project::find($project_id);
		return $project->comments;
	}

	public function create_comment($project_id, Request $request){
		$project = Project::find($project_id);
		$comment = new Comment(self::filter_request($request, [
			'body'
		]));

		$project->comments()->save($comment);
		return $comment;
	}

	public function index_requirements($project_id){
		$project = Project::find($project_id);
		return $project->requirements;
	}

	public function create_requirement($project_id, Request $request){
		$project = Project::find($project_id);
		$requirement = new Requirement(self::filter_request($request, [
			'name',
			'description'
		]));

		$project->requirements()->save($requirement);
		return $requirement;
	}
}
