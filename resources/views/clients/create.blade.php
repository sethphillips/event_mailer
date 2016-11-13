@extends('layouts.admin')






@section('title')
  Create new client
@stop







@section('search')

@stop








@section('action')
  {!! link_to_route('admin.clients.index','back','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')
  {!! Form::open([
    'route'=>'admin.clients.store',
    'method'=>'POST',
    'class'=>'form'
  ]) !!}
    
    @include('clients._fields')
    
  {!! Form::close() !!}
@stop






