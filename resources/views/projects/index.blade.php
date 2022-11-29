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
						<h4 class="card-title mb-2">
							<a class="text-black fw-bold" href="{{ route("projects.show", $project->id) }}">
								{{$project->name}}
							</a>
						</h4>
						<x-ui.status :project="$project"/>
						@if($project->tickets->count() > 0)
							<div class="mb-3">
								<a class="small text-muted" href="{{ route("projects.show", $project->id) }}">{{$project->tickets->count()}} db ticket összesen.</a>
							</div>
						@else
							<div class="mb-3">
								<small class="text-muted">
									Nincsenek ticketek hozzárendelve.
								</small>
							</div>
						@endif
						<p class="card-text mb-3">
							{{$project->description}}
						</p>
						@if($project->contacts->count() > 0)
							<small class="text-muted">Kapcsolattartók:</small>
							<ul class="list-group mb-5">
								@foreach($project->contacts as $contact)
									<li class="list-group-item">{{$contact->name}}</li>
								@endforeach
							</ul>
						@endif

						<a href="{{route("projects.edit", ["project"=>$project->id])}}" class="btn btn-block btn-dark mt-auto">Szerkesztés</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $projects->links('pagination::bootstrap-5') }}
	</div>

@endsection