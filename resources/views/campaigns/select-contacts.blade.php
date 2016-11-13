@extends('layouts.admin')






@section('title')
  Available Contacts for {{ $campaign->name }}
@stop







@section('search')

@stop








@section('action')
  {!! link_to_route('admin.campaigns.show','back',$campaign->id,['class'=>'btn btn-primary pull-right']) !!}
@stop








@section('content')

  @include('includes.campaign-sub-nav',['campaign'=>$campaign])

  <h3 class="section-header">Contacts</h3>

  {!! Form::open([
    'route'=>['admin.campaigns.select_contacts_add',$campaign->id],
    'method'=>'POST',
    'class'=>'form'
  ]) !!}

    <input type="submit" class="btn btn-success" value="Add Contacts">

    @foreach ($contacts as $contact)
      <div class="checkbox">
        <label><input name="contacts[]" type="checkbox" value={{ $contact->id }}> {{ $contact->first_name }} {{ $contact->last_name }} {{ $contact->email }}</label>
      </div>
    @endforeach
  
    <input type="submit" class="btn btn-success" value="Add Contacts">

  {!! Form::close() !!}

@stop






