@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			@if($tickets->count() == 0)
				<h1 class="display-5">Még nem található ticket.</h1>
				<a href="{{route("tickets.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@else
				<div class="row">
					<div class="col">
						<h1 class="fw-bold mb-4 mt-0">Ticketek</h1>
					</div>
					<div class="col-3 col-md-2">
						<a href="{{route("tickets.create")}}" class="btn btn-primary w-100">Létrehozás</a>
					</div>
				</div>
			@endif
		</div>
	</div>
	<div class="row">
		@php
			/** @var \App\Models\Ticket $ticket	*/
		@endphp
		@foreach($tickets as $ticket)
			<div class="col-lg-4 d-flex align-items-stretch mb-3">
				<div class="card w-100">
					<div class="card-body d-flex flex-column">
						<h5 class="card-title fw-bold mb-1">{{$ticket->name}}
							<span class="badge rounded-pill
							@if($ticket->isClosed())        bg-success @endif
							@if($ticket->isInProgress())    bg-primary @endif
							@if($ticket->isOpen())          bg-warning @endif
								">
								{{$ticket->getTranslatedStatus()}}
							</span>
						</h5>
						<h5 class="text-muted mb-3 mt-0">
							<a href="{{ route("projects.edit", $ticket->project->id) }}" class="text-muted">
								{{$ticket->project->name}}
							</a>
						</h5>
						<p class="card-text mb-4">
							{{$ticket->description}}
						</p>
						<a href="{{route("tickets.edit", ["ticket"=>$ticket->id])}}" class="btn btn-sm btn-dark align-self-start mt-auto">Szerkesztés</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $tickets->links('pagination::bootstrap-5') }}
	</div>

@endsection
