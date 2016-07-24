@extends('template.main')

@section('title', 'Create account')

@section('content')
    <div class="container">
        <div class="col-sm-6 col-md-5">
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
