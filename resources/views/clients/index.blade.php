@extends('layouts.admin')






@section('title')
	Clients
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.clients.create','New Client','',['class'=>'btn btn-success pull-right']) !!}
@stop








@section('content')

	
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Client Name</th>
				<th>Reply To</th>
				<th>Address</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clients as $client)
					<td>{{ $client->name }}</td>
					<td>{{ $client->reply_to }}</td>
					<td>{{ $client->address }}<br>{{ $client->city }} {{ $client->state }} {{ $client->zip }}</td>
					<td></td>
					<td></td>
					<td>
						{!! link_to_route('admin.clients.edit','edit',$client->id,['class'=>'btn btn-primary']) !!}
					</td>
					<td>
						{!! Form::open( array( 'route'=>array('admin.clients.destroy',$client->id),'method'=>'delete','onsubmit'=>'return deleteSubmit();' ) ) !!}
						{!! Form::submit('delete',array('class'=>'btn btn-danger'))!!}
						{!! Form::close()!!}
					</td>
				</tr>
				
			@endforeach
		</tbody>
	</table>


@stop






