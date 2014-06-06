@extends('layout.main')
@section('content')
	@if(Auth::check())
		<p>Hello, {{ Auth::user()->username }}.<br>Welcome to the UBM. Click <a href="/user/{{ Auth::user()->username }}"> My Profile  </a>at the top right to get started.</p>
	@else
		<p>You must sign in to access this resource.</p>
	@endif
@stop
