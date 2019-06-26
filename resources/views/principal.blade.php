<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 	<meta name="description" content="">
		<meta name="author" content="">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<script src="vendor/jquery/jquery.min.js"></script>
  		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	  <title>Tienda NONEX</title>

	  <!-- Bootstrap core CSS -->
	  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	  <!-- Custom styles for this template -->
	  <link href="css/shop-homepage.css" rel="stylesheet">

	</head>

	<body>
		@include('nav')
		<!-- Page Content -->
  		<div class="container">
    		<div class="row">
    			@include('Tienda.categorias')
				@yield('content')
			</div>
    		<!-- /.row -->
  		</div>
  		<!-- /.container -->
		@include('footer')
	</body>
</html>