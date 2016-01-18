<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use \Mail;

class Email extends Model
{
    protected $fillable = ['salted_id','subject','reply_to','from','send_on','template','draft','trackable','campaign_id','contact_id','touch_id'];

    protected $casts = [
    	'draft' => 'boolean',
    	'sent' => 'boolean',
    	'trackable' => 'boolean'
    ];

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }

    public function touch()
    {
        return $this->belongsTo('App\Touch');
    }

    public function scopePublished($query)
    {	
    	return $query->where('draft','=',0);
    }

    public function sent($query)
    {
        return $query->where('sent','=',1);
    }

    public function scopeUnsent($query)
    {	
    	return $query->where('sent','=',0);
    }

    public function scopeReady($query)
    {	
    	return $query->where('send_on','<=',Carbon::now('America/Chicago')->addMinutes(5));
    }

    public function scopeTrackable($query)
    {
        return $query->where('trackable','=',1);
    }

    public function send()
    {
    	$email = $this;
    	Mail::send($email->template,['email'=>true,'salted_id'=>$email->salted_id,'campaign'=>$email->campaign,'touch'=>$email->touch],function($mail) use ($email){
			$mail->to($email->contact->email,$email->contact->first_name)->subject($email->subject)->from($email->campaign->client->reply_to,$email->campaign->client->name);
		});

		$this->sent = true;
		$this->save();
    }

}
