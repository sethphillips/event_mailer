@extends('layouts.admin')






@section('title')
	Edit {{ $touch->campaign->name }} {{ $touch->title }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.campaigns.show','back',$touch->campaign->id,['class'=>'btn btn-default']) !!}
@stop








@section('content')

	
	
	{!! Form::open(['route'=>['admin.touches.update',$touch->id],'method'=>'PUT','class'=>'form']) !!}
	
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('title','Title') !!}
			
			{!! Form::text('title',$touch->title,['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('send_on','Send On Date & Time') !!}
			
			{!! Form::text('send_on',$touch->send_on,['class' => 'form-control','placeholder'=>'Jan 15 9:00 am'] ) !!}
		
		</div>


		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('subject','Email Subject Line') !!}
			
			{!! Form::text('subject',$touch->subject,['class' => 'form-control','placeholder'=>'this is what your recipients will see'] ) !!}
		
		</div>
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('title_slug','Title Slug (do not change this after sending emails, it will break links)')  !!}
			
			{!! Form::text('title_slug',$touch->title_slug,['class' => 'form-control','placeholder'=>'this is a unique string that is used in the url of the web browser display.  ie: ep_halloween_greeting'] ) !!}
		
		</div>
		
		
		
		<!-- Form Input -->
		
		<div class="form-group">
			
			{!! Form::label('template','HTML Template') !!}
			
			{!! Form::select('template',App\Touch::TEMPLATES,$touch->template,['class' => 'form-control','placeholder'=>''] ) !!}
		
		</div>
		
		
		
		<!-- Submit Button -->
		<div class="form-group">
		
			{!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
		
		</div>
		
		
		
		
		
	
	{!! Form::close() !!}
	
	

@stop






