@extends('template.main')

@section('title', 'Change password')

@section('content')

	{!! Form::open(['route' => 'users.update.password', 'method' => 'POST']) !!}
		{{csrf_field()}}

        <div class="form-group">
            {!! Form::label('password', 'Current Password', ['class' => 'h5']) !!}
            {!! Form::password('mypassword', ['class' => 'form-control', 'placeholder' => 'Enter current password','required']) !!}      
        </div>

        <div class="form-group">
            {!! Form::label('password', 'New Password', ['class' => 'h5']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter new password','required']) !!}      
            </br>
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Re-enter new password','required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Change my password', ['class' => 'btn btn-primary']) !!}
            <a href="{{route('users.panel')}}" class="btn btn-default">Cancel</a>
        </div>

    {!! Form::close() !!}

@endsection