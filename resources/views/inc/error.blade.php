@if(count($errors) > 0)
	<div class="container-fluid pt-5 px-5">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			@foreach ($errors->all() as $error)
				<p class="mb-0">{{$error}}</p>
			@endforeach
		</div>
	</div>
@endif

@if(session('success'))
	<div class="container-fluid pt-5 px-5">
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{session('success')}}
		</div>
	</div>
@endif

@if(session('error'))
	<div class="container-fluid pt-5 px-5">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{session('error')}}
		</div>
	</div>
@endif