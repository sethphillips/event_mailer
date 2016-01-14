@extends('layouts.admin')






@section('title')
	Send a single email for {{ $touch->campaign->name }} | {{ $touch->title }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.touches.show','Back',$touch->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>['admin.email.post',$touch->id],'method'=>'POST','class'=>'form']) !!}
	

		
		<!-- Form Input -->
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('email','Email Address') !!}
			
			{!! Form::text('email','',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>

		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('subject','Subject Line') !!}
			
			{!! Form::text('subject','',['class' => 'form-control','placeholder'=>'example: Save The Date!'] ) !!}
		
		</div>
	
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	
@stop






