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
  {!! Form::open(['route'=>'admin.clients.store','method'=>'POST','class'=>'form']) !!}
    
    <div class="form-group">
      {!! Form::label('name') !!}
      {!! Form::text('name','',['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('reply_to') !!}
      {!! Form::text('reply_to','',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('address') !!}
      {!! Form::text('address','',['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('city') !!}
      {!! Form::text('city','',['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('state') !!}
      {!! Form::text('state','',['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('zip') !!}
      {!! Form::text('zip','',['class'=>'form-control']) !!}
    </div> 


    <div class="form-group">
      {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
    </div> 
  {!! Form::close() !!}
@stop






