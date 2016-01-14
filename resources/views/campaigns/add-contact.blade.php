@extends('layouts.admin')






@section('title')
	Send a single email for {{ $campaign->client->name }} | {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','Back',$campaign->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>['admin.campaign.contact.post',$campaign->id],'method'=>'POST','class'=>'form']) !!}
	
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('email','Email Address') !!}
			
			{!! Form::text('email','',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>

		
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	
@stop






