@extends('layouts/admin')

@section('title')
Create a User
@stop

		

@section('content')

		{!! Form::open(array('route' => array('admin.users.store'))) !!}

		
		
		<!-- Form Input -->
		
		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name','',['class' => 'form-control','placeholder'=>'required'] ) !!}
		</div>
		
		
		<div class="form-group">
			{!! Form::label('email','Email')!!}
			{!! Form::text('email','',array('class'=>'form-control'))!!}
		</div>
		<div class="form-group">
			{!! Form::label('password','Password')!!}
			{!! Form::password('password',array('class'=>'form-control'))!!}
		</div>
		<div class="form-group">
			{!! Form::label('password2','Re-Enter Password')!!}
			{!! Form::password('password2',array('class'=>'form-control'))!!}
		</div>


		{!! Form::submit('Create User',array('class'=>'btn btn-success')) !!}
		{!! Form::close() !!}


@stop
