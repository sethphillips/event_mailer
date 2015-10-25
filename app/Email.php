<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use \Mail;

class Email extends Model
{
    protected $fillable = ['subject','reply_to','from','send_on','template','draft','trackable','campaign_id','contact_id'];

    protected $casts = [
    	'draft' => 'boolean',
    	'sent' => 'boolean',
    	'trackable' => 'boolean'
    ];

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }

    public function scopePublished($query)
    {	
    	return $query->where('draft','=',0);
    }

    public function scopeUnsent($query)
    {	
    	return $query->where('sent','=',0);
    }

    public function scopeReady($query)
    {	
    	return $query->where('send_on','>=',Carbon::now()->subMinutes(5))
    				->where('send_on','<=',Carbon::now()->addMinutes(5));
    }


    public function send()
    {
    	$email = $this;

    	Mail::send($this->template,['email'=>true,'id'=>$this->id],function($mail) use ($email){
			$mail->to($email->contact->email,$email->contact->name)->subject($email->subject);
		});

		$this->sent = true;
		$this->save();
    }

}
