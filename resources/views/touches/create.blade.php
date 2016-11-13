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
		{!! Form::hidden('campaign_id',$campaign->id,['class' => 'form-control','placeholder'=>''] ) !!}
		
		@include('touches._fields')
		
	{!! Form::close() !!}
	
	

@stop






