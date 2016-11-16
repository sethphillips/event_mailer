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

        $html = preg_replace_callback('/{{[^}]*}}/', 
            function($matches) use ($email){
               
               return collect($matches)
                ->map(function($match) use ($email){
                    $match = str_replace('{{','',$match);
                    $match = str_replace('}}','',$match);
                    $match = trim($match);
                    if($match === 'tracking'){
                        return $email->salted_id;
                    }
                    return $email->contact->{$match};
                })->first();

            }, $email->touch->template_html);

    	Mail::send([
            'emails.template',
            "emails.text_template"
        ],[
            'email'=>true,
            'salted_id'=>$email->salted_id,
            'campaign'=>$email->campaign,
            'touch'=>$email->touch,
            'template_html'=>$html,
            'text'=>$email->touch->template_text,
            'preview_text'=>$email->touch->preview_text,
        ],function($mail) use ($email){
            $replyToAddress = $email->touch->reply_to_email;
            if(!$replyToAddress){
                $replyToAddress =$email->campaign->client->reply_to;
            }

            $replyToName = $email->touch->reply_to_name; 
            if(!$replyToName){
                $replyToName = $email->campaign->client->name;
            } 
            
            $from = config('mail.from.address');

			$mail->to($email->contact->email,$email->contact->first_name)
                ->subject($email->subject)
                ->from($from,$email->campaign->client->name)
                ->replyTo($replyToAddress, $replyToName);
		});

		$this->sent = true;
		$this->save();  

        
    }


}
