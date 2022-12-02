@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
			<div class="card p-3">

				<form action="{{ route("projects.update", $project->id) }}" method="post">
					@method("put")
					@csrf
					@if($errors->any())
						<div class="form-group">
							{!! implode('', $errors->all('<div>:message</div>')) !!}
						</div>
					@endif
					<div class="form-group mb-2">
						<label for="name" class="form-label">
							Projekt neve:
						</label>
						<input type="text" name="name" id="name" class="form-control" required value="{{ $project->name }}">
					</div>
					<div class="form-group mb-2">
						<label for="description" class="form-label">Projekt leírása:</label>
						<textarea rows="6" type="text" name="description" id="description" class="form-control" required>{{ $project->description }}</textarea>
					</div>
					<div class="form-group mb-2">
						<label for="status">Projekt státusza:</label>
						<select name="status" id="status" class="form-select" required>
							@foreach($statuses as $key => $status)
								<option value="{{$key}}" @if($key == $project->status) selected @endif> {{$status}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-2">
						<label class="form-label" for="contact[]">Kapcsolattartók:</label>
						<select name="contact[]" id="contact[]" class="form-select mb-2" required multiple>
							@foreach($possible_contacts as $possible_contact)
								<option @if(in_array($possible_contact->id, $contact_ids)) selected @endif value="{{$possible_contact->id}}">{{ $possible_contact->name }}</option>
							@endforeach
						</select>
					</div>
					<div id="contacts"></div>
					<div class="form-group mt-4">
						<input type="submit" value="Mentés" class="btn btn-success btn-block w-100">
					</div>
					@if($project->tickets()->count() == 0)
						<div class="form-group mb-2 mt-3">
							<button type="button" id="delete-btn" class="btn btn-outline-danger btn-block w-100">Törlés</button>
						</div>
					@endif
				</form>
			</div>

		</div>
		<script type="module">
			@if($project->tickets()->count() == 0)
			let deleteBtn = $("#delete-btn");
			const url = `{!! route("projects.destroy", $project->id) !!}`;
			const projectId = {!! $project->id !!};

			deleteBtn.click(function () {

				axios.delete(url)
					.then((res) => {
						window.location.replace(res.data);
					})
			});
			@endif
		</script>
@endsection
