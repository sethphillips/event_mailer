@extends('layouts.admin')






@section('title')
	Schedule new emails from an Excel sheet for {{ $campaign->client->name }} | {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','Back',$campaign->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>['admin.emails.post',$campaign->id],'method'=>'POST','class'=>'form','files'=>'true']) !!}
	

		
		<!-- Form Input -->
		<p>This excel spreadsheet should have its first row as a title row and include at least a column titled 'email'.  Additional useful columns are 'first_name, last_name, address, city, state and zip'</p>

		<div class="form-group">
			
			{!! Form::label('file','Excel Spreadsheet') !!}
			
			{!! Form::file('file',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>


		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('subject','Subject Line') !!}
			
			{!! Form::text('subject','',['class' => 'form-control','placeholder'=>'example: Save The Date!'] ) !!}
		
		</div>

		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('dateTime','Date and Time') !!}
			
			{!! Form::text('dateTime','',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		
		
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	
@stop






