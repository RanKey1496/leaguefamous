<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'Welcome') | League Famous</title>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\demo.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\ct-paper.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Dosis:400,300,200' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap-select.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/ct-paper') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/ct-paper-checkbox') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/ct-paper-radio') }}"></script>
	<script src="{{ asset('plugins/jquery/js/salvattore.min.js') }}"></script>
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