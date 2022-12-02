<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index() {
		if (Auth::user()->isEmployee()) {
			$projects1 = Project::with('contacts', 'tickets', 'user')->whereHas('contacts', function ($q) {
				$q->where('users.id', Auth::id());
			})->get();
			$projects2 = Project::with('contacts', 'tickets', 'user')->where('user_id', '=', Auth::id())->get();

			$projects = $projects1->merge($projects2)->paginate(6);
		}
		else
			$projects = Project::with('contacts', 'tickets', 'user')->paginate(6);
		return view('projects.index')->with([
			'projects' => $projects
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create() {
		//
		if (Auth::user()->isManager()) {
			return view('projects.create')->with([
				'statuses'          => Project::getPossibleStatuses(),
				'possible_contacts' => User::all()->except(Auth::id())
			]);
		}
		else {
			return redirect(route('projects.index'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request) {

		$statuses = '';
		foreach (Project::$statuses as $status => $val) {
			$statuses .= $status . ',';
		}

		$data = $request->validate([
			'name'        => 'required',
			'description' => 'required',
			'status'      => 'required|in:' . $statuses,
			'contact'     => 'required|array',
			'contact.*'   => 'int'
		]);

		$projectInstance = new Project();
		$projectInstance->name = $data['name'];
		$projectInstance->description = Str::limit($data['description'], 65000);
		$projectInstance->status = $data['status'];
		$projectInstance->user_id = Auth::user()->id;

		$projectInstance->save();

		foreach ($data['contact'] as $contact) {
			$projectInstance->contacts()->attach($contact);
		}

		return redirect(route('index'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param $project
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($project) {
		$projectInstance = Project::with('tickets')->find($project);
		if (!$projectInstance)
			return redirect(route('index'))->with([
				'error' => 'Nem található projekt.'
			]);
		return view('projects.show')->with([
			'project' => $projectInstance
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $project
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function edit($project) {
		if (Auth::user()->isEmployee()) {
			return redirect(route('projects.index'));
		}
		$projectInstance = Project::find($project);

		$contactIDs = [];
		foreach ($projectInstance->contacts as $contact) {
			$contactIDs[] = $contact->id;
		}

		if (!$projectInstance)
			return redirect(route('index'))->with([
				'error' => 'Nem található projekt.'
			]);

		return view('projects.edit')->with([
			'project'           => $projectInstance,
			'statuses'          => Project::getPossibleStatuses(),
			'possible_contacts' => User::all(),
			'contact_ids'       => $contactIDs,
		]);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param $project
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, $project) {
		//
		$statuses = '';
		foreach (Project::$statuses as $status => $val) {
			$statuses .= $status . ',';
		}

		$data = $request->validate([
			'name'        => 'required',
			'description' => 'required',
			'status'      => 'required|in:' . $statuses,
			'contact'     => 'required|array',
			'contact.*'   => 'int'
		]);

		$projectInstance = Project::findOrFail($project);
		$projectInstance->name = $data['name'];
		$projectInstance->description = $data['description'];
		$projectInstance->status = $data['status'];
		$projectInstance->user_id = Auth::user()->id;

		$projectInstance->save();

		$projectInstance->contacts()->detach();

		foreach ($data['contact'] as $contact) {
			$projectInstance->contacts()->attach($contact);
		}

		return redirect(route('index'));
	}

	/**
	 * Remove the specified resource from storage.
	 * Specifically made for API requests.
	 *
	 * @param $project
	 * @return string
	 */
	public function destroy($project) {
		$projectInstance = Project::find($project);
		if ($projectInstance->contacts->count() > 0)
			$projectInstance?->contacts()->detach();
		if (!$projectInstance->tickets()->count() > 0)
			$projectInstance?->delete();


		return route('index');
	}
}
