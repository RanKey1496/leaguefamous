<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
    	   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
      <a class="navbar-brand" href="{{route('home')}}">
        League Famous
      </a>
    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          <li class="dropdown">
            <a href="{{route('users.panel')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->username}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('users.panel')}}">Profile</a></li>
              <li><a href="{{route('users.edit.profile')}}">Change my avatar</a></li>
              <li><a href="{{route('users.edit.password')}}">Change my password</a></li>
              <li role="separator" class="divider"></li>
         	  <li><a href="{{route('users.logout')}}">Logout</a></li>
            </ul>
          </li>
        @else
          <li><a href="{{route('users.register')}}">Log In or Sign Up</a></li>
        @endif
      </ul>
      </div>
  </div>
</nav>