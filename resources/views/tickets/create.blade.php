@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
			<div class="card p-3">
				<form action="{{route("tickets.store")}}" method="post">
					@csrf
					@if($errors->any())
						<div class="form-group">
							{!! implode('', $errors->all('<div>:message</div>')) !!}
						</div>
					@endif
					<div class="form-group mb-2">
						<label for="name" class="form-label">
							Ticket címe:
						</label>
						<input type="text" name="name" id="name" class="form-control" required>
					</div>
					<div class="form-group mb-2">
						<label for="description" class="form-label">Ticket leírása:</label>
						<textarea rows="6" type="text" name="description" id="description" class="form-control" required></textarea>
					</div>
					<div class="form-group mb-2">
						<label for="project">Projekt:</label>
						<select name="project" id="project" class="form-select" required>
							@foreach($projects as $key => $project)
								<option value="{{$project->id}}"> {{$project->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-2 mt-5">
						<input type="submit" value="Mentés" class="btn btn-success btn-block w-100">
					</div>
				</form>
			</div>
		</div>
		<script type="module">
		</script>
@endsection
