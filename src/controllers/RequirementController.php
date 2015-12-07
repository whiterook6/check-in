<?php

namespace Checkin\Controllers;

use Auth;
use Checkin\Models\Requirement;

class RequirementController extends Controller {
	public function read($requirement_id){
		return Requirement::find($requirement_id);
	}

	public function update($requirement_id, Request $request){
		$requirement = Requirement::find($requirement_id);
		$requirement->fill($this->filter_request($request, [
			'name',
			'description'
		]));
		$requirement->save();
	}

	public function complete(){
		$user = Auth::user();
		$requirement = Requirement::find($requirement_id);
		$requirement->completed_at = Carbon::now();
		$requirement->completed_by = $user->id;
		$requirement->save();
	}

	public function delete($requirement_id){
		Requirement::destroy($requirement_id);
	}
}
