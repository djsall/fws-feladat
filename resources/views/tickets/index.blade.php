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
						<h4 class="card-title fw-bold mb-1">
							<a class="text-black" href="{{ route("tickets.show", $ticket->id) }}">
								{{$ticket->name}}
							</a>
						</h4>
						<x-ui.status :ticket="$ticket"/>
						<x-ui.ticket-owner :ticket="$ticket" />
						<x-ui.project-link :ticket="$ticket"/>
						<p class="card-text mb-5">
							{{$ticket->description}}
						</p>
						<a href="{{route("tickets.edit", ["ticket"=>$ticket->id])}}" class="btn btn-block btn-dark mt-auto">Szerkesztés</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $tickets->links('pagination::bootstrap-5') }}
	</div>

@endsection
