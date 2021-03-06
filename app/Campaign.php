<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected static function boot() {
        parent::boot();

        static::deleting(function($campaign) { // before delete() method call this
             $campaign->touchs()->delete();
             $campaign->emails()->delete();
             $campaign->contacts()->detach();
             $campaign->signups()->delete();
             $campaign->followUps()->delete();
             $campaign->actions()->delete();
        });
    }

    protected $guarded = ['id'];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact')->withTimestamps();
    }

    public function emails()
    {
    	return $this->hasMany('App\Email');
    }

    public function touchs()
    {
        return $this->hasMany('App\Touch');
    }

    public function getSentEmailsAttribute()
    {
        
        return $this->emails->filter(function($email){
            return $email->sent && $email->trackable;
        });
    }

    public function getTrackableEmailsAttribute()
    {
        return $this->emails->filter(function($email){
            return $email->trackable;
        });
    }

    public function getValidContactsAttribute()
    {
        return $this->contacts->filter(function($contact){
            return !$contact->unsubscribe && !$contact->bounced;
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

    public function signups()
    {
    	return $this->hasMany('App\Signup');
    }

    public function followUps()
    {
    	return $this->hasMany('App\FollowUp');
    }

    public function actions()
    {
    	return $this->hasMany('App\Action');
    }
}
