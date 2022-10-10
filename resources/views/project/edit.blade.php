@extends('layouts.app')
@section('content')
	<div class="row">
		<div class="col col-md-4 offset-md-4">
			<div class="card mt-5 p-3">

				<form action="{{ route("project.update", $project->id) }}" method="post">
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
						<input type="text" name="description" id="description" class="form-control" required value="{{ $project->description }}">
					</div>
					<div class="form-group mb-2">
						<label for="status">Projekt státusza:</label>
						<select name="status" id="status" class="form-select" required>
							@foreach($statuses as $key => $status)
								<option value="{{$key}}" @if($key == $project->status) selected @endif> {{$status}}</option>
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
				</form>
			</div>

		</div>
		<script type="module">
			let counter = 1;

			const contacts = $("#contacts");
			const btn = $("#add-contact");

			let data = {!! $project->contacts->toJson() !!};

			data.forEach(data => addInputPopulated(data));

			function addInputPopulated(data) {

				data = data || "";

				let name = data["name"];
				let email = data["email"];

				let parentElement = $("<div>", {id: 'parent-element-' + counter}).addClass("card p-2 mb-2");

				let labelLineParent = $("<div>").addClass("d-flex flex-row justify-content-between");
				let label = $("<p>").addClass("form-label").text(counter + ". Kapcsolattartó:");

				let destroyBtn = $("<button>", {type: 'button'}).addClass("btn btn-danger btn-sm").text("-");


				let nameLabel = $("<label>").addClass("form-label w-100").text("Név:");
				let nameInput = $("<input>", {value: name, required: true, type: 'text', name: 'contacts[contact' + counter + '][name]'}).addClass("form-control");
				let emailLabel = $("<label>").addClass("form-label w-100").text("E-Mail:");
				let emailInput = $("<input>", {value: email, required: true, type: 'email', name: 'contacts[contact' + counter + '][email]'}).addClass("form-control");

				labelLineParent.append(label);

				//TODO: decide if you should be able to delete contacts in here
				if (!data)
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

			btn.on("click", () => addInputPopulated(""));

		</script>
@endsection
