
<table width="580" cellpadding="0" cellspacing="0" bgcolor='#353133' style="background-color:#353133;color:#ede6ce;text-align:left;font-family:sans-serif; margin:auto;">
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
				<img src="{!! asset('img/cwt/engage/register_button_alt.png') !!}" style="width:80%;margin:15px 0;">
			</a>
		</td>
		
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="font-size:20px;font-family:Verdana, Geneva, sans-serif;margin:0 0 0 0;font-weight:bold;">
				{!! $campaign->venue !!}
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="font-size:20px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:bold;margin:0;">
				{{ $campaign->city }} | 7:30 - 11:00 a.m.<sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>
				
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:light;margin:0 0 15px 0;">
				<i><sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>Complimentary breakfast will be provided</i> 
			</p>
		</td>
	</tr>

	


	<tr>
		<td style="padding:0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:20px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
				Join us on a journey as we walk through making YOUR data work for YOU. ENGAGE.
			</p>
		</td>
	</tr>
	<tr>
		<td style="padding:0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:17px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
				We know you have questions when it comes to the vast amounts of data your travel program collects and how that data impacts your travel program. Let’s have a conversation about important questions, such as:
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding:0 40px">
			<ul style="color:#ede6ce;text-decoration:none;font-size:17px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
				<li style="padding:5px 0;">
					How can I optimize supplier agreements using the data from my travel program?
				</li>
				<li style="padding:5px 0;">
					How can I effectively influence traveler behavior to increase savings?
				</li>
				<li style="padding:5px 0;">
					How can I incorporate credit card data and expense reporting into my program?
				</li>
			</ul>
		</td>
	</tr>

	<tr>
		<td style="padding:0 0 0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:20px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
				We’ve got you covered!
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:17px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
				<b>ENGAGE</b> will spark conversation, inspire best practices and more important, take you from a world of facts, figures and reports to a world of connections, insights and possibilities.
			</p>
		</td>
	</tr>
	
	

	

	

	<tr>
		<td>
			<img src="{!! asset('img/cwt/engage/footer.jpg') !!}" alt="CWT Footer" style="width:100%">
		</td>
	</tr>
</table>
