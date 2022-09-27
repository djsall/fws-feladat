@extends('layouts.app')
@section('content')
	<form action="{{route("project.store")}}" method="post">
		<div class="row mt-5">
			@csrf
			<div class="col-4">
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
				<div class="d-flex justify-content-between mt-5 mb-2">
					<p class="form-label">Kapcsolattartók</p>
					<button type="button" id="add-contact" class="btn btn-sm btn-primary">+</button>
				</div>
				<div id="contacts"></div>
				<div class="form-group mb-2 mt-5">
					<input type="submit" value="Mentés" class="btn btn-success btn-block w-100">
				</div>
			</div>
		</div>
	</form>
	<script type="module">
		let counter = 1;

		const contacts = $("#contacts");
		const btn = $("#add-contact");

		function addInput() {

			let parentElement = $("<div>", {id: 'parent-element-' + counter});

			let labelLineParent = $("<div>").addClass("d-flex flex-row justify-content-between");
			let label = $("<p>").addClass("form-label").text(counter + ". Kapcsolattartó:");

			let destroyBtn = $("<button>", {type: 'button'}).addClass("btn btn-danger btn-sm").text("-");


			let nameLabel = $("<label>").addClass("form-label w-100").text("Név:");
			let nameInput = $("<input>", {required: true, type: 'text', name: 'contacts[contact' + counter + '][name]'}).addClass("form-control");
			let emailLabel = $("<label>").addClass("form-label w-100").text("E-Mail:");
			let emailInput = $("<input>", {required: true, type: 'email', name: 'contacts[contact' + counter + '][email]'}).addClass("form-control");

			labelLineParent.append(label);
			labelLineParent.append(destroyBtn);

			nameInput.appendTo(nameLabel);
			emailInput.appendTo(emailLabel);
			parentElement.append(labelLineParent);
			parentElement.append(nameLabel);
			parentElement.append(emailLabel);

			contacts.append(parentElement);

			destroyBtn.click(function (event) {
				$(event.target).parent().parent().remove();
				counter--;
			});

			counter++;

		}

		btn.on("click", addInput);

	</script>
@endsection
