<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name','event_date','client_id'];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function emails()
    {
    	return $this->hasMany('App\Email');
    }

    public function getSentEmailsAttribute()
    {
        
        return $this->emails->filter(function($email){
            return $email->sent;
        });
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
