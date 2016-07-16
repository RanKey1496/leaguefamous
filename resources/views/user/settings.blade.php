@extends('template.main')

@section('title', 'Edit profile')

@section('content')
	<div class="section section-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
						<div class="pic-wrapper">
							<img class="img-responsive img-circle img-no-padding user-profile-pic-lg" src="{{ url('/') }}/{{Auth::user()->profileImage}}">
							<a href="#" class="change-profile-picture toggleButton" data-target=".image-cropper"><span class="glyphicon glyphicon-camera"></span></a>
						</div>
						<div class="settings-header">
							<h3>{{Auth::user()->username}}</h3>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-brown image-cropper">
			<div class="container">
				<div class="row">
						<div class="col-md-12">
							<h4>Upload new profile image!</h4>
							<div class="demo croppie-container"></div>
							<form id="uploadImg" method="POST" action="{{ route('users.update.profile') }}">
							    <label class="btn btn-default btn-file">
			    				Browse <input type="file" style="display: none;" id="imgInp" value="Choose a file" accept="image/*">
								</label>
							</form>
							<button class="upload-result">Result</button>
							<img class="result" src="">
							<a href="#" class="ajax-post" style="">Upload prrin</a>
							<script>

								function readURL(input) {
									var $uploadCrop;
								    if (input.files && input.files[0]) {
								        var reader = new FileReader();

								        reader.onload = function (e) {
											$uploadCrop.croppie('bind', {
							            		url: e.target.result
							            	});
							            	$('.upload-demo').addClass('ready');
								        }

								        reader.readAsDataURL(input.files[0]);
								    }

								    $uploadCrop = $('.demo').croppie({
										viewport: {
											width: 150,
											height: 150,
											type: 'circle'
										},
										boundary: {
											width: 160,
											height: 160
										},
										exif: true
									});

									$('.upload-result').on('click', function (ev) {
										$uploadCrop.croppie('result', {
											type: 'canvas',
											size: 'viewport',
											format: 'jpeg',
											quality: 0.95
										}).then(function (resp) {
											$('.result').attr("src",resp);
										});
									});
								}

								$("#imgInp").change(function(){
								    readURL(this);
								});

								$(function() {

									$('.ajax-post').click(function(e) {
										e.preventDefault();
										$.post('{{ route('users.update.avatar') }}', {
											"image" : $('.result').attr("src")
										}, function(response) {
											if(response.result != null && response.result == '1'){
												if(response.isUpdated == '1'){
													alert('Funcionó prrón');
												}
											}else{
												alert("Server Error");
											}
										}, "json").always(function() {
						                    });
										return false;
									});
								});

							</script>
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
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</div>

	<div class="cropImage" data-id="{{ url('/') }}/{{Auth::user()->profileImage}}"></div>

	<div class="modal fade" id="changeImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel">Change your profile picture</h4>
	      </div>
	      <div class="modal-body">
					<div class="croppieFrame croppie-container">
					</div>
					<label class="btn btn-default btn-file">
    				Browse <input type="file" style="display: none;" id="upload" value="Choose a file" accept="image/*">
					</label>
	      </div>
	      <div class="modal-footer">
	        <div class="left-side">
	            <button type="button" class="btn btn-primary btn-simple" data-dismiss="modal">Save</button>
	        </div>
	        <div class="divider"></div>
	        <div class="right-side">
	            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<script>

	</script>
@endsection
