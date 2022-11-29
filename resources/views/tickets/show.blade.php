@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-xl-4 offset-xl-4 col-12">
					<div class="card p-3">
						<small class="text-muted">
							Ticket neve:
						</small>
						<h5 class="fw-bold">
							{{ $ticket->name }}
						</h5>
						<x-ui.status :ticket="$ticket"/>
						<x-ui.project-link :ticket="$ticket"/>
						<small class="text-muted">
							Ticket leírása:
						</small>
						<p>{{ $ticket->description }}</p>
						<div class="form-group mb-2 mt-3">
							<button type="button" id="edit-btn" class="btn btn-dark btn-block w-100">Szerkesztés</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="module">
		let deleteBtn = $("#edit-btn");
		const url = `{!! route("tickets.edit", $ticket->id) !!}`;

		deleteBtn.click(function () {
			window.location.replace(url);
		});
	</script>
@endsection
