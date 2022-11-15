<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ env("APP_NAME") }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

	@vite('resources/js/app.js')
	<!-- Styles -->

	<style>
		body {
			font-family: 'Nunito', sans-serif;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">
				<li class="nav-item">
					<a href="{{ route('index') }}" class="nav-link @if(Route::is("index")) active @endif">Projektek</a>
				</li>
			</ul>
			<ul class="navbar-nav ms-auto">
				@if(Auth::user())
					<li class="nav-item">
						<span class="nav-link">

							{{ Auth::user()->name }}
						</span>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/logout') }}"> Logout </a>
					</li>
				@endif

			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row">
		<div class="col">
			@include("inc.error")
		</div>
	</div>
	@yield('content')
</div>
</body>
</html>
@yield('scripts')
