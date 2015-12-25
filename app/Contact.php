<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
	    	'first_name',
            'last_name',
            'email',
            'address',
            'city',
            'state',
            'zip',
            'unsubscribe',
            'client_id',
    ];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }

    public function emails()
    {
    	return $this->hasMany('App\Email');
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
