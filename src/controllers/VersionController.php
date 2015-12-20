<?php

namespace Checkin\Controllers;

use Checkin\Models\Design;
use Checkin\Models\Version;
use Flow\Config as FlowConfig;
use Flow\File as FlowFile;
use Illuminate\Http\Request;

class VersionController extends Controller {
	public function index($design_id){
		return Version::where('design_id', $design_id)->get();
	}

	/**
	 * Handles uploading of chunks. See Github flow.js for workflow
	 *
	 * @param Request A request containing the following:
	 * 	flowChunkNumber: The index of the chunk in the current upload. First chunk is 1 (no base-0 counting here).
	 * 	flowTotalChunks: The total number of chunks.
	 * 	flowChunkSize: The general chunk size. Using this value and flowTotalSize you can calculate the total number of chunks. Please note that the size of the data received in the HTTP might be lower than flowChunkSize of this for the last chunk for a file.
	 * 	flowTotalSize: The total file size.
	 * 	flowIdentifier: A unique identifier for the file contained in the request.
	 * 	flowFilename: The original file name (since a bug in Firefox results in the file name not being transmitted in chunk multipart posts).
	 * 	flowRelativePath: The file's relative path when selecting a directory (defaults to file name in all browsers except Chrome).
	 */
	public function create($design_id, Request $request){ // http://github.com/flowjs/flow.js
		// $config = new FlowConfig();
		// $config->setTempDir(storage_path().'/temp');
		// $file = new FlowFile($config);

		// if (!$file->validateChunk()){
		// 	return response(json_encode($_FILES), 400);
		// }

		// $file->saveChunk();

		// if ($file->validateFile()){
		// 	$extension = pathinfo($request->input('flowFilename'))['extension'];
		// 	$filename = uniqid().$extension;
		// 	$file->save(storage_path().'/versions/'.$filename);

		// 	$version = Version::create([
		// 		'design_id' => $design_id,
		// 		'filename' => $filename
		// 	]);
		// 	return response($version, 201);
		// } else {
		// 	return response(null, 200);
		// }
		return response(json_encode($_FILES), 200);
	}

	public function read($version_id){
		$version = Version::find($version_id);

		return $version;
	}

	public function delete($version_id){
		Version::destroy($version_id);
	}
}
