@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-4">
					<div class="card p-3">
						<small class="text-muted">
							Ticket neve:
						</small>
						<h5 class="fw-bold">
							{{ $ticket->name }}
						</h5>
						<div class="d-flex justify-content-between">
							<small class="text-muted">Ticket státusza:</small>
							<div class="badge rounded-pill w-25 mb-3
							@if($ticket->isClosed())        bg-success @endif
							@if($ticket->isInProgress())    bg-primary @endif
							@if($ticket->isOpen())          bg-warning @endif
								">
								{{$ticket->getTranslatedStatus()}}
							</div>
						</div>
						<small class="text-muted">
							Projekt leírása:
						</small>
						<p>{{ $project->description }}</p>
						<div class="form-group mb-2 mt-3">
							<button type="button" id="edit-btn" class="btn btn-dark btn-block w-100">Szerkesztés</button>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card p-3">
						<small class="text-muted">Kapcsolattartók:</small>
						<ul>
							@foreach($project->contacts as $contact)
								<li>{{$contact->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-4">
					<div class="card p-3">
						<small class="text-muted">Ticketek:</small>
						<ul>
							@foreach($project->tickets as $ticket)
								<li>
									<a href="{{ route("tickets.show", $ticket->id) }}">{{$ticket->name}}</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="module">
		let deleteBtn = $("#edit-btn");
		const url = `{!! route("projects.edit", $project->id) !!}`;

		deleteBtn.click(function () {
			window.location.replace(url);
		});
	</script>
@endsection
