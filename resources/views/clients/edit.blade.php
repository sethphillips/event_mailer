@extends('layouts.admin')






@section('title')
  Edit {{ $client->name }}
@stop







@section('search')

@stop








@section('action')
  {!! link_to_route('admin.clients.index','back','',['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')
  
  {!! Form::model($client,[
    'route'=>['admin.clients.update',$client->id],
    'method'=>'PUT',
    'class'=>'form'
  ]) !!}
    
    @include('clients._fields')
    
  {!! Form::close() !!}
@stop






