@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-4 d-flex align-items-stretch">
					<div class="card p-3 w-100">
						<h4 class="fw-bold">
							{{ $project->name }}
						</h4>
						<x-ui.status :project="$project"/>
						<p class="mt-3">{{ $project->description }}</p>
						@if(Auth::user()->isManager())
							<div class="form-group mb-2 mt-5">
								<button type="button" id="edit-btn" class="btn btn-dark btn-block w-100">Szerkesztés</button>
							</div>
						@endif
					</div>
				</div>
				<div class="col-4 d-flex align-items-stretch">
					<div class="card p-3 w-100">
						<small class="text-muted">Kapcsolattartók: ({{$project->contacts()->count()}} db)</small>
						<ul>
							@foreach($project->contacts as $contact)
								<li>{{$contact->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-4 d-flex align-items-stretch">
					<div class="card p-3 w-100">
						<small class="text-muted">Ticketek: ({{$project->tickets()->count()}} db)</small>
						<ul>
							@foreach($project->tickets as $ticket)
								<li>
									<a class="text-black" href="{{ route("tickets.show", $ticket->id) }}">{{$ticket->name}} ({{$ticket->getTranslatedStatus()}})</a>
								</li>
							@endforeach
						</ul>
						<div class="form-group mb-2 mt-auto">
							<button type="button" id="create-ticket-btn" class="btn btn-success btn-block w-100">Létrehozás</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="module">
		let editBtn = $("#edit-btn");
		const editUrl = `{!! route("projects.edit", $project->id) !!}`;

		editBtn.click(function () {
			window.location.replace(editUrl);
		});

		let createTicketBtn = $("#create-ticket-btn");
		const createTicketUrl = ` {!! route("tickets.create", $project->id) !!}`;

		createTicketBtn.click(function () {
			window.location.replace(createTicketUrl);
		})
	</script>
@endsection
