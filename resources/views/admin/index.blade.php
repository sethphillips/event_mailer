@extends('layouts.admin')






@section('title')
	Dashboard
@stop







@section('search')

@stop








@section('action')

@stop








@section('content')

	<h3></h3>

	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Google Analytics {{ Carbon\Carbon::now()->subMonth(1)->toFormattedDateString() }} - {{ Carbon\Carbon::now()->toFormattedDateString() }}
			</div>
			<div class="panel-body">
				
				@include('includes.admin-google-analytics',['data'=>$googleCore['ga:users'],'metric'=>'Visitors','icon'=>'fa-user','danger'=>$googleCore['ga:users']<20])

				@include('includes.admin-google-analytics',['data'=>$googleCore['ga:newUsers'],'metric'=>'New Visitors','icon'=>'fa-user-plus','danger'=>false])

				@include('includes.admin-google-analytics',['data'=>$googleSocial['ga:socialActivities'],'metric'=>'Social Shares','icon'=>'fa-users','danger'=>$googleSocial['ga:socialActivities']<5])

				@include('includes.admin-google-analytics',['data'=>round($googleCore['ga:avgSessionDuration']/60,1).'min','metric'=>'Time on Site','icon'=>'fa-clock-o','danger'=>round($googleCore['ga:avgSessionDuration']/60,1)<1])

				@include('includes.admin-google-analytics',['data'=>round($googleCore['ga:avgPageLoadTime']).'sec','metric'=>'Page Load','icon'=>'fa-clock-o','danger'=>round($googleCore['ga:avgPageLoadTime'])>3])
				
				@include('includes.admin-google-analytics',['data'=>round($googleCore['ga:bounceRate']).'%','metric'=>'Bounce Rate','icon'=>'fa-meh-o','danger'=>$googleCore['ga:bounceRate']>65])

			</div>
		</div>
	</div>

	<div class="clearfix"></div>

	



	<div class="col-xs-6">
		<div class="panel @if($mastheadValid <= 1) panel-danger @else panel-default @endif">
			<div class="panel-heading">HomePage Masthead</div>
			<div class="panel-body">
				<div class="medium text-center">{{ $mastheadValid }} items in rotation</div>
			</div>
			<div class="panel-footer">
				@if($mastheadExpire->count())
					<p class="alert alert-danger">
						The following items will expire in the next week: 
						@foreach ($mastheadExpire as $item)
							{{ $item->title }}, 
						@endforeach
					</p>
				@endif
			</div>
		</div>
	</div>

	<div class="col-xs-6">
		<div class="panel @if($eventsValid <= 2) panel-danger @else panel-default @endif">
			<div class="panel-heading">Upcoming Events</div>
			<div class="panel-body">
				<div class="medium text-center">{{ $eventsValid }} upcoming events</div>
			</div>
			<div class="panel-footer">
				@if($mastheadExpire->count())
					<p class="alert alert-info">
						The following events happen within 7 days: 
						@foreach ($eventsExpire as $item)
							{{ $item->title }}, 
						@endforeach
					</p>
				@endif
			</div>
		</div>
	</div>

	<div class="clearfix"></div>



	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Most Recent Manuals and Documents</div>
			<div class="panel-body">
				<table class="table small">
					<thead>
						<tr>
							<td>Document Type</td>
							<td>Version</td>
							<td>Updated</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($manuals as $title=>$manual)
							<tr>
								<td>{{ $title }}</td>
								@if ($manual)
									<td>{{ $manual->version }}</td>
									<td>{{ $manual->updated_at }}</td>
								@else
									<td>N/A</td>
									<td>N/A</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>



	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">General Content</div>
			<div class="panel-body">
				
				@include('includes.admin-dashboard-content-count',['title'=>'Articles','count'=>$articleCount,'danger'=>$articleCount<20])

				@include('includes.admin-dashboard-content-count',['title'=>'Compliments','count'=>$complimentCount,'danger'=>$complimentCount<5])

				@include('includes.admin-dashboard-content-count',['title'=>'Awards','count'=>$awardCount,'danger'=>$awardCount<5])

				@include('includes.admin-dashboard-content-count',['title'=>'Gallery Images','count'=>$galleryCount,'danger'=>$galleryCount<15])

				@include('includes.admin-dashboard-content-count',['title'=>'Media Items','count'=>$channelCount,'danger'=>$channelCount<15])

			</div>
		</div>
	</div>

@stop






