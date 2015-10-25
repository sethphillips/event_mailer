<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Sales Lead for {!! $inputs['product'] !!}</h2>

		<div>
			@if ($failed)
			This person would like information from sales <strong>Netsuite was unable to create a lead</strong><br>
			@else

			This person would like information from sales and has been added to netsuite<br>
			@endif
			@foreach ($inputs as $key=>$input)
				{{ $key }}: {{ $input }}<br>
			@endforeach<br>
		
		</div>
	</body>
</html>
