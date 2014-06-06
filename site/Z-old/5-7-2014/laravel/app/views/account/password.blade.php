@extends('layout.main')
@section('content')
		<form action="{{ URL::route('account-change-password-post')}}" method="post">
			<div class="field">
				Old Password: <input type="password" name="old_password"/>
				@if($errors->has('old_password'))
					{{ $errors->first('old_password') }}
				@endif
			</div>

			<div class="field">
				New Password: <input type="password" name="password"/>
				@if($errors->has('password'))
					{{ $errors->first('password') }}
				@endif
			</div>

			<div class="field">
				New Password Again: <input type="password" name="password_again"/>
				@if($errors->has('password_again'))
					{{ $errors->first('password_again') }}
				@endif
			</div>

			<input type="submit" value="Change Password" />
			{{ Form::Token() }}
		</form>
@stop
