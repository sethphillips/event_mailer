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
  
  {!! Form::open(['route'=>['admin.campaigns.update',$campaign->id],'method'=>'PUT','class'=>'form']) !!}
    
    <div class="form-group">
      {!! Form::label('name') !!}
      {!! Form::text('name',$campaign->name,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('client_id','Client') !!}
      {!! Form::select('client_id',$clients,$campaign->client_id,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('event_date') !!}
      {!! Form::text('event_date',$campaign->event_date,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('venue') !!}
      {!! Form::text('venue',$campaign->venue,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('address') !!}
      {!! Form::text('address',$campaign->address,['class'=>'form-control']) !!}
    </div> 


    <div class="form-group">
      {!! Form::label('city') !!}
      {!! Form::text('city',$campaign->city,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('state') !!}
      {!! Form::text('state',$campaign->state,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('zip') !!}
      {!! Form::text('zip',$campaign->zip,['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('html_one','Extra Info One') !!}
      {!! Form::textarea('html_one',$campaign->html_one,['class'=>'form-control','placeholder'=>'put any info here including html']) !!}
    </div> 

    <div class="form-group">
      {!! Form::label('html_two','Extra Info Two') !!}
      {!! Form::textarea('html_two',$campaign->html_two,['class'=>'form-control','placeholder'=>'put any info here including html']) !!}
    </div> 

    <div class="form-group">
      {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
    </div>
    
  {!! Form::close() !!}
@stop






