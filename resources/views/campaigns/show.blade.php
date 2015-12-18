@extends('layouts.admin')






@section('title')
	{{ $campaign->client->name }} | {{ $campaign->name }}, {!! Carbon\Carbon::parse($campaign->event_date)->format('F jS Y') !!}
@stop







@section('search')

@stop








@section('action')

@stop








@section('content')

	@include('includes.admin-sub-nav',['campaign'=>$campaign])

	
	<h3 class="section-header">Email Metrics</h3>

	<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
		<div class="panel panel-success">
			<div class="panel-heading">
				sent {{ $campaign->sentEmails->count() }} / {{ $campaign->emails->count() }}
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ ($campaign->sentEmails->count() / $campaign->emails->count())*100 }}">{{ ($campaign->sentEmails->count() / $campaign->emails->count())*100 }}%</div>
			</div>
		</div>
	</div>

	@foreach ($actions as $action)
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $action->action }} {{ $action->count }} / {{ $campaign->emails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($action->count / $campaign->emails->count())*100 }}">{{ round( ($action->count / $campaign->emails->count())*100,1) }}%</div>
				</div>
			</div>
		</div>
	@endforeach

	@if ($campaign->unsubscribes->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Unsubscribed {{ $campaign->unsubscribes->count() }} / {{ $campaign->emails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($campaign->unsubscribes->count() / $campaign->emails->count())*100 }}">{{ round( ($campaign->unsubscribes->count() / $campaign->emails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	<div class="clearfix"></div>


	<h3 class="section-header reports">Reports</h3>
	{!! link_to_route('admin.reports.actions','Email Metrics',$campaign->id,['class'=>'btn btn-success','download'=>"$campaign->name metrics"]) !!}
	@if ($campaign->signups->count())
		{!! link_to_route('admin.reports.signups','Event Signups',$campaign->id,['class'=>'btn btn-success','download'=>"$campaign->name signups"]) !!}
	@endif

	<h3 class="section-header">Email Preview</h3>
	<iframe src="{{ route('emails',$campaign->title_slug) }}" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe>

	<h3 class="section-header">Unsent Emails</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Recipient</th>
				<th>Email Address</th>
				<th>Send On</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($campaign->emails as $email)
				@if (!$email->sent)
				<tr>
					<td>
						{{ $email->contact->first_name }} {{ $email->contact->last_name }}
					</td>
					<td>{{ $email->contact->email }}</td>
					<td>
						{!! Carbon\Carbon::parse($email->send_on)->format('M jS, ga') !!}
					</td>
					<td>
						{!! Form::open( array( 'route'=>array('admin.emails.destroy',$email->id),'method'=>'delete','onsubmit'=>'return deleteSubmit();' ) ) !!}
						{!! Form::submit('delete',array('class'=>'btn btn-danger'))!!}
						{!! Form::close()!!}
					</td>
				</tr>
				@endif
			@endforeach
		</tbody>
	</table>

@stop






