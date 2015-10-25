<?php

namespace App\Http\Controllers;

use App\Action;
use App\Campaign;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $campaign = Campaign::first();
        


        $actions = Action::forCampaign($campaign)->get();

        $opened = $actions->filter(function($action){
            return $action->action === 'opened';
        })->groupBy('contact_id');

        $website = $actions->filter(function($action){
            return $action->action === 'website';
        })->groupBy('contact_id');

        $skipped = $actions->filter(function($action){
            return $action->action === 'skipped';
        })->groupBy('contact_id');

        $emailed = $actions->filter(function($action){
            return $action->action === 'email';
        })->groupBy('contact_id');

        $youtube = $actions->filter(function($action){
            return $action->action === 'youtube';
        })->groupBy('contact_id');

        $unsubscribed = Contact::where('unsubscribe','=',1);

        
        $openedPercentage = $campaign->emails->count()? intval($opened->count()/$campaign->emails->count()*100): 0;
        $websitePercentage = $campaign->emails->count()? intval($website->count()/$campaign->emails->count()*100): 0;
        $skippedPercentage = $campaign->emails->count()? intval($skipped->count()/$campaign->emails->count()*100): 0;
        $emailedPercentage = $campaign->emails->count()? intval($emailed->count()/$campaign->emails->count()*100): 0;
        $youtubePercentage = $campaign->emails->count()? intval($youtube->count()/$campaign->emails->count()*100): 0;
        $unsubscribedPercentage = $campaign->emails->count()? intval($unsubscribed->count()/$campaign->emails->count()*100): 0;
        $sentPercentage = $campaign->emails->count()? intval($campaign->sentEmails->count()/$campaign->emails->count()*100): 0;

        return view()->make('admin.index')->with([
            'campaign'=>$campaign,
            'actions'=>$actions,
            'openedPercentage'=>$openedPercentage,
            'websitePercentage'=>$websitePercentage,
            'skippedPercentage'=>$skippedPercentage,
            'emailedPercentage'=>$emailedPercentage,
            'youtubePercentage'=>$youtubePercentage,
            'unsubscribedPercentage'=>$unsubscribedPercentage,
            'sentPercentage'=>$sentPercentage,


        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
