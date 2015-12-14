<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'name',
    	'address',
        'city',
        'state',
        'zip',
        'reply_to',
    ];

    public function contacts()
    {
    	return $this->hasMany('App\Contact');
    }

    public function campaigns()
    {
    	return $this->hasMany('App\Campaign');
    }
}
