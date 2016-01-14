<?php

use App\Campaign;
use App\Email;
use App\Touch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTouchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('touches',function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->integer('campaign_id')->unsigned();
            $table->string('template');
            $table->string('title_slug');
            $table->string('subject');
            $table->dateTime('send_on');
            $table->timestamps();
        });

        $cwtBC = Campaign::where('title_slug','=','engage_boston_c')->first();
        $cwtBP = Campaign::where('title_slug','=','engage_boston_p')->first();
        $cwtNC = Campaign::where('title_slug','=','engage_new_york_c')->first();
        $cwtNP = Campaign::where('title_slug','=','engage_new_york_p')->first();

        $cwtBIC = Campaign::where('title_slug','=','engage_boston_invite_c')->first();
        $cwtBIP = Campaign::where('title_slug','=','engage_boston_invite_p')->first();
        $cwtNIC = Campaign::where('title_slug','=','engage_new_york_invite_c')->first();
        $cwtNIP = Campaign::where('title_slug','=','engage_new_york_invite_p')->first();

        $h = Campaign::where('title_slug','=','halloween')->first();
        $vC = Campaign::where('title_slug','=','vitality_holiday_client')->first();
        $vB = Campaign::where('title_slug','=','vitality_holiday_broker')->first();

        if($cwtBC) $this->migrateTouches($cwtBC, $cwtBC);
        if($cwtBP) $this->migrateTouches($cwtBP, $cwtBP);
        if($cwtNC) $this->migrateTouches($cwtNC, $cwtNC);
        if($cwtNP) $this->migrateTouches($cwtNP, $cwtNP);

        if($cwtBIC && $cwtBC) $this->migrateTouches($cwtBIC, $cwtBC);
        if($cwtBIP && $cwtBP) $this->migrateTouches($cwtBIP, $cwtBP);
        if($cwtNIC && $cwtNC) $this->migrateTouches($cwtNIC, $cwtNC);
        if($cwtNIP && $cwtNP) $this->migrateTouches($cwtNIP, $cwtNP);    
        
        if($h) $this->migrateTouches($h, $h);
        if($vC) $this->migrateTouches($vC, $vC);
        if($vB) $this->migrateTouches($vB, $vB);

        $cwtBIC->delete();
        $cwtBIP->delete();
        $cwtNIC->delete();
        $cwtNIP->delete();

        $this->addContactsToCampaign($cwtBC);
        $this->addContactsToCampaign($cwtBP);
        $this->addContactsToCampaign($cwtNC);
        $this->addContactsToCampaign($cwtNP);
        $this->addContactsToCampaign($vC);
        $this->addContactsToCampaign($vB);
        $this->addContactsToCampaign($h);

    }

    private function migrateTouches($currentCampaign, $destinationCampaign)
    {
        $touch = Touch::create([
            "title" => $currentCampaign->name,
            "campaign_id" => $destinationCampaign->id,
            "template" => $currentCampaign->template,
            "title_slug" => $currentCampaign->title_slug,
        ]);

        \DB::table('emails')
            ->where('campaign_id', $currentCampaign->id)
            ->update([
                'touch_id' => $touch->id,
                'campaign_id'=>$destinationCampaign->id
            ]);

        DB::table('actions')
            ->where('campaign_id', $currentCampaign->id)
            ->update([
                'touch_id' => $touch->id,
                'campaign_id'=>$destinationCampaign->id
            ]);

        $lastEmail = Email::where('touch_id','=', $touch->id)->orderBy('send_on','DESC')->first();
        
        if($lastEmail)
        {
            $touch->send_on = $lastEmail->send_on;
            $touch->save();
        }
    }

    private function addContactsToCampaign($campaign)
    {
        $contacts = Email::where('campaign_id','=',$campaign->id)->lists('contact_id')->toArray();
        $campaign->contacts()->sync($contacts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('touches');
    }
}
