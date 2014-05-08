@extends('layout.main')
@section('header')
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
@stop
@section('content')
    <div class="container">
		<form action="{{ URL::route('account-sign-in-post') }}" method="post" class="form-signin">
        <center><h2 class="form-signin-heading">UBM Single Sign On</h2></center>
			<div class="field">
				<input type="text" name="email" class="form-control" placeholder="Email address" autofocus {{(Input::old('email')) ? 'value="' .  Input::old('email') . '"' : ''}}/>	
				@if($errors->has('email'))
					{{ $errors->first('email') }}
				@endif		
			</div>
			<div class="field"> 
				<input type="password" name="password" class="form-control" placeholder="Password"/>	
				@if($errors->has('password'))
					{{ $errors->first('password') }}
				@endif							
			</div>
			<div class="field">
				<input type="checkbox" name="remember" id="remember" />
				<label for="remember">Remember Me</label>
			</div>
	        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Sign In">Sign in</button>
			<br>
			<a href="{{ URL::route('account-create') }}" class="btn btn-sm btn-info" role="button">Create an account</a>
			<a href="{{ URL::route('account-forgot-password') }}" class="btn btn-sm btn-info">Forgot password</a>
			{{ Form::token() }}
		</form>	
    </div> <!-- /container -->
@stop

