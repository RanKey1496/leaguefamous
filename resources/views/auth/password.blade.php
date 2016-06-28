@extends('template.main')

@section('title', 'Password reset')

@section('content')
  @if (Session::has('status'))
    <div class="text-succes">
      {{Session::get('status')}}
    </div>
  @endif

  {!! Form::open(['route' => 'users.password.email', 'method' => 'POST']) !!}
    {{csrf_field()}}

    <div class="form-group">
      {!! Form::label('email', 'E-mail Address', ['class' => 'h5']) !!}
      {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail Address','required']) !!}
    </div>

    <div class="form-group">
      {!! Form::submit('Get link', ['class' => 'btn btn-primary']) !!}
      <a href="{{route('home')}}" class="btn btn-default">Cancel</a>
    </div>

  {!! Form::close() !!}

@endsection