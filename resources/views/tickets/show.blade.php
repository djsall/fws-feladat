@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-xl-4 offset-xl-4 col-12">
					<div class="card p-3">
						<h4 class="card-title fw-bold mb-1">
							{{$ticket->name}}
						</h4>
						<x-ui.status :ticket="$ticket"/>
						<x-ui.ticket-owner :ticket="$ticket"/>
						<x-ui.project-link :ticket="$ticket"/>
						<p class="card-text mb-5">
							{{$ticket->description}}
						</p>
						<div class="form-group mb-2 mt-3">
							<button type="button" id="edit-btn" class="btn btn-dark btn-block w-100">Szerkesztés</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="module">
		let editBtn = $("#edit-btn");
		const url = `{!! route("tickets.edit", $ticket->id) !!}`;

		editBtn.click(function () {
			window.location.replace(url);
		});
	</script>
@endsection
