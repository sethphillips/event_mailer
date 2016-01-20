@extends('layouts.email')

@section('content')

<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
	ENGAGE is an exclusive event that will spark conversation, inspire best practices and more important, take you from a world of facts, figures and reports to a world of connections, insights and possibilities. 
</div>

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
					<td>
						<a href="{{ URL::route('engage_signup',['name'=>$campaign->title_slug]) }}?email={{ $salted_id }}">
							<img src="{!! asset('img/cwt/engage/register_button_alt_2.png') !!}" style="width:80%;margin:15px 0;">
						</a>
					</td>
					
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:15px;font-family:Verdana, Geneva, sans-serif;margin:0 0 0 0;font-weight:bold;">
							{!! $campaign->venue !!}
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:15px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:bold;margin:0;">
							{{ $campaign->city }} | {{ $campaign->times }}<sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>
							
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:light;margin:0 0 15px 0;">
							<i><sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>{{ $campaign->html_one }}</i> 
						</p>
					</td>
				</tr>

				


				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
							Join us on a journey as we walk through making YOUR data work for YOU. ENGAGE.
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin-bottom:0;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
							What is CWT ENGAGE?
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:13px;margin-bottom:10px;margin-top:0px;font-family:Verdana, Geneva, sans-serif;">
							ENGAGE is an exclusive event that will spark conversation, inspire best practices and more important, take you from a world of facts, figures and reports to a world of connections, insights and possibilities. 
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin-bottom:0;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
							What can you expect?
						</p>
					</td>
				</tr>

				<tr>
					<td style="padding:0 40px; margin-top:0px;">
						<ul style="margin-top:0; padding-top:3px;">
							<li style="font-size:15px;color:#ede6ce;padding:0 0 3px 0;font-family:Verdana, Geneva, sans-serif;">
								Complimentary food, beverage &amp; networking
							</li>
							<li style="font-size:15px;color:#ede6ce;padding:3px 0;font-family:Verdana, Geneva, sans-serif;">
								Supplier showcase
							</li>
							<li style="font-size:15px;color:#ede6ce;padding:3px 0;font-family:Verdana, Geneva, sans-serif;">
								Main event: YOUR Data Works for YOU 
							</li>
							<li style="font-size:15px;color:#ede6ce;padding:3px 0;font-family:Verdana, Geneva, sans-serif;">
								 A live Q&amp;A with panelists with industry experts
							</li>
						</ul>
					</td>
				</tr>

				<tr>
					<td style="padding:0 0 0 40px">
						<p style="color:#ede6ce;text-decoration:none;font-size:15px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
							Who will be there?
						</p>
					</td>
				</tr>

				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" bgcolor='#353133' style="color:#ede6ce;text-align:left;font-family:sans-serif; margin:auto;">
							<tr>
								<td style="text-align:center;padding:0 20px 0 40px">
									<img src="{!! asset('img/cwt/engage/headshot_fagle.jpg') !!}" alt="Michael Fagle">
								</td>
								<td style="text-align:center;padding:0 40px 0 20px">
									<img src="{!! asset('img/cwt/engage/headshot_mitchell.jpg') !!}" alt="Charlie Mitchell">
								</td>
							</tr>
							<tr>
								<td style="padding:0 20px 0 40px">
									<p style="color:#ede6ce;text-decoration:none;font-size:11px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;text-align:center;">
										Michael (Mick) Fagle<br>
										Director of Marketing<br>
										Communications, Americas, CWT
									</p>
								</td>
								<td style="padding:0 40px 0 20px">
									<p style="color:#ede6ce;text-decoration:none;font-size:11px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;text-align:center;">
										Charlie Mitchell<br>
										Program Engineer, CWT
									</p>
								</td>
							</tr>
							<tr>
								<td style="padding:0 20px 0 40px">
									<p style="color:#ede6ce;text-decoration:none;font-size:10px;margin-bottom:10px;margin-top:0px;font-family:Verdana, Geneva, sans-serif;">
										Mick is responsible for maintaining a clear view of where the travel industry and markets are heading to ensure CWT focuses on leading edge solutions that bring value to our customers. In addition to marketing communications, his responsibilities also include brand marketing and public relations. Prior to joining CWT Mick lead the corporate marketing function for DuPont and Carlisle Asia Pacific.  
									</p>
								</td>
								<td style="padding:0 40px 0 20px">
									<p style="color:#ede6ce;text-decoration:none;font-size:10px;margin-bottom:10px;margin-top:0px;font-family:Verdana, Geneva, sans-serif;">
										Charlie started off in the hospitality industry doing hotel sourcing for meetings and events. He has since gone on to collect his Masters in Business Administration with an emphasis in Global Marketing. He now helps the product team by delivering business solutions for clients around the world. He spends his free time playing guitar and doing Ironman races. 
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
		<td style="padding:0 20%">
			@if (isset($campaign))
				<p style="font-size:13px;text-align:justify">
					With offices in more than 150 countries and territories, Carlson Wagonlit Travel deploys the right people, processes, technologies and skills to consistently deliver effective travel management and bottom-line results.<br>
				</p>
				<p style="font-size:13px;line-height:12px;">
					<a href="http://www.carlsonwagonlit.com" style="color:black;">Carlson Wagonlit Travel</a><br>
					{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}
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