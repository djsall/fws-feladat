@extends('layouts.app')
@section('content')
	<form action="{{route("project.store")}}" method="post">
		<div class="row mt-5">
			@csrf
			<div class="col-4">
				<div class="form-group mb-2">
					<label for="name" class="form-label">
						Projekt neve:
					</label>
					<input type="text" name="name" id="name" class="form-control" required>
				</div>
				<div class="form-group mb-2">
					<label for="description" class="form-label">Projekt leírása:</label>
					<input type="text" name="description" id="description" class="form-control" required>
				</div>
				<div class="form-group mb-2">
					<label for="status">Projekt státusza:</label>
					<select name="status" id="status" class="form-select" required>
						@foreach($statuses as $key => $status)
							<option value="{{$key}}"> {{$status}}</option>
						@endforeach
					</select>
				</div>
				<div class="d-flex justify-content-between mt-5">
					<p class="form-label">Kapcsolattartók</p>
					<button type="button" id="add-contact" class="btn btn-sm btn-primary">+</button>
				</div>
				<div id="contacts"></div>
			</div>
		</div>
	</form>
	<script type="module">
		let counter = 1;

		const contacts = $("#contacts");
		const btn = $("#add-contact");

		function addInput() {
			let label = $("<label>").addClass("form-label w-100").text(counter + ". Kapcsolattartó");
			let input = $("<input>", {name: 'contact-' + counter}).addClass("form-control");

			input.appendTo(label);
			contacts.append(label);

			console.log("asd");

			counter++;

		}

		btn.on("click", addInput);

	</script>
@endsection
