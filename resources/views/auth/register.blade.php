@extends('template.main')

@section('title', 'Create account')

@section('content')
    <div class="container">
        <div class="col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
            <h3>Log In</h3>
                {!! Form::open(['route' => 'users.login', 'method' => 'POST']) !!}

            <div class="form-group">
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail','required']) !!}
            </div>

            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
        <a href="{{route('users.password.email')}}" class="">Forgot password?</a>
        </div>
        <div class="col-sm-5 col-md-4">
            <h3>Register</h3>
        {!! Form::open(['route' => 'users.register', 'method' => 'POST']) !!}

            <div class="form-group">
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'username','required']) !!}
            </div>

            <div class="form-group">
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'e-mail','required']) !!}
            </div>

            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'password','required']) !!}
                </br>
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 're-enter password','required']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Account', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
