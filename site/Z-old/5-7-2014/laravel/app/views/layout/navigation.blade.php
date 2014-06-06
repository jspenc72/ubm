    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.universalbusinessmodel.com/web">UBM </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav navbar-right">
			<!--<li><a class="active" href="{{ URL::route('home') }}">Home</a></li>-->
@if(Auth::check())
			<li><a href="{{ URL::route('account-change-password') }}">Change Password</a></li>
			<li><a href="/user/{{ Auth::user()->username }}">My Profile</a></li>
			<li><a href="{{ URL::route('account-sign-out') }}">Sign Out</a></li>
@else
			<li><a href="{{ URL::route('account-sign-in') }}">Sign In</a></li>
@endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>