@extends('template.main')

@section('title', 'Profile')

@section('content')
	<h1>Hi {{Auth::user()->username}}, welcome to your Panel Control</h1>
	<hr/>
	@if (Session::has('status'))
    	<div class="text-succes">
    		{{Session::get('status')}}
    	</div>
    @endif

    <img src="{{url(Auth::user()->profileImage)}}" class="img-responsive">
@endsection