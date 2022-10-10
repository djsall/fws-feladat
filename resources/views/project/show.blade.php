@extends('layouts.app')
@section('content')
	<div class="card p-3">

		<div class="row">
			<div class="col d-flex justify-content-between">
				<h3>{{ $project->name }}</h3>
				<a href="{{ route("project.edit", $project->id) }}" class="btn btn-primary">Szerkesztés</a>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>
					Leírás: {{ $project->description }}
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p>
					Státusz: {{ $project->getTranslatedStatus() }}
				</p>
			</div>
		</div>
		<div class="row">

			@foreach($project->contacts as $contact)
				<div class="col-3">
					<div class="card p-2">
						<p>Név: {{ $contact->name }}</p>
						<p>Email: {{ $contact->email }}</p>
					</div>
				</div>
			@endforeach
		</div>

	</div>
@endsection
