<div class="form-group">
  {!! Form::label('name') !!}
  {!! Form::text('name',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('client_id', 'Client') !!}
  {!! Form::select('client_id',$clients,null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('event_date') !!}
  {!! Form::text('event_date',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
</div>