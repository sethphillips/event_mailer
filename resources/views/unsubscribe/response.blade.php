<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Unsubscribe</title>
	<link rel="stylesheet" href="{!! elixir('dist/app.css') !!}">
    <script src="{!! elixir('dist/app.js') !!}"></script>

</head>
<body>



<div class="container unsubscribe">

	
	<div class="row">
		<div class="col-sm-2 pull-left logo">
			<a href="http://www.exhibitpartners.com" target="_blank"><img src="{!! asset('img/ep_logo.jpg') !!}" alt="EP_Logo" class="img-responsive img"></a>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
			<h1>{{ $message }}</h1>
		</div>
	</div>
</div>



</body>
</html>
