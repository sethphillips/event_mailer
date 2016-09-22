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
        'cwt.engage_invite_prospect_reminder' => 'Engage Prospect Invite Reminder',
        'cwt.engage_invite_client_reminder' => 'Engage Client Invite Reminder',
        'cwt.engage_invite_client_reminder_2' => 'Engage Client Invite Reminder 2',
        'cwt.engage_invite_prospect_reminder_2' => 'Engage Prospect Invite Reminder 2',
        'cwt.engage_presenters' => 'Engage Presenters Reminder',
        'vitality.xmas-client' => 'Vitality Holiday Client',
        'vitality.xmas-broker' => 'Vitality Holiday Broker',
        'ep.may.email' => 'EP: Check out this video',
        'ep.october_vikings.email' => 'October Vikings Invite',
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
