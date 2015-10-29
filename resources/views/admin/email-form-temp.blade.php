@extends('layouts.admin')






@section('title')
	Schedule new emails from an Excel sheet
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.index','Back',[],['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>'admin.emails.post','method'=>'POST','class'=>'form','files'=>'true']) !!}
	

		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('file','Excel Spreadsheet') !!}
			
			{!! Form::file('file',['class' => 'form-control','placeholder'=>''] ) !!}
		
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






