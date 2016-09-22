@extends('layouts.admin')






@section('title')
	{{ $touch->campaign->name }} | {{ $touch->title }} 
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','Back',$touch->campaign->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')

	@include('includes.touch-sub-nav',['touch'=>$touch])

	
	<h3 class="section-header">Email Metrics</h3>

	@if ($touch->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					sent {{ $touch->sentEmails->count() }} / {{ $touch->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($touch->sentEmails->count() / $touch->trackableEmails->count())*100 }}">{{ round( ($touch->sentEmails->count() / $touch->trackableEmails->count())*100,1 )}}%</div>
				</div>
			</div>
		</div>

		@foreach ($actions as $action)
			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ $action->action }} {{ $action->count }} / {{ $touch->trackableEmails->count() }}
					</div>
					<div class="panel-body">
						<div class="pie-chart" data-percent="{{ ($action->count / $touch->trackableEmails->count())*100 }}">{{ round( ($action->count / $touch->trackableEmails->count())*100,1) }}%</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif

	@if ($touch->bounces->count() && $touch->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Bounced {{ $touch->bounces->count() }} / {{ $touch->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($touch->bounces->count() / $touch->trackableEmails->count())*100 }}">{{ round( ($touch->bounces->count() / $touch->trackableEmails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	@if ($touch->unsubscribes->count() && $touch->trackableEmails->count())
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Unsubscribed {{ $touch->unsubscribes->count() }} / {{ $touch->trackableEmails->count() }}
				</div>
				<div class="panel-body">
					<div class="pie-chart" data-percent="{{ ($touch->unsubscribes->count() / $touch->trackableEmails->count())*100 }}">{{ round( ($touch->unsubscribes->count() / $touch->trackableEmails->count())*100,1)}}%</div>
				</div>
			</div>
		</div>
	@endif

	<div class="clearfix"></div>


	<h3 class="section-header reports">Reports</h3>
	{!! link_to_route('admin.reports.actions.touch','Email Metrics',$touch->id,['class'=>'btn btn-success','download'=>"$touch->title metrics"]) !!}
	

	<h3 class="section-header"> @if($touch->campaign->validContacts->count() - $touch->trackableEmails->count() <= 0) No @else {!! $touch->campaign->validContacts->count() - $touch->trackableEmails->count() !!}@endif UnQueued Contacts</h3>


	
	{!! Form::open(['route'=>['admin.touch.queueEmails',$touch->id],'method'=>'post','class'=>'form']) !!}
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Queue UnEmailed Contacts',['class'=> 'btn btn-warning']) !!}
		
		</div>
	
	{!! Form::close() !!}
	
	

	<h3 class="section-header">Email Preview</h3>
	<iframe src="{{ route('emails',$touch->title_slug) }}" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe>

	

@stop






