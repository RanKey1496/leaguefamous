@extends('template.main')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
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
        </div>
    </div>

@endsection