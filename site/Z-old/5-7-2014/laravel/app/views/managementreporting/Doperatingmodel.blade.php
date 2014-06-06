@extends('layout.main')
@section('header')
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
@stop
@section('content')
@if(Auth::check())
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="#">Automated Model Creation</a></li>
            <li><a href="#">Automated Product Creation</a></li>
            <li><a href="#">Automated App Creation</a></li>
            <li><a href="#">UBM App Store</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Professional Services</a></li>
            <li><a href="">Developer Kit</a></li>
            <li><a href="">Management Reporting</a></li>
            <li><a href="">Strategic Command Centers</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Management Reporting - Table of Contents</h1>
          <a href=""><h2 class="sub-header">(D) Operating Model</h2></a>
          <div id="birt_container">
          	<p>this is a test</p>
          </div>
        </div>
      </div>
    </div>
@else

@endif
@stop
@section('javascript')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/docs.min.js"></script>
    <script>
	$('#birt_container').on('click', function(){
    	$('iframe').remove();
		$('<iframe />', {height: 500,width: 800,src:  'http://www.universalbusinessmodel.com'}).appendTo('#birt_container');		
	});

    </script>

@stop