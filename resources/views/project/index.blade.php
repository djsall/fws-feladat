@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col text-center mt-5">
			@if(\App\Models\Project::all()->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				<a href="{{route("project.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@else
				@foreach(\App\Models\Project::all() as $project)
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">{{$project->name}}</h5>
							<p class="card-text">{{$project->description}}</p>
							<p class="card-text">{{$project->getTranslatedStatus()}}</p>
							<a href="{{route("project.show", ["projectId"=>1])}}" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
@endsection