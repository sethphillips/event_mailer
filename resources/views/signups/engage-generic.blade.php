<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Signup for Engage</title>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
	<link rel="stylesheet" href="{!! elixir('dist/app.css') !!}">
    <script src="{!! elixir('dist/app.js') !!}"></script>
</head>
<body>
	<div class="container engage">
		
		<div class="header row">
			<div class="col-xs-6 pull-right">
				<img src="{{ asset('img/cwt/engage/engage_logo.png') }}" class="img img-responsive">	
			</div>
		</div>

		<div class="body row">
			<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2 thank-you">
				<h1 style="text-align:center;">
					Your Data Works for YOU
				</h1>
				<p style="text-align:justify">
					Smart data, big data, business intelligence … The business travel world is driven by data. Are you maximizing yours? 
				<p>
				<p style="text-align:justify">
					Join us at ENGAGE, an exclusive interactive event designed to spark conversation and show you exactly how to make your data work for you and deliver results.
				</p>
				
			</div>
			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
			{!! Form::open(['route'=>'engage_signup_redirect','class'=>'form']) !!}
				
				@include('includes.flash')

				
				
				<!-- Form Input -->
				<div class="form-group">
					<p>
						I’m interested in learning more about Engage in:
					</p>
					<div class="radio">
						<label>
							<input type="radio" name="city" value="boston">
							Boston
						</label>
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="city" value="new_york">
							New York
						</label>
					</div>
				</div>

				<!-- Form Input -->
				<div class="form-group">
					<p>
						My company is currently working with CWT:
					</p>
					<div class="radio">
						<label>
							<input type="radio" name="customer" value="yes">
							Yes
						</label>
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="customer" value="no">
							No
						</label>
					</div>
				</div>
				
				

				<button type='submit' class="submit">
					<img src="{{ asset('img/cwt/engage/learn_more_button.png') }}" >
				</button>
				
				
				
				
			</div>
		
				
				
				
				
			
			{!! Form::close() !!}
			
			
		</div>
		<div class="footer"></div>

	</div>
</body>
</html>