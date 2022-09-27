@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col text-center mt-5">
			@if(\App\Models\Project::all()->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				<a href="{{route("project.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@else
				@foreach($projects as $project)
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="card-title">{{$project->name}}</h5>
							<p class="card-text">{{$project->description}}</p>
							<p class="card-text">{{$project->getTranslatedStatus()}}</p>
							<a href="{{route("project.show", ["projectId"=>$project->id])}}" class="btn btn-primary">Részletek</a>
						</div>
					</div>
				@endforeach
				{{ $projects->links('pagination::bootstrap-5') }}
			@endif
		</div>
	</div>
@endsection