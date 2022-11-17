@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
			<div class="card p-3">
				<form action="{{route("projects.store")}}" method="post">
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
						<input type="text" name="name" id="name" class="form-control" required>
					</div>
					<div class="form-group mb-2">
						<label for="description" class="form-label">Projekt leírása:</label>
						<textarea type="text" name="description" id="description" class="form-control" required></textarea>
					</div>
					<div class="form-group mb-2">
						<label for="status">Projekt státusza:</label>
						<select name="status" id="status" class="form-select" required>
							@foreach($statuses as $key => $status)
								<option value="{{$key}}"> {{$status}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-2">
						<label class="form-label" for="contact[]">Kapcsolattartók:</label>
						<select name="contact[]" id="contact[]" class="form-select mb-2" required multiple>
							@foreach($possible_contacts as $possible_contact)
								<option value="{{$possible_contact->id}}">{{ $possible_contact->name }}</option>
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
