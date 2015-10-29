@extends('layouts.admin')






@section('title')
	Send a single email
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.index','Back',[],['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>'admin.email.post','method'=>'POST','class'=>'form']) !!}
	

		
		<!-- Form Input -->
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('email','Email Address') !!}
			
			{!! Form::text('email','',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		


		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('dateTime','Date and Time') !!}
			
			{!! Form::text('dateTime','',['class' => 'form-control','placeholder'=>'example: Oct 29th 3:30pm'] ) !!}
		
		</div>
		
		
		
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	
@stop






