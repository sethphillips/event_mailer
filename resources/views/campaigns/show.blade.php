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


	<h3>Unsent Emails</h3>
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






