@extends('layouts.app')
@section('content')
	<form action="{{route("tickets.store")}}" method="post">
		<div class="row">
			@csrf
			<div class="col-4">
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
					<textarea type="text" name="description" id="description" class="form-control" required></textarea>
				</div>
				<div class="form-group mb-2">
					<label for="status">Ticket státusza:</label>
					<select name="status" id="status" class="form-select" required>
{{--						TODO: select active status here--}}
						@foreach($statuses as $key => $status)
							<option value="{{$key}}"> {{$status}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group mb-2 mt-5">
					<input type="submit" value="Mentés" class="btn btn-success btn-block w-100">
				</div>
			</div>
		</div>
	</form>
	<script type="module">
	</script>
@endsection
