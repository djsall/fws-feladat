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
						<div class="card-body text-start">
							<div class="row">
								<div class="col-8">
									<h5 class="card-title">{{$project->name}}</h5>
									<p class="card-text">{{$project->description}}</p>
									<p class="card-text">{{$project->getTranslatedStatus()}}</p>
								</div>
								<div class="col text-end d-flex flex-column justify-content-center">
									<a href="{{route("project.show", ["projectId"=>$project->id])}}" class="btn btn-dark ">Részletek</a>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				{{ $projects->links('pagination::bootstrap-5') }}
			@endif
		</div>
	</div>
@endsection