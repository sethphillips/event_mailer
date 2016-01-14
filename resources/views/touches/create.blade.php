@extends('layouts.admin')






@section('title')
	Create new Touch for {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','back',$campaign->id,['class'=>'btn btn-default']) !!}
@stop








@section('content')

	
	
	{!! Form::open(['route'=>'admin.touches.store','method'=>'POST','class'=>'form']) !!}
	
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('title','Title') !!}
			
			{!! Form::text('title','',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		

			
		{!! Form::hidden('campaign_id',$campaign->id,['class' => 'form-control','placeholder'=>''] ) !!}
		
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('send_on','Send On Date & Time') !!}
			
			{!! Form::text('send_on','',['class' => 'form-control','placeholder'=>'Jan 15 9:00 am'] ) !!}
		
		</div>


		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('subject','Email Subject Line') !!}
			
			{!! Form::text('subject','',['class' => 'form-control','placeholder'=>'this is what your recipients will see'] ) !!}
		
		</div>
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('title_slug','Title Slug (do not change this after sending emails, it will break links)')  !!}
			
			{!! Form::text('title_slug','',['class' => 'form-control','placeholder'=>'this is a unique string that is used in the url of the web browser display.  ie: ep_halloween_greeting'] ) !!}
		
		</div>
		
		<div class="form-group">
			
			{!! Form::label('template','HTML Template') !!}
			
			{!! Form::select('template',App\Touch::TEMPLATES,'',['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	

@stop






