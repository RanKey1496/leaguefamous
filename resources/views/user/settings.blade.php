@extends('template.main')

@section('title', 'Edit profile')

@section('content')
	<div class="section section-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<img class="img-responsive img-circle img-no-padding user-profile-pic-lg" src="{{ url('/') }}/{{Auth::user()->profileImage}}">
				</div>
				<div class="col-md-10">
					<h2>{{Auth::user()->username}}</h2>
					<span>Settings</span>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<h4>Change Password</h4>
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
										{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
								</div>

						{!! Form::close() !!}
				</div>
				<div class="col-sm-6 col-md-4">
					<h4>Change E-mail</h4>
				</div>
			</div>
		</div>
	</div>
@endsection
