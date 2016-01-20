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
			<div class="col-sm-10 col-sm-offset-1 thank-you">
				<p style="text-align:justify">
					Thanks for your interest in ENGAGE. At this exclusive interactive event, you’ll hear from industry experts about how to make your data work for YOU. You’ll also enjoy networking and excellent food and beverage in beautiful surroundings. Key takeaways will include: 
				<p>
				<ul>
					<li>Using travel program data to optimize supplier agreements</li>
					<li>Influencing traveler behavior to increase savings</li>
					<li>Incorporating credit card data and expense reporting a travel program</li>
				</ul>
				<p>
					Don’t miss this event! A live Q&amp;A with panelists will follow the industry expert presentation.
				</p>
				
				
					@include('includes.flash')
			</div>
			<div class="col-sm-5 col-md-4 col-md-offset-1 col-lg-offset-2">
			
				{!! Form::open(['route'=>'signup','class'=>'form']) !!}
					

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
					

				{!! Form::close() !!}

				
			</div>
			
			<div class="col-sm-7 col-md-6 col-lg-5 details">
				<p>
					<b>ENGAGE</b> {{ $campaign->city }}<br>
					{!! Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') !!} from 
					@if($campaign->title_slug === 'engage_boston_c' || $campaign->title_slug === 'engage_new_york_c')
						4:00 - 7:30 p.m.
					@elseif($campaign->title_slug === 'engage_boston_p' || $campaign->title_slug === 'engage_new_york_p')
						7:30 - 11:00 a.m.
					@endif
					
					<sup style=”line-height:1; vertical-align:baseline;position: relative;bottom: 1em;font-size:11px !important;”>*</sup> EST<br>

					@if($campaign->title_slug === 'engage_boston_c' || $campaign->title_slug === 'engage_new_york_c')
						<table class="schedule">
							<tr>
								<td>4:00 - 4:30</td>
								<td>Breakfast &amp; networking</td>
							</tr>
							<tr>
								<td>4:30 - 4:45</td>
								<td>Supplier showcase</td>
							</tr>
							<tr>
								<td>4:45 - 5:00</td>
								<td>Opening remarks</td>
							</tr>
							<tr>
								<td>5:00 - 6:00</td>
								<td>YOUR Data Works for YOU</td>
							</tr>
							<tr>
								<td>6:00 - 6:45</td>
								<td>Panel discussion</td>
							</tr>
							<tr>
								<td>6:45 - 7:30</td>
								<td>Cocktails, hors d’oeuvres &amp; networking</td>
							</tr>
						</table> 
						<i class="sub-text"><sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>Complimentary cocktails and hors d'oeuvres will be provided</i>
					@elseif($campaign->title_slug === 'engage_boston_p' || $campaign->title_slug === 'engage_new_york_p')
						<table class="schedule">
							<tr>
								<td>7:30 - 8:00</td>
								<td>Breakfast &amp; networking</td>
							</tr>
							<tr>
								<td>8:00 – 8:15</td>
								<td>Supplier showcase</td>
							</tr>
							<tr>
								<td>8:15 – 8:30</td>
								<td>Opening remarks</td>
							</tr>
							<tr>
								<td>8:30 – 9:30</td>
								<td>YOUR Data Works for YOU</td>
							</tr>
							<tr>
								<td>9:30 – 10:15</td>
								<td>Panel discussion</td>
							</tr>
							<tr>
								<td>10:15 – 11:00</td>
								<td>Beverages &amp; networking</td>
							</tr>
						</table>
						<i class="sub-text"><sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>Complimentary breakfast will be provided</i>
						
					@endif
				</p>
				<p>
					{!! $campaign->venue !!}<br>
					{!! $campaign->address !!}<br>
					{!! $campaign->city !!} {!! $campaign->state !!},  {!! $campaign->zip !!}
				</p>

				<p>
					@if($campaign->title_slug === 'engage_boston_c')
						iCal: <a href="{{ asset('ical/engage_boston_pm.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_boston_p')
						iCal: <a href="{{ asset('ical/engage_boston_am.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_new_york_c')
						iCal: <a href="{{ asset('ical/engage_new_york_pm.ics') }}" download>
							Add to calendar
						</a>
					@elseif($campaign->title_slug === 'engage_new_york_p')
						iCal: <a href="{{ asset('ical/engage_new_york_am.ics') }}" download>
							Add to calendar
						</a>
					@endif
				</p>
				{!! Form::open(['route'=>'signup.forward','class'=>'form form-inline forward-form']) !!}
						
					{!! Form::text('email','',['class' => 'form-control','placeholder'=>"friend's email"] ) !!}
	
					{!! Form::hidden('campaign_id',$campaign->id,['class' => 'form-control','placeholder'=>''] ) !!}

					{!! Form::submit('Forward',['class'=> 'btn btn-default form-control']) !!}

				{!! Form::close() !!}
			</div>
		</div>

		<div class="col-xs-12 presenters">
			
			<h2>About The Panelists</h2>
			<table class="table">
				<tr>
					<td style="text-align:center;padding:0 20px 0 40px">
						<img src="{!! asset('img/cwt/engage/headshot_fagle.jpg') !!}" alt="Michael Fagle">
					</td>
					<td style="text-align:center;padding:0 40px 0 20px">
						<img src="{!! asset('img/cwt/engage/headshot_mitchell.jpg') !!}" alt="Charlie Mitchell">
					</td>
				</tr>
				<tr>
					<td >
						<p class="presenter">
							Michael (Mick) Fagle<br>
							Director of Marketing<br>
							Communications, Americas, CWT
						</p>
					</td>
					<td >
						<p class="presenter">
							Charlie Mitchell<br>
							Program Engineer, CWT
						</p>
					</td>
				</tr>
				<tr>
					<td >
						<p class="bio">
							Mick is responsible for maintaining a clear view of where the travel industry and markets are heading to ensure CWT focuses on leading edge solutions that bring value to our customers. In addition to marketing communications, his responsibilities also include brand marketing and public relations. Prior to joining CWT Mick lead the corporate marketing function for DuPont and Carlisle Asia Pacific.  
						</p>
					</td>
					<td >
						<p class="bio">
							Charlie started off in the hospitality industry doing hotel sourcing for meetings and events. He has since gone on to collect his Masters in Business Administration with an emphasis in Global Marketing. He now helps the product team by delivering business solutions for clients around the world. He spends his free time playing guitar and doing Ironman races. 
						</p>
					</td>
				</tr>
			</table>
			
		</div>

	</div>
</body>
</html>