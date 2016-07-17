<nav class="navbar navbar-woodtier navbar-static-top">
  <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">
        Wood Tier
      </a>
      <div class="nav-login">
        @if (Auth::check())
          <div class="logged-in dropdown">
              <button class="clearbutton dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="collapse-text">{{Auth::user()->username}}</span>
                <img class="img-responsive img-no-padding user-profile-pic" src="{{ url('/') }}/{{Auth::user()->profileImage}}">
              </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="{{route('users.settings')}}">Settings</a></li>
              <li><a href="{{route('users.edit.profile')}}">Change my avatar</a></li>
              <li><a href="{{route('users.edit.password')}}">Change my password</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{route('users.logout')}}">Logout</a></li>
            </ul>
          </div>
        @else
          <div class="nav-not-logged-in dropdown">
            <button class="clearbutton dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Login <span class="caret"></span>
            </button>
            <ul id="login-dp" class="dropdown-menu dropdown-menu-right">
              <li>
                 <div class="row">
                    <div class="col-md-12">
                       {!! Form::open(['route' => 'users.login', 'method' => 'POST', 'id' =>  'login-nav']) !!}

                        <div class="form-group">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-mail','required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password','required']) !!}
                            <div class="help-block text-right"><a href="{{route('users.password.email')}}">Forget the password?</a></div>
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Sign in', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                      {!! Form::close() !!}
                    </div>
                 </div>
                 <div class="row">
                   <div class="col-md-12 text-center">
                     <a href="{{route('users.register')}}">Register New User</a>
                   </div>
                 </div>
              </li>
            </ul>
          </div>
        @endif
      </div>
  </div>
</nav>
