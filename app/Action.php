<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['action'];

    public function campaign()
    {
    	return $this->belongsTo('App\Campaign');
    }

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }
}
