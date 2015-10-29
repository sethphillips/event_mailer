<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Client;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function emailsForm()
    {
        return view()->make('admin.email-form-temp');
    }

    public function emailsPost(Request $request)
    {
        $date = \Carbon\Carbon::parse($request->input('dateTime'))->toDateTimeString();

        $file = $request->file('file');

        $EP = Client::where('name','=','Exhibit Partners')->first();
        $campaign = Campaign::where('name','=','Halloween Video')->first();

        $results = \Excel::load($file,function($reader) use ($EP){

            
            $reader->ignoreEmpty();

            $reader->each(function($row) use ($EP){
                if(isset($row['email_address_work']))
                {
                    Contact::firstOrCreate([
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'email' => $row['email_address_work'],
                        'address' => trim(str_replace("\n", ' ', $row['address_work_street']) ) ,
                        'city' => $row['address_work_city'],
                        'state' => $row['address_work_state'],
                        'zip' => $row['address_work_zip'],
                        'client_id' => $EP->id,
                    ]);
                }

            });
        });
        
        $contacts = Contact::where('client_id','=', $EP->id)->get();

        $contacts->each(function($contact) use ($date,$campaign){
            Email::create([
                'subject' => 'Happy Halloween!',
                'reply_to' => 'info@exhibitpartners.com',
                'from' => 'info@exhibitpartners.com',
                'send_on' => $date,
                'template' => 'emails.halloween',
                'draft' => false,
                'trackable' => true,
                'campaign_id' => $campaign->id,
                'contact_id' => $contact->id,

            ]);
        });

        return redirect()->route('admin.index');

    }
}
