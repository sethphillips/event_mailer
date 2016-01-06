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
			<div class="col-sm-10 col-md-8 col col-md-offset-2 col-sm-offset-1 thank-you">
				<h1>Thanks for your interest in ENGAGE</h1>
				<p>
					The event will be held {!! Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') !!}<br>
					-at-<br>
					{!! $campaign->venue !!}<br>
					{!! $campaign->address !!}<br>
					{!! $campaign->city !!} {!! $campaign->state !!},  {!! $campaign->zip !!}
				</p>
				<p>
					@if($campaign->title_slug === 'engage_boston_invite_c')
						<a href="{{ asset('ical/engage_boston_pm.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_boston_invite_p')
						<a href="{{ asset('ical/engage_boston_am.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_new_york_invite_c')
						<a href="{{ asset('ical/engage_new_york_pm.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_new_york_invite_p')
						<a href="{{ asset('ical/engage_new_york_am.ics') }}" download>
							Add to calendar
						</a>
					@endif
				</p>
			</div>
			<div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			
			{!! Form::open(['route'=>'signup','class'=>'form']) !!}
				
				@include('includes.flash')

				<div class="form-group">
					{!! Form::label('first_name','First Name') !!}
					{!! Form::text('first_name','',['class' => 'form-control','placeholder'=>'required'] ) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('last_name','Last Name') !!}
					{!! Form::text('last_name','',['class' => 'form-control','placeholder'=>'required'] ) !!}
				</div>

				<div class="form-group">
					{!! Form::label('email','Company Email') !!}
					{!! Form::text('email','',['class' => 'form-control','placeholder'=>'required'] ) !!}
				</div>
				<!-- Form Input -->
				
				<div class="form-group">
					{!! Form::label('phone','Phone Number') !!}
					{!! Form::text('phone','',['class' => 'form-control','placeholder'=>''] ) !!}
				</div>
				
				@if ($email)
					<input type="hidden" name="salted_id" value="{{ $email->salted_id }}">
				@endif

				<input type="hidden" name="campaign" value="{{ $campaign->id }}">

				<button type='submit' class="submit">
					<img src="{{ asset('img/cwt/engage/register_button_2.png') }}" >
				</button>
				
				
				
				
			</div>
		
				
				
				
				
			
			{!! Form::close() !!}
			
			
		</div>
		<div class="footer"></div>

	</div>
</body>
</html>