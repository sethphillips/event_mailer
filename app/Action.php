<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['action','contact_id','campaign_id','touch_id'];

    public function campaign()
    {
    	return $this->belongsTo('App\Campaign');
    }

    public function contact()
    {
    	return $this->belongsTo('App\Contact');
    }

    public function scopeForCampaign($query, $campaign)
    {
    	return $query->where('campaign_id','=',$campaign->id);
    }
}
