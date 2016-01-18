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
				<a href='{{ URL::route("emails",["title_slug"=>$touch->title_slug]) }}?email={{ $salted_id }}' style="color:black;">Can't view this email? Click Here</a>
			</td>
		</tr>
	@endif
	<tr>
		<td>
				
			<table width="580" cellpadding="0" cellspacing="0" bgcolor='#353133' style="color:#ede6ce;text-align:left;font-family:sans-serif; margin:auto;">
				<tr>
					<td valign="bottom">
						<img src="{!! asset('img/cwt/engage/top_spacer.jpg') !!}" alt="spacer" style="width:100%;vertical-align:bottom;">
					</td>
				</tr>
				<tr>
					<td bgcolor="#efefef" style="background-color:#efefef;">
						<p style="color:#00aaad;font-size:1.2em;font-weight:lighter;margin:5px 0;text-align:center;"> {!!  strtoupper( $campaign->city . ' | ' . Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') )!!}</p>
					</td>
				</tr>
				<tr>
					<td>
						<img src="{!! asset('img/cwt/engage/header_invite.jpg') !!}" alt="Engage Header" style="width:100%">
					</td>
				</tr>

				

				


				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:17px;margin:0;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
							5 Ways you’re losing money today.
						</p>
					</td>
				</tr>
				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin:0 0 15px 0;font-family:Verdana, Geneva, sans-serif;">
							Running a successful travel program is tough. There are so many factors to consider, balance and coordinate—and you have to do it all while saving your company money.
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<table cellpadding="0" cellspacing="0" width="100%" style="font-size:13px;">
							<tr>
								<td style="text-align:center;vertical-align:middle;">
									<img src="{!! asset('img/cwt/engage/icon_spend.png') !!}" alt="" style="margin-bottom:15px;">
								</td>
								<td style="padding-left:25px; font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
									<li style="text-indent:-11px; margin-bottom:15px;font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
										 <b>Invisible spend</b> – If you aren’t tracking key data points such as credit card spend, you’re missing where your travelers are booking out of policy.
									</li>
								</td>
							</tr>
							<tr>
								<td style="text-align:center;vertical-align:middle;">
									<img src="{!! asset('img/cwt/engage/icon_agreements.png') !!}" alt="" style="margin-bottom:15px;">
								</td>
								<td style="padding-left:25px; font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
									<li style="text-indent:-11px; margin-bottom:15px;font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
										 <b>Supplier agreements</b> – This is a no brainer for getting the biggest bang for your buck. Analyze your routes and determine where your travelers are booking direct, so you’re armed with the data you need to negotiate. 
									</li>
								</td>
							</tr>
							<tr>
								<td style="text-align:center;vertical-align:middle;">
									<img src="{!! asset('img/cwt/engage/icon_behavior.png') !!}" alt="" style="margin-bottom:15px;">
								</td>
								<td style="padding-left:25px; font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
									<li style="text-indent:-11px; margin-bottom:15px;font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
										 <b>Traveler behavior</b> – Last minute, out-of-policy, not booking air + hotel at the same time, oh my! If you don’t know what kinds of buying decisions your travelers are making, you can’t develop a way to positively influence booking behavior.
									</li>
								</td>
							</tr>
							<tr>
								<td style="text-align:center;vertical-align:middle;">
									<img src="{!! asset('img/cwt/engage/icon_technology.png') !!}" alt="" style="margin-bottom:15px;">
								</td>
								<td style="padding-left:25px; font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
									<li style="text-indent:-11px; margin-bottom:15px;font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
										  <b>Right technology</b> – A successful travel program is built on so much more than just a reporting tool. Review your technology to ensure that all the tools work together to meet your program goals. 
									</li>
								</td>
							</tr>
							<tr>
								<td style="text-align:center;vertical-align:middle;">
									<img src="{!! asset('img/cwt/engage/icon_satisfaction.png') !!}" alt="" style="margin-bottom:15px;">
								</td>
								<td style="padding-left:25px; font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
									<li style="text-indent:-11px; margin-bottom:15px;font-weight:lighter;color:#ede6ce;font-family:Verdana, Geneva, sans-serif;">
										 <b>Traveler satisfaction</b> – Unhappy frequent travelers can cost you BIG bucks. Make sure your road warriors are cared for so they remain compliant to policy and can be productive while on the road.
									</li>
								</td>
							</tr>
						</table>

					</td>
				</tr>


				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
							Join us on journey where we’ll walk you through making YOUR data work for YOU. ENGAGE.
						</p>
					</td>
				</tr>
				
				

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:17px;font-family:Verdana, Geneva, sans-serif;margin:15px 0 0 0;font-weight:bold;">
							{!! $campaign->venue !!}
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:17px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:bold;margin:0;">
							{{ $campaign->city }} | 4:00 - 7:30 p.m. EST
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:light;margin:0 0 15px 0;">
							<i><sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>Complimentary cocktails and hors d'oeuvres will be provided</i> 
						</p>
					</td>
				</tr>

				<tr>
					<td>
						<a href="{{ URL::route('engage_signup',['name'=>$campaign->title_slug]) }}?email={{ $salted_id }}">
							<img src="{!! asset('img/cwt/engage/register_button_alt_2.png') !!}" style="width:65%;margin:15px 0 0 0;">
						</a>
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
		<td style="padding:0 20%">
			@if (isset($campaign))
				<p style="font-size:13px;line-height:12px;">
					<a href="http://www.carlsonwagonlit.com" style="color:black;">Carlson Wagonlit Travel</a><br>
					{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}
				</p>
				<p style="font-size:13px;text-align:justify">
					With offices in more than 150 countries and territories, Carlson Wagonlit Travel deploys the right people, processes, technologies and skills to consistently deliver effective travel management and bottom-line results.<br>
				</p>
				<p style="font-size:13px;text-align:center;">
					<a href="mailto:CWTNORAMmarketingevents@carlsonwagonlit.com " style="color:black;">Questions?</a><br>
				</p>
			@else
				&nbsp;
			@endif
			</td>
		</tr>
	<tr>
		<td style="font-size:12px;"><a href="{!! URL::route('unsubscribe.form') !!}">Unsubscribe</a>?</td>
	</tr>
</table>

@stop