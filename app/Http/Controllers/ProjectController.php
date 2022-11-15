<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index() {
		//
		return view("project.index")->with([
			"projects" => Project::with("contacts")->paginate(10)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create() {
		//
		return view("project.create")->with([
			"statuses"          => Project::getPossibleStatuses(),
			"possible_contacts" => User::all()->except(Auth::id())
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request) {

		$statuses = "";
		foreach (Project::$statuses as $status => $val) {
			$statuses .= $status . ",";
		}

		$data = $request->validate([
			"name"        => "required",
			"description" => "required",
			"status"      => "in:$statuses",
			"contact"     => "required|array",
			"contact.*"   => "int"
		]);

		$project = new Project();
		$project->name = $data["name"];
		$project->description = $data["description"];
		$project->status = $data["status"];
		$project->owner_id = Auth::user()->id;

		$project->save();

		foreach ($data["contact"] as $contact) {
			$project->contacts()->attach($contact);
		}

//		TODO: make contact selectable from users on server
		//TODO: save project owner

		/*foreach ($data["contacts"] as $contact) {
			$contactModel = new Contact();

			$contactModel->name = $contact["name"];
			$contactModel->email = $contact["email"];
			$contactModel->project_id = $project->id;

			$contactModel->save();
		}*/

		return redirect(route("index"));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param $projectId
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($projectId) {
		$project = Project::find($projectId);
		if (!$project)
			return redirect(route("index"))->with([
				"error" => "Nem található projekt."
			]);
		return view("project.show")->with([
			"project" => $project
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $projectId
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function edit($projectId) {
		$project = Project::find($projectId);

		$contactIDs = [];
		foreach ($project->contacts as $contact) {
			$contactIDs[] = $contact->id;
		}

		if (!$project)
			return redirect(route("index"))->with([
				"error" => "Nem található projekt."
			]);

		return view("project.edit")->with([
			"project"           => $project,
			"statuses"          => Project::getPossibleStatuses(),
			"possible_contacts" => User::all()->except(Auth::id()),
			"contact_ids"       => $contactIDs,
		]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $projectId
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, $projectId) {
		//
		$statuses = "";
		foreach (Project::$statuses as $status => $val) {
			$statuses .= $status . ",";
		}

		$data = $request->validate([
			"name"        => "required",
			"description" => "required",
			"status"      => "in:$statuses",
			"contact"     => "required|array",
			"contact.*"   => "int"
		]);

		$project = Project::findOrFail($projectId);
		$project->name = $data["name"];
		$project->description = $data["description"];
		$project->status = $data["status"];
		$project->owner_id = Auth::user()->id;

		$project->save();

		$project->contacts()->detach();

		foreach ($data["contact"] as $contact) {
			$project->contacts()->attach($contact);
		}

		return redirect(url()->previous())->with(["success" => "Sikeres módosítás"]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $projectId
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy($projectId) {
		$message = Project::find($projectId)->delete() ? ["success" => "Projekt sikeresen törölve."] : ["error" => "Nem sikerült a projekt törlése."];

		return redirect(route("index"))->with($message);
	}
}
