<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
	
    <title>A Halloween Message From Exhibit Partners</title>
	
	<link rel="shortcut icon" href="/img/favicon.ico">
	<link rel="stylesheet" href="{!! elixir('dist/app.css') !!}">
    <script src="{!! elixir('dist/app.js') !!}"></script>
     
     @yield('social-tags')

     
</head>

	<body class="halloween">

		@yield('content')

	</body>

</html>