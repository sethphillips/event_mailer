@extends('layouts.admin')






@section('title')
	Email Campaigns
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.create','create new','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')
	
	<table class="table table-striped">
		
		<thead>
			<tr>
				<th>Event Name</th>
				<th>Client</th>
				<th>Event Date</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($campaigns as $campaign)
				<tr>
					
					<td>{{ $campaign->name }}</td>
					<td>{{ $campaign->client->name }}</td>
					<td>{{ $campaign->event_date }}</td>
					<td>
						{!! link_to_route('admin.campaigns.show','show',$campaign->id,['class'=>'btn btn-success']) !!}
					</td>
					<td>
						{!! link_to_route('admin.campaigns.edit','edit settings',$campaign->id,['class'=>'btn btn-primary']) !!}
					</td>
					<td>
						{!! Form::open( array( 'route'=>array('admin.campaigns.destroy',$campaign->id),'method'=>'delete','onsubmit'=>'return deleteSubmit();' ) ) !!}
						{!! Form::submit('delete',array('class'=>'btn btn-danger'))!!}
						{!! Form::close()!!}			
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop






