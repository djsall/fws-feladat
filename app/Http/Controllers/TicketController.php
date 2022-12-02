<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index() {
		if (Auth::user()->isEmployee()) {

			$tickets1 = Ticket::with('project', 'owner')->whereHas('project', function ($q) {
				$q->whereHas('contacts', function ($q) {
					$q->where('users.id', Auth::id());
				});
			})->get();
			$tickets2 = Ticket::with('project', 'owner')->where('owner_id', '=', Auth::id())->get();
			$tickets = $tickets1->merge($tickets2)->paginate(6);
		}
		else
			$tickets = Ticket::with('project', 'owner')->paginate(6);
		return view('tickets.index')->with([
			'tickets' => $tickets,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create() {
		$projects = Project::with('contacts', 'tickets')->whereHas('contacts', function ($q) {
			$q->where('users.id', Auth::id());
		})->get();
		return view('tickets.create')->with([
			'projects' => $projects,
			'users'    => User::all()
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request) {
		$data = $this->validate($request, [
			'name'        => 'string|required',
			'description' => 'string|required',
			'project_id'  => 'int|required',
			'owner_id'    => 'int|required'
		]);
		$data['created_by'] = Auth::user()->id;

		Ticket::create($data);

		return redirect(route('tickets.index'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Ticket $ticket
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(Ticket $ticket) {
		//
		return view('tickets.show')->with([
			'ticket' => $ticket,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Ticket $ticket
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($ticket) {
		return view('tickets.edit')->with([
			'statuses' => Ticket::getPossibleStatuses(),
			'ticket'   => Ticket::find($ticket),
			'users'    => User::all()
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Ticket $ticket
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, $ticket) {
		//
		$statuses = '';

		foreach (Ticket::$statuses as $key => $status) {
			$statuses .= $key . ',';
		}

		$data = $this->validate($request, [
			'name'        => 'string|required',
			'description' => 'string|required',
			'status'      => 'in:$statuses|required',
			'owner_id'    => 'int|required',
		]);

		$ticketInstance = Ticket::find($ticket);
		$ticketInstance->name = $data['name'];
		$ticketInstance->description = Str::limit($data['description'], 65000);
		$ticketInstance->status = $data['status'];
		$ticketInstance->owner_id = $data['owner_id'];
		$ticketInstance->save();

		return redirect(route('tickets.index'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Ticket $ticket
	 * @return string
	 */
	public function destroy($ticket) {
		$ticket = Ticket::find($ticket);
		$ticket->delete();

		return route('tickets.index');
	}
}
