@extends('template.main')

@section('content')
	<div class="container">
		<div class="jumbotron">
			<h1>Oops you've have encountered an error</h1>
			<p>{{ $error[1] }} {{ $error[2] }}</p>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">Go back</a></p>
		</div>
	</div>
@endsection