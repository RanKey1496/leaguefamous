<nav class="navbar navbar-woodtier navbar-static-top">
  <div class="container">
    <div class="navbar-header">
    	   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
      <a class="navbar-brand" href="{{route('home')}}">
        Wood Tier
      </a>
    </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          <li class="dropdown">
            <a href="{{route('users.panel')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->username}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('users.settings')}}">Account settings</a></li>
              <li><a href="{{route('users.edit.profile')}}">Change my avatar</a></li>
              <li role="separator" class="divider"></li>
         	    <li><a href="{{route('users.logout')}}">Logout</a></li>
            </ul>
          </li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
              <li>
                 <div class="row">
                    <div class="col-md-12">
                       <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                          <div class="form-group">
                             <label class="sr-only" for="exampleInputEmail2">Email address</label>
                             <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                          </div>
                          <div class="form-group">
                             <label class="sr-only" for="exampleInputPassword2">Password</label>
                             <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                   <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                          </div>
                          <div class="form-group">
                             <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                          </div>
                          <div>
                             <label class="checkbox" for="checkbox1">
                             <input type="checkbox" valueid="checkbox1" data-toggle="checkbox"> keep me logged-in
                             </label>
                          </div>
                       </form>
                    </div>
                 </div>
              </li>
            </ul>
          </li>
        @endif
      </ul>
      </div>
  </div>
</nav>
