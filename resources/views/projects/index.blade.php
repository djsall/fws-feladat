@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			@if($projects->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				@if(Auth::user()->isManager())
					<a href="{{route("projects.create")}}" class="btn btn-success">Hozz létre egyet</a>
				@endif
			@else
				<div class="row">
					<div class="col">
						<h1 class="fw-bold mb-4 mt-0">Projektek</h1>
					</div>
					<div class="col-3 col-md-2">
						@if(Auth::user()->isManager())
							<a href="{{route("projects.create")}}" class="btn btn-primary w-100">Létrehozás</a>
						@endif
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
						<h4 class="card-title mb-2 fw-bold">
							{{$project->name}}
						</h4>
						<x-ui.status :project="$project"/>
						<x-ui.tickets :project="$project"/>
						<x-ui.project-owner :project="$project"/>
						<x-ui.contacts :project="$project"/>
						<x-ui.created-at :project="$project"/>
						<p class="card-text mb-2">
							{{$project->description}}
						</p>
						<a href="{{route("projects.show", ["project"=>$project->id])}}" class="btn btn-block btn-dark mt-auto">Részletek</a>
					</div>
				</div>
			</div>
		@endforeach
		{{ $projects->links('pagination::bootstrap-5') }}
	</div>

@endsection