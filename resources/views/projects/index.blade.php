@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			@if($projects->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				<a href="{{route("projects.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@else
				<div class="row">
					<div class="col">
						<h1 class="fw-bold mb-4 mt-0">Projektek</h1>
					</div>
					<div class="col-3 col-md-2">
						<a href="{{route("projects.create")}}" class="btn btn-primary w-100">Létrehozás</a>
					</div>
				</div>
			@endif
		</div>
	</div>
	<div class="row">
		@php
			/** @var \App\Models\Project $project	*/
		@endphp
		@foreach($projects as $project)
			<div class="col-lg-4 d-flex align-items-stretch mb-3">
				<div class="card w-100">
					<div class="card-body d-flex flex-column">
						<h5 class="card-title fw-bold mb-2">
							{{$project->name}}
							<span class="badge rounded-pill
								@if($project->isCompleted()) bg-success @endif
							@if($project->isInProgress()) bg-primary @endif
							@if($project->isPending()) bg-warning @endif
								">
								{{$project->getTranslatedStatus()}}
							</span>
						</h5>
						@if($project->tickets->count() > 0)
						<p class="small text-muted mb-0">
							Ticketek:
						</p>
							<ul class="list-group mb-4">
								@foreach($project->tickets as $ticket)
									<li class="list-group-item">
										<a class="text-black" href="{{ route("tickets.edit", $ticket->id) }}">
											{{$ticket->name}}
										</a>
									</li>
								@endforeach
							</ul>
						@else
							<p class="small text-muted mb-3">
								Nincsenek ticketek hozzárendelve.
							</p>
						@endif
						<p class="card-text mb-3">
							{{$project->description}}
						</p>
						@if($project->contacts->count() > 0)
							<small class="text-muted">Kapcsolattartók:</small>
							<ul class="list-group mb-4">
								@foreach($project->contacts as $contact)
									<li class="list-group-item">{{$contact->name}}</li>
								@endforeach
							</ul>
						@endif

						<a href="{{route("projects.edit", ["project"=>$project->id])}}" class="btn btn-sm btn-dark align-self-start mt-auto">Szerkesztés</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $projects->links('pagination::bootstrap-5') }}
	</div>

@endsection