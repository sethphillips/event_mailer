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
        
      <table width="600" cellpadding="0" cellspacing="0" bgcolor='#f0f0f0' style="color:#0d2240;text-align:center;font-family:sans-serif; margin:auto;">
        <tr>
          <td valign="bottom">
            <img src="{!! asset('img/ep/may16/bg_top.png') !!}" alt="EP Header" style="width:100%;vertical-align:bottom;">
          </td>
        </tr>
        



        <tr>
          <td style="padding:0 30px">
            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:10px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              Good morning Jill,
            
            </p>

            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:10px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              We hope you had an enjoyable weekend and a good start to the work week.
            
            </p>

            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:10px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              Knowing that we have a limited time to present today, we wanted to share this brief video that offers a taste of our capabilities and highlights a couple of projects that we won't cover today. Please feel free to share with your team if you feel that would be beneficial.               
            
            </p>

            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:10px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              <a href="https://www.youtube.com/watch?v=X8bjvoHOSFs">Video Title Here</a>
            
            </p>

            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:10px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              Thank you for this opportunity; we are looking forward to meeting you later and exploring this potential partnership.
            
            </p>

            <p style="color:#0d2240;text-decoration:none;font-size:12px; line-height:1.9em;margin-bottom:25px;margin-top:25px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;text-align:left;">

              Sincerely,<br>
              Matt &amp; the Exhibit Partners Team 
            
            </p>

          </td>
        </tr>

    
        
        
        <tr>
          <td>
            <img src="{!! asset('img/ep/may16/bg_bottom.png') !!}" alt="EP Footer" style="width:100%;vertical-align:bottom;">
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