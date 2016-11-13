@extends('layouts.admin')






@section('title')
  Edit {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
  {!! link_to_route('admin.campaigns.index','back','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')
  
  {!! Form::model($campaign,[
    'route'=>['admin.campaigns.update',$campaign->id],
    'method'=>'PUT',
    'class'=>'form']) 
  !!}
    
    @include('campaigns._fields')
    
  {!! Form::close() !!}
@stop






