@extends('layouts.admin')






@section('title')
	Dashboard
@stop







@section('search')

@stop








@section('action')

@stop








@section('content')

<div class="row">
	

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Total Emails
			</div>
			<div class="panel-body">
				{{ $campaign->emails->count() }}
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Emails Sent
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $sentPercentage }}">{{ $sentPercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Unsubscribed
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $unsubscribedPercentage }}">{{ $unsubscribedPercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Opened
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $openedPercentage }}">{{ $openedPercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Visited Website
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $websitePercentage }}">{{ $websitePercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Emailed Bill
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $emailedPercentage }}">{{ $emailedPercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-email"></i>
				Visited YouTube
			</div>
			<div class="panel-body">
				<div class="pie-chart" data-percent="{{ $youtubePercentage }}">{{ $youtubePercentage }}%</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	
</div>



	

@stop






