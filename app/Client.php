<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected static function boot() {
        parent::boot();

        static::deleting(function($client) { // before delete() method call this
             $client->contacts()->delete();
             $client->campaigns()->delete();
        });
    }
    protected $guarded = ['id'];

    public function contacts()
    {
    	return $this->hasMany('App\Contact');
    }

    public function campaigns()
    {
    	return $this->hasMany('App\Campaign');
    }

    public function getValidContactsAttribute()
    {
        return $this->contacts->filter(function($contact){
            return !$contact->unsubscribe && !$contact->bounced;
        });
    }
}
