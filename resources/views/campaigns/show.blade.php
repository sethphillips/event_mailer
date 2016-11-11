@extends('layouts.admin')






@section('title')
	{{ $campaign->client->name }} | {{ $campaign->name }}, {!! Carbon\Carbon::parse($campaign->event_date)->format('F jS Y') !!}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.index','back','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')

	@include('includes.campaign-sub-nav',['campaign'=>$campaign])

	
	<h3 class="section-header">Email Metrics</h3>

	@if ($campaign->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					sent {{ $campaign->sentEmails->count() }} / {{ $campaign->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($campaign->sentEmails->count() / $campaign->trackableEmails->count())*100 }}">{{ round( ($campaign->sentEmails->count() / $campaign->trackableEmails->count())*100,1 )}}%</div>
				</div>
			</div>
		</div>

		@foreach ($actions as $action)
			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $action->action }} {{ $action->count }} / {{ $campaign->trackableEmails->count() }}
					</div>
					<div class="panel-body">
						<div class="pie-chart" data-percent="{{ ($action->count / $campaign->trackableEmails->count())*100 }}">{{ round( ($action->count / $campaign->trackableEmails->count())*100,1) }}%</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif

	@if ($campaign->bounces->count() && $campaign->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Bounced {{ $campaign->bounces->count() }} / {{ $campaign->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($campaign->bounces->count() / $campaign->trackableEmails->count())*100 }}">{{ round( ($campaign->bounces->count() / $campaign->trackableEmails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	@if ($campaign->signups->count() && $campaign->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					Signups {{ $campaign->signups->count() }} / {{ $campaign->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($campaign->signups->count() / $campaign->trackableEmails->count())*100 }}">{{ round( ($campaign->signups->count() / $campaign->trackableEmails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	@if ($campaign->unsubscribes->count() && $campaign->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Unsubscribed {{ $campaign->unsubscribes->count() }} / {{ $campaign->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($campaign->unsubscribes->count() / $campaign->trackableEmails->count())*100 }}">{{ round( ($campaign->unsubscribes->count() / $campaign->trackableEmails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	<div class="clearfix"></div>


	<h3 class="section-header reports">Reports</h3>
	{!! link_to_route('admin.reports.contacts.campaign','Contact List',$campaign->id,['class'=>'btn btn-success','download'=>"$campaign->name contact list"]) !!}
	{!! link_to_route('admin.reports.actions.campaign','Email Metrics',$campaign->id,['class'=>'btn btn-success','download'=>"$campaign->name metrics"]) !!}
	@if ($campaign->signups->count())
		{!! link_to_route('admin.reports.signups.campaign','Event Signups',$campaign->id,['class'=>'btn btn-success','download'=>"$campaign->name signups"]) !!}
	@endif

	<h3 class="section-header touches">Touches</h3>

	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				<th>Subject Line</th>
				<th>Template</th>
				<th>Emails/Contacts</th>
				<th>Send On</th>
				<th>Title Slug</th>
				<th></th>
				<th>{!! link_to_route('admin.touches.create','Create New Touch',['campaign'=>$campaign->id],['class'=>'btn btn-success']) !!}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($campaign->touchs as $touch)
				<tr>
					<td>{!! link_to_route('admin.touches.show',$touch->title,$touch->id) !!}</td>
					<td>{{ $touch->subject }}</td>
					<td>{{ App\Touch::TEMPLATES[$touch->template] }}</td>
					<td>{{ $touch->trackableEmails->count() }}/{{ $campaign->validContacts->count() }}</td>
					<td>{!! Carbon\Carbon::parse($touch->send_on)->format('F jS Y h:i a') !!}</td>
					<td>{{ $touch->title_slug }}</td>
					<td>
						{!! link_to_route('admin.touches.edit','edit',$touch->id,['class'=>'btn btn-primary']) !!}
					</td>
					<td>

						{!! Form::open(['route'=>['admin.touches.destroy',$touch->id],'method'=>'DELETE','class'=>'form','onsubmit'=>'return deleteSubmit()']) !!}
	
							<div class="form-group">
							
								{!! Form::submit('Delete',['class'=> 'btn btn-danger form-control']) !!}
							
							</div>
							
						{!! Form::close() !!}

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>



	<h3 class="section-header">Contacts</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email Address</th>
				<th>Company</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($campaign->validContacts as $contact)
				@if (!$contact->bounced && !$contact->unsubscribed)
					<tr>
						<td>
							{{ $contact->first_name }} {{ $contact->last_name }}
						</td>
						<td>{{ $contact->email }}</td>
						<td>
							{{ $contact->company }}
						</td>
						<td>
							{!! Form::open( array( 'route'=>array('admin.campaign.contact.remove',$campaign->id,$contact->id),'method'=>'delete','onsubmit'=>'return deleteSubmit();' ) ) !!}
							{!! Form::submit('remove',array('class'=>'btn btn-danger'))!!}
							{!! Form::close()!!}
						</td>
					</tr>
				@endif
				
			@endforeach
		</tbody>
	</table>

@stop






