@extends('layouts.admin')






@section('title')
	Schedule new TEST emails from an Excel sheet for {{ $touch->campaign->name }} | {{ $touch->title }}
@stop







@section('search')

@stop








@section('action')
	{!! link_to_route('admin.touches.show','Back',$touch->id,['class'=>'btn btn-primary']) !!}
@stop








@section('content')
	
	
	{!! Form::open(['route'=>['admin.emails.post',$touch->id],'method'=>'POST','class'=>'form','files'=>'true']) !!}
	

		
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






