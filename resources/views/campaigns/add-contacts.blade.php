@extends('layouts.admin')






@section('title')
	Add contacts to {{ $campaign->client->name }} | {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','Back',$campaign->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>['admin.campaign.contacts.post',$campaign->id],'method'=>'POST','class'=>'form','files'=>'true']) !!}
	

		
		<!-- Form Input -->
		<p>This excel spreadsheet should have its first row as a title row and include at least a column titled 'email'.  Additional useful columns are 'first_name, last_name, company, address, city, state and zip'</p>

		<div class="form-group">
			
			{!! Form::label('file','Excel Spreadsheet') !!}
			
			{!! Form::file('file',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
	
	{!! Form::close() !!}
	
	
@stop






