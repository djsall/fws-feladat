@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col text-center">
			@if(\App\Models\Project::all()->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				<a href="{{route("project.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@else
				@foreach($projects as $project)
					<div class="card mb-3">
						<div class="card-body text-start">
							<div class="row">
								<div class="col-5">
									<h5 class="card-title">{{$project->name}}</h5>
									<p class="card-text">{{$project->description}}</p>
									<p class="card-text">{{$project->getTranslatedStatus()}}</p>
								</div>
								<div class="col-5">
									@if($project->contacts->count() >0)
										<p class="card-text">Kapcsolattartók:</p>
										<ul>
											@foreach($project->contacts as $contact)
												<li>{{$contact->name}}</li>
											@endforeach
										</ul>
									@endif
								</div>
								<div class="col-2 text-end d-flex flex-column justify-content-center">
									<a href="{{route("project.edit", ["projectId"=>$project->id])}}" class="btn btn-primary ">Szerkesztés</a>
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