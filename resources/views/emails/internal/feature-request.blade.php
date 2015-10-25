<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Newsletter Signup</h2>

		<div>
			This person has a feature request<br>
			@foreach ($inputs as $key=>$input)
				{{ $key }}: {{ $input }}<br>
			@endforeach<br>
			
			
		</div>
	</body>
</html>
