<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['send_on','template','draft','trackable','campaign_id','contact_id'];

    protected $casts = [
    	'draft' => 'boolean',
    	'sent' => 'boolean',
    	'trackable' => 'boolean'
    ];

}
