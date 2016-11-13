@extends('layouts.admin')






@section('title')
  Create new campaign
@stop







@section('search')

@stop








@section('action')
  {!! link_to_route('admin.campaigns.index','back','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')
  
  {!! Form::open([
    'route'=>'admin.campaigns.store',
    'method'=>'POST',
    'class'=>'form'
  ])!!}
    
    @include('campaigns._fields')
    
  {!! Form::close() !!}
@stop






