@extends('layouts.app')
@section('content')
	<div class="row">
		@php
			/** @var \App\Models\User $user	*/
		@endphp
		@foreach($users as $user)
			<div class="col-xl-3 col-12 mb-3">
				<div class="card w-100">
					<div class="card-body d-flex flex-column">
						<h5 class="card-title fw-bold mb-0">
							{{ $user->name }}
						</h5>
						<form action="{{route("users.store", $user->id)}}">
							@csrf
							<div class="form-group">
								<label for="role" class="small text-muted mt-2">Szerepkör: </label>
								<select name="role" id="role" class="form-select">
									<option value="employee" @if($user->isEmployee()) selected @endif>Dolgozó</option>
									<option value="manager" @if($user->isManager()) selected @endif>Menedzser</option>
								</select>
								<input type="submit" value="Mentés" class="btn btn-outline-success w-100 mt-2">
							</div>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	</div>

@endsection
