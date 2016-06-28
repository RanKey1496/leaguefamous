@extends('template.main')

@section('title', 'Password reset')

@section('content')

  {!! Form::open(['route' => 'users.password.reset', 'method' => 'POST']) !!}
    {{csrf_field()}}
    <input type="hidden" name="token" value="{{$token}}" />

    <div class="form-group">
      {!! Form::label('email', 'E-mail Address', ['class' => 'h5']) !!}
      {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail Address','required']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('password', 'Password', ['class' => 'h5']) !!}
      {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
      </br>           
      {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Re-enter Password','required']) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}
      <a href="{{route('home')}}" class="btn btn-default">Cancel</a>
    </div>

  {!! Form::close() !!}
@endsection