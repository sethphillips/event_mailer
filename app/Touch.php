<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{

    const TEMPLATES = [
        'halloween' => 'Exhibit Partners Halloween',
        'cwt.engage'=>'Engage Save The Date',
        'cwt.engage_invite_client' => 'Engage Client Invite',
        'cwt.engage_invite_prospect' => 'Engage Prospect Invite',
        'vitality.xmas-client' => 'Vitality Holiday Client',
        'vitality.xmas-broker' => 'Vitality Holiday Broker',

    ];

    protected $fillable = ['campaign_id','template','title_slug','title','subject','send_on'];

    protected $table = 'touches';

    public function campaign()
    {
    	return $this->belongsTo('App\Campaign');
    }

    public function emails()
    {
    	return $this->hasMany('App\Email');
    }

    public function getTrackableEmailsAttribute()
    {
        return $this->emails->filter(function($email){
            return $email->trackable;
        });
    }

    public function getSentEmailsAttribute()
    {
        
        return $this->emails->filter(function($email){
            return $email->sent && $email->trackable;
        });
    }

    public function getUnsubscribesAttribute()
    {
        
        $emails = $this->emails->filter(function($email){
            return $email->contact->unsubscribe;
        });

        foreach ($emails as $key => $value) {
            $emails[$key] = $value->contact;
        };
        return $emails;
    }

    public function getBouncesAttribute()
    {
        
        $emails = $this->emails->filter(function($email){
            return $email->contact->bounced;
        });

        foreach ($emails as $key => $value) {
            $emails[$key] = $value->contact;
        };

        return $emails;
    }
}
