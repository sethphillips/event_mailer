<div class="form-group">
  {!! Form::label('name') !!}
  {!! Form::text('name',null,['class'=>'form-control']) !!}
</div> 

<div class="form-group">
  {!! Form::label('reply_to') !!}
  {!! Form::text('reply_to',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('phone') !!}
  {!! Form::text('phone',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('address') !!}
  {!! Form::text('address',null,['class'=>'form-control']) !!}
</div> 

<div class="form-group">
  {!! Form::label('city') !!}
  {!! Form::text('city',null,['class'=>'form-control']) !!}
</div> 

<div class="form-group">
  {!! Form::label('state') !!}
  {!! Form::text('state',null,['class'=>'form-control']) !!}
</div> 

<div class="form-group">
  {!! Form::label('zip') !!}
  {!! Form::text('zip',null,['class'=>'form-control']) !!}
</div> 


<div class="form-group">
  {!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
</div> 