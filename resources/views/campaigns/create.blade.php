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
  
  {!! Form::open(['route'=>'admin.campaigns.store','method'=>'POST','class'=>'form']) !!}
    
    <div class="form-group">
      {!! Form::label('name') !!}
      {!! Form::text('name','',['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('client_id', 'Client') !!}
      {!! Form::select('client_id',$clients,0,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('event_date') !!}
      {!! Form::text('event_date','',['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('venue') !!}
      {!! Form::text('venue','',['class'=>'form-control']) !!}
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
      {!! Form::label('html_one','Extra Info One') !!}
      {!! Form::textarea('html_one','',['class'=>'form-control','placeholder'=>'put any info here including html']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('html_two','Extra Info Two') !!}
      {!! Form::textarea('html_two','',['class'=>'form-control','placeholder'=>'put any info here including html']) !!}
    </div> 

    <div class="form-group">
      {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
    </div>
    
  {!! Form::close() !!}
@stop






