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
  
  {!! Form::open(['route'=>['admin.clients.update',$client->id],'method'=>'PUT','class'=>'form']) !!}
    
    <div class="form-group">
      {!! Form::label('name') !!}
      {!! Form::text('name',$client->name,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('reply_to') !!}
      {!! Form::text('reply_to',$client->reply_to,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('address') !!}
      {!! Form::text('address',$client->address,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('city') !!}
      {!! Form::text('city',$client->city,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('state') !!}
      {!! Form::text('state',$client->state,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('zip') !!}
      {!! Form::text('zip',$client->zip,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
    </div>
    
  {!! Form::close() !!}
@stop






