<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = ['send_on'];

    public function campaign()
    {
    	return $this->belongsTo('App\Campaign');
    }
}
