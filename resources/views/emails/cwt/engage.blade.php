@extends('layouts.email')

@section('content')

<table width=100% bgcolor='white' style="text-align:center;" >
	@if($email)
		<tr>
			<td>
				<img src="{{ URL::route('tracking') }}?email={{ $salted_id }}" alt="thanks" style:"display-hidden">
			</td>
		</tr>
		<tr>
			<td>
				<a href='{{ URL::route("emails",["title_slug"=>$campaign->title_slug]) }}?email={{ $salted_id }}' style="color:black;">Can't view this email? Click Here</a>
			</td>
		</tr>
	@endif
	<tr>
		<td>
				
			<table width="506" cellpadding="0" cellspacing="0" bgcolor='#353133' style="color:#ede6ce;text-align:center;font-family:sans-serif; margin:auto;">
				<tr>
					<td valign="bottom">
						<img src="{!! asset('img/cwt/engage/top_spacer.jpg') !!}" alt="spacer" style="width:100%;vertical-align:bottom;">
					</td>
				</tr>
				<tr>
					<td bgcolor="#efefef" style="background-color:#efefef;">
						<p style="color:#00aaad;font-size:1.2em;font-weight:lighter;margin:5px 0"> {!!  strtoupper( $campaign->city . ' | ' . Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') )!!}</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="{!! asset('img/cwt/engage/header.jpg') !!}" alt="Engage Header" style="width:100%">
					</td>
				</tr>
				<tr>
					<td>
						<p style="color:#ede6ce;text-decoration:none;font-size:20px;margin:0;margin-bottom:.5em;font-family:Verdana, Geneva, sans-serif;">
							Your Data Works for You.
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding:0 50px">
						<p style="color:#ede6ce;text-decoration:none;font-size:20px;margin-bottom:0;font-family:Verdana, Geneva, sans-serif;">
							Smart data, big data, business intelligence... the buzzwords abound.
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding:0 50px">
						<hr>
					</td>
				</tr>
				<tr>
					<td style="padding:0 50px">
						<p style="color:#ede6ce;text-decoration:none;font-size:20px;margin:0;font-family:Verdana, Geneva, sans-serif;">
							Data only matters when it solves real problems. Join us to learn how your data can deliver results.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p style="font-size:20px;color:#00aaad;font-family:Verdana, Geneva, sans-serif;">
							WE’RE COMING TO YOUR CITY!<br>INVITATION COMING SOON!
						</p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p style="font-size:20px;margin:0;font-family:Verdana, Geneva, sans-serif;">
							{!!  strtoupper( Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') )!!}
						</p>
						<p style="font-size:20px;margin:0;font-family:Verdana, Geneva, sans-serif;">
							{{ $campaign->venue }}<br>
							{{ $campaign->address }}<br>
							{{ $campaign->city }} {{ $campaign->state }},  {{ $campaign->zip }}
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="{!! asset('img/cwt/engage/footer.jpg') !!}" alt="CWT Footer" style="width:100%">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			@if (isset($campaign))
				<p style="font-size:11px;line-height:10px;">
					{{ $campaign->client->name }}<br>
					{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}
				</p>
			@else
				&nbsp;
			@endif
			</td>
		</tr>
	<tr>
		<td>Want to <a href="{!! URL::route('unsubscribe.form') !!}">Unsubscribe</a>?</td>
	</tr>
</table>

@stop