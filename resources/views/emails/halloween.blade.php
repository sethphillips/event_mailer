
	
<table width="580" cellpadding="0" cellspacing="0" bgcolor='black' style="background-color:black;color:white;text-align:center;font-family:sans-serif; margin:auto;">
	<tr>
		<td>
			<img src="{!! asset('img/halloween/email_01.jpg') !!}" alt="Spooky Header">
		</td>
	</tr>
	<tr>
		<td>
			<h2 style="color:white;text-decoration:none">A Little Treat for Your Halloween Weekend!</h2>
		</td>
	</tr>
	<tr>
		<td style="padding:0 50px">
			<h3 style="color:white;text-decoration:none">
				We can’t send candy, but we think this video will brighten your day.  We had a lot of fun making it and we hope you enjoy watching!
			</h3>
		</td>
	</tr>
	<tr>
		<td>
			<a href="{{ URL::route('video') }}?email={{ $salted_id }}" style="color:white;text-decoration:none">
				<img src="{!! asset('img/halloween/email_02.jpg') !!}" alt="a treat for you">
			</a>
		</td>
	</tr>
	<tr>
		<td>
			<p>(Click the link to check out our new trick)</p>
		</td>
	</tr>
	<tr>
		<td>
			<img src="{!! asset('img/halloween/email_03.jpg') !!}" alt="frightened couple">
		</td>
	</tr>
	<tr>
		<td>
			<table width="580" style="text-align:left">
				<tr>
					<td>
						<a href="http://www.exhibitpartners.com" target="_blank" style="color:white;text-decoration:none">
							<img src="{!! asset('img/halloween/email_logo.jpg') !!}" alt="exhibit partners logo">
						</a>
					</td>
					<td width="330">
					@if (isset($campaign))
						<p style="font-size:11px;line-height:10px;">
							{{ $campaign->client->name }}<br>
							{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}
						</p>
					@else
						&nbsp;
					@endif
					</td>
					<td>
						<a href="https://www.facebook.com/ExhibitPartners" style="color:white;text-decoration:none">
							<img src="{!! asset('img/halloween/email_facebook.jpg') !!}" alt="facebook">
						</a>
					</td>
					<td>
						<a href="https://twitter.com/exhibitpartners" style="color:white;text-decoration:none">
							<img src="{!! asset('img/halloween/email_twitter.jpg') !!}" alt="twitter">
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
