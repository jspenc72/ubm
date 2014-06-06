@extends('layout.main')
@section('content')
	<div class="container">
		<form action="{{ URL::route('account-create-post') }}" method="post">
			<div class="field"> 
				<input type="text" name="email" class="form-control" placeholder="Email address" autofocus {{(Input::old('email')) ? ' value="'  . e(Input::old('email')) . '"' : ''}} />
				@if($errors->has('email'))
				{{ $errors->first('email') }}
				@endif
			</div>
			<div class="field">
				<input type="text" name="username" class="form-control" placeholder="Username" {{(Input::old('username')) ? ' value="'  . e(Input::old('username')) . '"' : ''}} />
				@if($errors->has('username'))
				{{ $errors->first('username') }}
				@endif
			</div>
			<div class="field">
				<input type="password" name="password" class="form-control" placeholder="Password" />
				@if($errors->has('password'))
				{{ $errors->first('password') }}
				@endif
			</div>
			<div class="field">
				<input type="password" name="password_again" class="form-control" placeholder="Confirm Password" />
				@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
				@endif
			</div>
			<input type="submit" class="btn btn-lg btn-primary btn-block" value="Create Account" />
			{{ Form::token() }}
		</form>
	</div>
@stop
