<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Project;
use App\Rules\ArrayAtLeastOneRequired;
use Illuminate\Http\Request;

class ProjectController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		return view("project.index")->with([
			"projects" => Project::paginate(10)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		return view("project.create")->with(["statuses" => Project::getPossibleStatuses()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$statuses = "";
		foreach (Project::$statuses as $status => $val) {
			$statuses .= $status . ",";
		}

		$data = $request->validate([
			"name"             => "required",
			"description"      => "required",
			"status"           => "in:$statuses",
			"contacts"         => "required|min:1",
			"contacts.*.name"  => "string",
			"contacts.*.email" => "email|unique:users"
		]);

		$project = new Project();
		$project->name = $data["name"];
		$project->description = $data["description"];
		$project->status = $data["status"];

		$project->save();

		foreach ($data["contacts"] as $contact) {
			$contactModel = new Contact();

			$contactModel->name = $contact["name"];
			$contactModel->email = $contact["email"];
			$contactModel->project_id = $project->id;

			$contactModel->save();
		}

		return redirect(route("index"));


	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Project $project
	 * @return \Illuminate\Http\Response
	 */
	public function show($projectId) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Project $project
	 * @return \Illuminate\Http\Response
	 */
	public function edit($projectId) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Project $project
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $projectId) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Project $project
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($projectId) {
		//
	}
}
