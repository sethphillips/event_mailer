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

        $moreinfo = $actions->filter(function($action){
            return $action->action === 'moreinfo';
        })->groupBy('contact_id');

        $unsubscribed = Contact::where('unsubscribe','=',1);

        
        $openedPercentage = $campaign->emails->count()? intval($opened->count()/$campaign->emails->count()*100): 0;
        $moreinfoPercentage = $campaign->emails->count()? intval($moreinfo->count()/$campaign->emails->count()*100): 0;
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
            'moreinfoPercentage'=>$moreinfoPercentage,
            'unsubscribedPercentage'=>$unsubscribedPercentage,
            'sentPercentage'=>$sentPercentage,


        ]);
    
    }

    public function report($id)
    {
        $campaign = Campaign::find($id);

        $summary = [];
        $actions = Action::with('contact')->forCampaign($campaign)->orderBy('contact_id')->get();

        $summary['total_sent'] = $campaign->emails->count();

        $summary['opened'] = $actions->filter(function($action){
            return $action->action === 'opened';
        })->count();

        $summary['more info'] = $actions->filter(function($action){
            return $action->action === 'more info';
        })->count();

        $summary['website_visits'] = $actions->filter(function($action){
            return $action->action === 'website';
        })->count();

        $summary['skipped_video'] = $actions->filter(function($action){
            return $action->action === 'skipped';
        })->count();

        $summary['emailed_bill'] = $actions->filter(function($action){
            return $action->action === 'email';
        })->count();

        $summary['youtube_channel'] = $actions->filter(function($action){
            return $action->action === 'youtube';
        })->count();

        $summary['unsubscribed'] = Contact::where('unsubscribe','=',1)->count();


        \Excel::create('Report',function($excel) use ($actions,$summary,$campaign){
            $excel->setTitle("eMail Report for $campaign->name")
                    ->setCreator('Exhibit Partners Mailer Service')
                    ->setCompany('Exhibit Partners')
                    ->setDescription("A detailed report of email recipients for the $campaign->name email campaign");
            


            $excel->sheet('Summary',function($sheet) use ($summary){
                $sheet->row(1,[
                    'Total',
                    'Opened',
                    'Went To Page 2',
                    'Website Visits',
                    'Skipped The Video',
                    'Emailed Bill',
                    'YouTube Channel',
                    'Unsubscribed',
                ]);

                $sheet->row(2,[
                    $summary['total_sent'],
                    $summary['opened'],
                    $summary['more info'],
                    $summary['website_visits'],
                    $summary['skipped_video'],
                    $summary['emailed_bill'],
                    $summary['youtube_channel'],
                    $summary['unsubscribed'],
                ]);
            });

            $excel->sheet('Recipient Actions', function($sheet) use ($actions) {
                $sheet->row(1,[
                    'Contact',
                    'Email',
                    'Action'
                ]);
                foreach ($actions as $key => $action) {
                    
                    $sheet->row($key+2,[
                        $action->contact->name,
                        $action->contact->email,
                        $action->action,
                    ]);
                }
            });

        })->download('xlsx');
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
