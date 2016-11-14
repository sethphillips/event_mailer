<div class="form-group">
      
      {!! Form::label('title','Title') !!}
      
      {!! Form::text('title',null,['class' => 'form-control','placeholder'=>null] ) !!}
    
    </div>
    
    
    
    <!-- Form Input -->
    
    <div class="form-group">
      
      {!! Form::label('send_on','Send On Date & Time') !!}
      
      {!! Form::text('send_on',null,['class' => 'form-control','placeholder'=>'Jan 15 9:00 am'] ) !!}
    
    </div>

    <div class="form-group">
      
      {!! Form::label('preview_text',' Preview Text -- This is what is seen in the email client preview') !!}
      
      {!! Form::textarea('preview_text',null,['class' => 'form-control','placeholder'=>'preview text here'] ) !!}
    
    </div>
    
    <!-- Form Input -->
    
    <div class="form-group">
      
      {!! Form::label('subject','Email Subject Line') !!}
      
      {!! Form::text('subject',null,['class' => 'form-control','placeholder'=>'this is what your recipients will see'] ) !!}
    
    </div>

    <div class="form-group">
      
      {!! Form::label('template_text','Text Version -- this is important for the CAN SPAM act') !!}
      
      {!! Form::textarea('template_text',null,['class' => 'form-control','placeholder'=>'text version of the email here'] ) !!}
    
    </div>
      
    <!-- Form Input -->
    
    <div class="form-group">
      
      {!! Form::label('none','Copy From Existing Email (this will overwrite your current template)') !!}
      
      {!! Form::select('none',$templates,'',['class' => 'copy-template'] ) !!}

      <button class="btn btn-warning copy-template-submit">Copy</button>
    </div>
    
    <div class="form-group">
      <label>Available dynamic fields from the contact</label>
      @foreach ($contactFields as $key)
        {{ <?php echo $key ?> }}&nbsp;|&nbsp; 
      @endforeach
    </div>

    <div class="form-group">
      
      {!! Form::label('template_html','HTML Template') !!}
      
      {!! Form::textarea('template_html',null,['class' => 'form-control wysiwyg','placeholder'=>'edit your html here','data-client-id'=>$client->id] ) !!}
    
    </div>
    
    <!-- Submit Button -->
    <div class="form-group">
    
      {!! Form::submit('Submit',['class'=> 'btn btn-primary form-control']) !!}
    
    </div>