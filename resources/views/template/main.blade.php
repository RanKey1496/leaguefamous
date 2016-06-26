<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'Welcome') | League Famous</title>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
</head>
<body>

	@include('template.partials.nav')

	<div class="panel panel-primary">
		<div class="panel-heading bg-primary">
			<h3 class="panel-title">@yield('title', 'Default')</h3>
		</div>
		<div class="panel-body">
			@include('flash::message')
			@include('template.partials.errors')
			<section class="container">
				@yield('content')
			</section>
		</div>
	</div>

	@include('template.partials.foot')

	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>