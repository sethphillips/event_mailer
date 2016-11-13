
<table width="506" cellpadding="0" cellspacing="0" bgcolor='#353133' style="background-color:#353133;color:#ede6ce;text-align:left;font-family:sans-serif; margin:auto;">
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
		<td style="padding:0 0 0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:22px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;font-weight:bold;">
				Your Data Works for YOU
			</p>
		</td>
	</tr>
	<tr>
		<td style="padding:0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:17px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
				Smart data, big data, business intelligence … The business travel world is driven by data. Are you maximizing yours?
			</p>
		</td>
	</tr>
	<tr>
		<td style="padding:0 40px">
			<p style="color:#ede6ce;text-decoration:none;font-size:17px;margin-bottom:10px;margin-top:10px;font-family:Verdana, Geneva, sans-serif;">
				Join us at ENGAGE, an exclusive interactive event designed to spark conversation and show you exactly how to make your data work for you and deliver results.
			</p>
		</td>
	</tr>
	
	<tr>
		<td>
			<a href="{{ URL::route('engage_signup',['name'=>$campaign->title_slug]) }}?email={{ $salted_id }}">
				<img src="{!! asset('img/cwt/engage/register_button.png') !!}" style="width:70%;margin-top:15px;">
			</a>
		</td>
		
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="font-size:15px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:bold;margin:10px 0 0 0;">
				
				{!!  Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') !!} 
				
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding:0 40px">
			<p style="font-size:15px;font-family:Verdana, Geneva, sans-serif;text-align:left;font-weight:light;margin:0;">
				7:30 - 11:00 a.m.<sup style=”line-height:1; vertical-align:baseline;_vertical-align: bottom;position: relative;bottom: 1ex;font-size:11px !important;”>*</sup>
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
			<p style="font-size:15px;font-family:Verdana, Geneva, sans-serif;margin:0 0 10px 0;font-weight:light;">
				{!! $campaign->venue !!}<br>
				{!! $campaign->address !!}<br>
				{!! $campaign->city !!} {!! $campaign->state !!},  {!! $campaign->zip !!}
			</p>
		</td>
	</tr>

	<tr>
		<td>
			<img src="{!! asset('img/cwt/engage/footer.jpg') !!}" alt="CWT Footer" style="width:100%">
		</td>
	</tr>
</table>
