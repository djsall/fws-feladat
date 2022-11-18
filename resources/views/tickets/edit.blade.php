@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-xl-4 col-lg-6 offset-xl-4 offset-lg-3">
			<div class="card p-3">
				<form action="{{route("tickets.update", $ticket->id)}}" method="post">
					@csrf
					@method("put")
					@if($errors->any())
						<div class="form-group">
							{!! implode('', $errors->all('<div>:message</div>')) !!}
						</div>
					@endif
					<div class="form-group mb-2">
						<label for="name" class="form-label">
							Ticket címe:
						</label>
						<input type="text" name="name" id="name" class="form-control" required value="{{ $ticket->name }}">
					</div>
					<div class="form-group mb-2">
						<label for="description" class="form-label">Ticket leírása:</label>
						<textarea rows="6" type="text" name="description" id="description" class="form-control" required>{{ $ticket->description }}</textarea>
					</div>
					<div class="form-group mb-2">
						<label for="status">Ticket státusza:</label>
						<select name="status" id="status" class="form-select" required>
							@foreach($statuses as $key => $status)
								<option @if($ticket->status == $key) selected @endif value="{{$key}}"> {{$status}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-2 mt-5">
						<input type="submit" value="Mentés" class="btn btn-success btn-block w-100">
					</div>
					<div class="form-group mb-2 mt-3">
						<button type="button" id="delete-btn" class="btn btn-outline-danger btn-block w-100">Törlés</button>
					</div>
				</form>
			</div>
		</div>
		<script type="module">
			let deleteBtn = $("#delete-btn");
			const url = `{!! route("tickets.destroy", $ticket->id) !!}`;

			deleteBtn.click(function () {

				axios.delete(url)
					.then((res) => {
						window.location.replace(res.data);
					})
			});
		</script>
@endsection
