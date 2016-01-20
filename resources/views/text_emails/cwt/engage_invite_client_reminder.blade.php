					
Smart data, big data, business intelligence...
The business travel world is driven by data.

Are you maximizing yours?

Join us at ENGAGE, an exclusive interactive event designed to show you exactly how to make your data work for you and deliver results.

Visit the signup page at {{ URL::route('engage_signup',['name'=>$campaign->title_slug]) }}?email={{ $salted_id }}
{!!  Carbon\Carbon::parse($campaign->event_date)->format('F j, Y') !!}
{!! $campaign->venue !!}
{!! $campaign->address !!}
{!! $campaign->city !!} {!! $campaign->state !!},  {!! $campaign->zip !!}
								

{{ $campaign->client->name }}
{{ $campaign->client->address }}, {{ $campaign->client->city }}, {{ $campaign->client->state }} {{ $campaign->client->zip }}