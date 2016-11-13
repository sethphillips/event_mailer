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

	
	
	{!! Form::model($touch,[
		'route'=>['admin.touches.update',$touch->id],
		'method'=>'PUT',
		'class'=>'form'
	]) !!}
		
		@include('touches._fields')
		
	{!! Form::close() !!}
	
	

@stop






