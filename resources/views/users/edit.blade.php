@extends('layouts/admin')

@section('title')
Edit User: {{ $user->name }}
@stop
		

@section('action')
	{!! link_to_route('admin.users.index','back',[],['class'=>'btn btn-primary']) !!}
@stop

@section('content')

	{!! Form::open(array('route' => array('admin.users.update',$user->id),'method'=>'PUT')) !!}

	<div class="checkbox">
			<label>
				{!! Form::checkbox('is_admin',true,$user->is_admin) !!}
				Is an administrator
			</label>
		</div>

	<div class="form-group">
		{!! Form::label('name','Name') !!}
		{!! Form::text('name',$user->name,['class' => 'form-control','placeholder'=>'required'] ) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email','Email')!!}
		{!! Form::text('email',$user->email,array('class'=>'form-control'))!!}
	</div>


	<div class="form-group">
			
		{!! Form::label('client_id','Client Group') !!}
		{!! Form::select('client_id',App\User::clientsByName(),$user->client_id,['class' => 'form-control','placeholder'=>''] ) !!}
		
	</div>

	@if($user->email === Auth::user()->email)
		<div class="form-group">
			{!! Form::label('password','Change Your Password')!!}
			{!! Form::password('password',array('class'=>'form-control'))!!}
		</div>
		<div class="form-group">
			{!! Form::label('password2','Re-Enter New Password')!!}
			{!! Form::password('password2',array('class'=>'form-control'))!!}
		</div>
	@endif

	{!! Form::submit('Update User',array('class'=>'btn btn-success')) !!}
	{!! Form::close() !!}


@stop
