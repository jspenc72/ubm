@extends('layout.main')
@section('content')
	<div class="container">
		<form action="{{ URL::route('account-forgot-password-post') }}" method="post">
			<div class="field">
				<input type="text" name="email" class="form-control" placeholder="Email address" autofocus {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : ''}} /> <!-- If the input had a value before submit, escape the old value and set the input equal to whatever was there before, if nothing was there, set it equal to an empty string.-->
				@if($errors->has('email'))
					{{ $errors->first('email') }}
				@endif		
			</div>
	
			<input type="submit" class="btn btn-lg btn-primary btn-block" value="Recover" />
			{{ Form::token() }}
		</form>
	</div>
@stop
