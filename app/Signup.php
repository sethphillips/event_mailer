<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{


    public function campaign()
    {
    	return $this->belongsTo('App\Campaign');
    }

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }
}
