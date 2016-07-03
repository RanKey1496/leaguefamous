@extends('template.main')

@section('title', 'Profile')

@section('content')
	<h1>Hi {{Auth::user()->username}}, welcome to your Panel Control</h1>
	<hr/>

    <img src="{{url(Auth::user()->profileImage)}}" class="img-responsive" style="width:256px; height:256px;">
@endsection