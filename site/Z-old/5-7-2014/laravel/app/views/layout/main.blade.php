<!DOCTYPE html>
<html>
	<head>
		<title>UBM Authentication</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Optional theme -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">


		@yield('header')
	</head>
	<body>
		@include('layout.navigation')
		@yield('content')
		@if(Session::has('global'))
			<p>{{ Session::get('global') }}</p>
		@endif
		@yield('javascript')
	</body>
</html>