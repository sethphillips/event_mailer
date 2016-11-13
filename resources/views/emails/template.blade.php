@extends('layouts.email')

@section('content')

<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
	{{ $preview_text }}
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
				
			{!! $template_html !!}

		</td>
	</tr>
	<tr>
		<td style="padding:0 20%">
			@if (isset($campaign))
				<p style="font-size:13px;line-height:12px;">
					<a href="{{ $campaign->website }}" style="color:black;">{{ $campaign->client->name }}</a><br>
					{{ $campaign->phone }}<br>
					{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}
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