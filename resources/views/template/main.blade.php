<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'Welcome') | League Famous</title>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		})
	</script>
</head>
<body>

	<!--Navbar-->
	@include('template.partials.nav')
	<!--End Navbar-->

	<!--Page-Container-->
	@include('flash::message')
	@include('template.partials.errors')
	<section>
		@yield('content')
	</section>
	<!--End Page Container-->

	@include('template.partials.foot')

</body>
</html>