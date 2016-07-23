@extends('template.main')

@section('content')
	<div class="nav-spacer">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Oops!</h1>
				<h3>{{ $error[1] }} {{ $error[2] }}</h3>
				<p><a class="btn btn-default" href="#" role="button">Go back</a></p>
			</div>
		</div>
	</div>
@endsection
