@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col text-center mt-5">
			@if(\App\Models\Project::all()->count() == 0)
				<h1 class="display-5">Még nem található projekt.</h1>
				<a href="{{route("project.create")}}" class="btn btn-success">Hozz létre egyet</a>
			@endif
		</div>
	</div>
@endsection