<div id="flexnav">
  <a href="{{route('home')}}" id="flexnav-brand">
		<div class="text-center">
      B
    </div>
  </a>
		<form id="frmSearch" method="GET" action="" class="nav-search-form">
      <span class="glyphicon glyphicon-search search-icon"></span>
			<input id="txtSearch" type="text" class="form-control nav-search-input" aria-label="..." placeholder="Find summoners...">
			<div class="dropdown nav-region-menu">
				<button class="btn btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				NA
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<li><a href="#">NA</a></li>
					<li><a href="#">LAN</a></li>
					<li><a href="#">LAS</a></li>
					<li><a href="#">BR</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">EUW</a></li>
					<li><a href="#">EUNE</a></li>
					<li><a href="#">RU</a></li>
					<li><a href="#">TR</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">KR</a></li>
					<li><a href="#">OCE</a></li>
				</ul>
			</div>
			<input id="search-submit" type="submit" value="Search">
		</form>
	<div class="flexgrower">
	</div>
	<div class="">
	</div>
	<div>
  	@include('template.partials.loginmenu')
	</div>
</div>

<div class="nav-spacer"></div>

<!-- unberbox -->

<div id="underbox"> Hello
</div>

<!-- end underbox -->

<!--Search-->

<div class="section">
	<div class="container">
		<div class="search-wrapper">
			<form id="frmSearch" method="GET" action="">
				<input id="txtSearch" type="text" class="form-control summoner-search" aria-label="..." placeholder="Find summoners...">
				<div class="dropdown region-menu">
					<button class="btn btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					NA
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
						<li><a href="#">NA</a></li>
						<li><a href="#">LAN</a></li>
						<li><a href="#">LAS</a></li>
						<li><a href="#">BR</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">EUW</a></li>
						<li><a href="#">EUNE</a></li>
						<li><a href="#">RU</a></li>
						<li><a href="#">TR</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">KR</a></li>
						<li><a href="#">OCE</a></li>
					</ul>
				</div>
			</form>
		</div>
  </div>
</div>


@if(Auth::guest())
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h2>Join the Banter club!</h2>
          </div>
          <div class="col-sm-6 col-md-6">
              <h3>Create an account</h3>
          {!! Form::open(['route' => 'users.register', 'method' => 'POST']) !!}
              <div class="form-group">
                  {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'username*','required']) !!}
              </div>
              <p><small>*Between 1-16 characters, can contain letters and numbers, and must begin with a letter.</small></p>

              <div class="form-group">
                  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'e-mail**','required']) !!}
              </div>
              <p><small>**Needed to activate your account!</small></p>
              <div class="form-group">
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'password','required']) !!}
                  </br>
                  {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm password','required']) !!}
              </div>

              <div class="form-group">
                  {!! Form::submit('Create Account', ['class' => 'btn btn-primary btn-block']) !!}
              </div>
          {!! Form::close() !!}
          </div>
          <div class="col-sm-6 col-md-6">
            <h3>A quick read</h3>
            <h4>Please do:</h4>
            <ul>
              <li>Have fun.</li>
              <li>Share interesting images or screenshots.</li>
              <li>Invite your friends to join.</li>
            </ul>
            <h4>Please don't:</h4>
            <ul>
              <li>Spam.</li>
              <li>Post illegal stuff.</li>
              <li>Post obscene content.</li>
              <li>Be overtly impolite towards other people.</li>
            </li>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

<script type="text/javascript">
  $(function(){
    var region = "na";
    $(".dropdown-menu li a").click(function(){
      $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
      $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
      region = $(this).text().toLowerCase();
    });

    document.getElementById('frmSearch').onsubmit = function() {
      window.location = '{{ url('/') }}/' + region + '/' + document.getElementById('txtSearch').value;
      return false;
    }

  });

  $(document).ready(function() {
    $('.underbox-show').click(function(){
      var id = $(this).attr('data');
      var underboxUrl = "{{ url('/') }}/user/";
      $('#underbox').load( underboxUrl + id );
      $('#underbox').show();
      return this;
    });
  });

</script>

<!-- end search -->
