<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index() {
		//
		return view("tickets.index")->with([
			"tickets" => Ticket::paginate(10)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create() {
		return view("tickets.create")->with([
			"projects" => Project::all()
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
			"name"        => "string|required",
			"description" => "string|required",
			"project"     => "int|required"
		]);
		$data["created_by"] = Auth::user()->id;

		Ticket::create($data);

		return redirect(route("tickets.index"));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Ticket $ticket
	 * @return \Illuminate\Http\Response
	 */
	public function show(Ticket $ticket) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Ticket $ticket
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($ticket) {
		return view("tickets.edit")->with([
			"statuses" => Ticket::getPossibleStatuses(),
			"ticket"   => Ticket::find($ticket)
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
		$statuses = "";

		foreach (Ticket::$statuses as $key => $status){
			$statuses .= $key . ",";
		}

		$data = $this->validate($request, [
			"name"        => "string|required",
			"description" => "string|required",
			"status" => "in:$statuses"
		]);

		$ticketInstance = Ticket::find($ticket);
		$ticketInstance->name = $data["name"];
		$ticketInstance->description = $data["description"];
		$ticketInstance->status = $data["status"];
		$ticketInstance->save();

		return redirect(route("tickets.index"));
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

		return route("tickets.index");
	}
}
