@extends('template.main')

@section('title', 'Change profile image')

@section('content')

	{!! Form::open(['route' => 'users.update.profile', 'method' => 'POST', 'files' => true]) !!}
		{{csrf_field()}}
        <div class="form-group">
            {!! Form::label('image', 'Image', ['class' => 'h5']) !!}
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update profile', ['class' => 'btn btn-primary']) !!}
            <a href="{{route('users.panel')}}" class="btn btn-default">Cancel</a>
        </div>

    {!! Form::close() !!}

@endsection