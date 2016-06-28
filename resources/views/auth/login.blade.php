@extends('template.main')

@section('title', 'Login')

@section('content')

	<div class="container text-danger">
		@if (Session::has('message'))
			{{Session::get('message')}}
		@endif
	</div>

    {!! Form::open(['route' => 'users.login', 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'h5']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'h5']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
            <a href="{{route('home')}}" class="btn btn-default">Cancel</a>
        </div>

    {!! Form::close() !!}

 	<a href="{{route('users.register')}}" class="">Register</a>
    </br>
    <a href="{{route('users.password.email')}}" class="">Reset Password</a>

@endsection