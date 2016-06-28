@extends('template.main')

@section('title', 'Create account')

@section('content')

    {!! Form::open(['route' => 'users.register', 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Username', ['class' => 'h5']) !!}
            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter Username','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'h5']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'h5']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
            </br>           
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Re-enter Password','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create a free account', ['class' => 'btn btn-primary']) !!}
            <a href="{{route('home')}}" class="btn btn-default">Cancel</a>
        </div>

    {!! Form::close() !!}
@endsection