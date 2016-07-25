<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'Welcome') | League Famous</title>
	<link rel="stylesheet" href="{{ asset('plugins\bootstrap\css\bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\general.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\theme.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins\css\croppie.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Asap|Dosis|Varela+Round" rel="stylesheet">
	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
  <script src="https://fb.me/react-15.2.1.min.js"></script>
  <script src="https://fb.me/react-dom-15.2.1.min.js"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('plugins/js/salvattore.min.js') }}"></script>
	<script src="{{ asset('plugins/js/croppie.js') }}"></script>
	<script src="{{ asset('plugins/js/packery.pkgd.min.js') }}"></script>
	<script src="{{ asset('js/general.js')}}"></script>
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
	<div class="spacer"></div>
	<!--Page-Container-->
	@include('flash::message')
	@include('template.partials.errors')
	<section>
		@yield('content')
	</section>
	<!--End Page Container-->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					@include('template.partials.foot')
				</div>
			</div>
		</div>
	</div>
</body>
</html>
