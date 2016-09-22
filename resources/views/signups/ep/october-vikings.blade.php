<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vikings Pre-Game RSVP</title>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" >
	<link rel="stylesheet" href="{!! elixir('dist/app.css') !!}">
    <script src="{!! elixir('dist/app.js') !!}"></script>
    <script src="https://use.typekit.net/qxp3jca.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body class="october-vikings tk-futura-pt">
	<div class="container">
		
		<img src="/img/ep/october16/logo_1.png" alt="exhibit partners" class="logo">
		<h1>Pre-Game Party</h1>
		<p>Monday, Oct .3 2016<br>4:00-7:30pm</p>
			
			@include('includes.flash')
			{!! Form::open(['route'=>'ep_vikings_submit','class'=>'form']) !!}
				
				<div class="form-group">
					<select name="self" id="self" class="form-control">
						<option value="" disabled selected>Attending?</option>
						<option value="yes">Yes, I will be there</option>
						<option value="no">No, I cant make it</option>
					</select>
				</div>

				<input type="hidden" name="salted_id" value="{{ $salted_id }}">

				<div class="form-group ">
					<select name="guest" id="guest" class="form-control hide">
						<option value="" disabled selected>Bringing a guest?</option>
						<option value="yes">Yes, I will have a guest</option>
						<option value="no">No, I will not have a guest</option>
					</select>
				</div>

				<button type='submit' id="submit" class="submit hide">RSVP</button>
				
			{!! Form::close() !!}
			
			<p style="margin-top:4em;">Edition Apartments,<br>511 South 4th Street, Minneapolis, MN 55415</p>

                

		</div>

			<div class="container footer">
	      <p style="font-size:15px;line-height:10px;margin-top:20px;margin-bottom:20px;">
	        <a target="_blank" href="http://www.exhibitpartners.com" style="text-decoration:none;color:black">exhibitpartners.com</a>
	        <span style="font-size:2em;vertical-align:middle;color:#009944"> | </span>
	        10100 85th Ave. N. Maple Grove, MN 55369
	        <span style="font-size:2em;vertical-align:middle;color:#009944"> | </span>763.231.2080
	      </p>

				<div>
					
				  <a target="_blank" href="https://www.facebook.com/ExhibitPartners/" style="text-decoration:none;color:black;"><img src="{!! asset('img/ep/october16/facebook.png') !!}" alt="facebook"></a>
				        
				                
				  <a target="_blank" href="https://twitter.com/exhibitpartners" style="text-decoration:none;color:black;"><img src="{!! asset('img/ep/october16/twitter.png') !!}" alt="twitter"></a>
				                
				  <a target="_blank" href="https://www.linkedin.com/company/exhibit-partners" style="text-decoration:none;color:black;"><img src="{!! asset('img/ep/october16/linkedin.png') !!}" alt="linkedin"></a>
				                
				  <a target="_blank" href="https://plus.google.com/110674481601065139758" style="text-decoration:none;color:black;"><img src="{!! asset('img/ep/october16/googleplus.png') !!}" alt="google plus"></a>
				                
				  <a target="_blank" href="https://www.pinterest.com/exhibitpartners/" style="text-decoration:none;color:black;"><img src="{!! asset('img/ep/october16/pintrest.png') !!}" alt="pintrest"></a>
				</div>
        
			</div>
	</div>
</body>
<script type="text/javascript">
	$('#self').on('change',function(){
		var value = $(this).val();
		if(value === 'yes'){
			$('#guest').removeClass('hide');
		}
		else{
			$('#guest').addClass('hide');
		}
		$('#submit').removeClass('hide');
	})
</script>
</html>



