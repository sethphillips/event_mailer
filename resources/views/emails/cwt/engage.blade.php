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
						<img src="{!! asset('img/cwt/engage/header_2.jpg') !!}" alt="Engage Header" style="width:100%">
					</td>
				</tr>
				<tr>
					<td style="padding:0 30px">
						<p style="color:#ede6ce;text-decoration:none;font-size:18px;margin-bottom:10px;margin-top:25px;font-family:Verdana, Geneva, sans-serif;">
							Smart data, big data, business intelligence...<br>The business travel world is driven by data.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p style="color:white;text-decoration:none;font-size:18px;margin:5px;font-family:Verdana, Geneva, sans-serif;font-style:italic">
							Are you maximizing yours?
						</p>
					</td>
				</tr>
				
				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:18px;margin-bottom:5px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;background-color:#00aaad;color:white;padding:15px;">
							Join us at <b>ENGAGE</b>, an exclusive interactive event designed to show you exactly how to make your data work for you and deliver results.
						</p>
					</td>
				</tr>
				<tr>
				<td>
					
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td width="45%">
								<a href="{{ URL::route('engage_signup',['name'=>$campaign->title_slug]) }}?email={{ $salted_id }}">
									<img src="{!! asset('img/cwt/engage/register_button.png') !!}" style="width:100%">
								</a>
							</td>
							<td>
								<p style="font-size:17px;margin:45px 10px 45px 30px;font-family:Verdana, Geneva, sans-serif;text-align:left;">
									{!!  Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') !!}<br>
									{!! $campaign->venue !!}<br>
									{!! $campaign->address !!}<br>
									{!! $campaign->city !!} {!! $campaign->state !!},  {!! $campaign->zip !!}
								</p>
							</td>
						</tr>
					</table>
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