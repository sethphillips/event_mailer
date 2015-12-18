@extends('layouts.email')

@section('content')

<table width=100% bgcolor='white' style="text-align:center;border-collapse:collapse;" cellpadding="0" cellspacing="0">
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
				
			<table width="579" cellpadding="0" cellspacing="0" bgcolor='white' style="color:#6e6e6e;text-align:center;font-family:sans-serif; margin:auto;border-collapse:collapse;border:1px solid #5fcecf">
				<tr>
					<td>
						<img src="{!! asset('img/vitality/xmas_header.jpg') !!}" alt="Vitality" style="vertical-align:bottom;">
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
							<tr>
								<td>
									<img src="{!! asset('img/vitality/xmas_fireplace_left.jpg') !!}" alt="Vitality" style="vertical-align:bottom;">
								</td>
								<td>
									<img src="{!! asset('img/vitality/fire.gif') !!}" alt="Vitality" style="vertical-align:bottom;width:100%" width='321px' height='211px'>
								</td>
								<td>
									<img src="{!! asset('img/vitality/xmas_fireplace_right.jpg') !!}" alt="Vitality" style="vertical-align:bottom;">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<img src="{!! asset('img/vitality/xmas_happy_holidays.jpg') !!}" alt="Engage Header" style="width:100%;vertical-align:bottom;">
					</td>
				</tr>
				<tr>
					<td style="padding:0 50px 30px;">
						<p style="color:#6e6e6e;text-decoration:none;font-size:16px;margin-bottom:10px;margin-top:25px;line-height:2em;">
							Vitality would like to recognize and celebrate our partnership with you in creating real change to the health and well-being of your employees. And In the spirit of the season, Vitality has made a contribution on behalf of all our valued clients to the American Heart Association for their efforts in supporting workplace health promotion and prevention.

						</p>
						<p style="color:#6e6e6e;text-decoration:none;font-size:16px;margin-bottom:10px;margin-top:25px;line-height:2em;">
							Thank you for your many contributions in making people healthier and enhancing their lives with Vitality. We look forward to even more healthy results in improving the culture of health in your organization in 2016.
						</p>

					</td>
				</tr>
								
				<tr>
					<td>
						<a href='{{ URL::route("vitalityXmas") }}?email={{ $salted_id }}'>
							<img src="{!! asset('img/vitality/xmas_gift.jpg') !!}" alt="CWT Footer" style="width:100%;vertical-align:bottom;">
						</a>
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