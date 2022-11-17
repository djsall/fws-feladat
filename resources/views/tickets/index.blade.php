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
					<div class="col-2 ">
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
						<h4 class="card-title fw-bold mb-0">{{$ticket->name}}</h4>
						<p class="card-text mb-1">
							<span class="badge rounded-pill
								@if($ticket->isClosed()) bg-success @endif
							@if($ticket->isInProgress()) bg-primary @endif
							@if($ticket->isOpen()) bg-warning @endif
								">
								{{$ticket->getTranslatedStatus()}}
							</span>
						</p>
						<p class="card-text mb-1">
							{{$ticket->description}}
						</p>
						{{--@if($ticket->contacts->count() > 0)
							<small class="text-muted">Kapcsolattartók:</small>
							<ul class="list-group mb-3">
								@foreach($ticket->contacts as $contact)
									<li class="list-group-item">{{$contact->name}}</li>
								@endforeach
							</ul>
						@endif--}}

						<a href="{{route("tickets.edit", ["ticket"=>$ticket->id])}}" class="btn btn-sm btn-dark align-self-start mt-auto">Szerkesztés</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $tickets->links('pagination::bootstrap-5') }}
	</div>

@endsection