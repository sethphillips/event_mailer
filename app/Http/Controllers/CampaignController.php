<?php

namespace App\Http\Controllers;

use App\Action;
use App\Campaign;
use App\Client;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    private $contacts = [];

    public function __construct()
    {
        $clients = Client::orderBy('name')->lists('name','id');
        view()->share([
            'clients'=>$clients
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('client_id')->orderBy('event_date','DESC')->get();
        return view()->make('campaigns.index')->with('campaigns',$campaigns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = Campaign::create($request->all());
        $campaign->event_date = \Carbon\Carbon::parse($request->event_date);
        $campaign->save();
        return redirect()->route('admin.campaigns.index')->with('message',"$campaign->name created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::find($id);

        $actions = Action::where('campaign_id','=',$campaign->id)
            ->groupBy('action')
            ->select(\DB::raw('count(contact_id) as count, action'))
            ->orderBy('count','DESC')
            ->get();

        return view()->make('campaigns.show')->with([
            'campaign'=>$campaign,
            'actions'=>$actions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view()->make('campaigns.edit')->with('campaign',$campaign);
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
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        $campaign->event_date = \Carbon\Carbon::parse($request->event_date);
        $campaign->save();
        return redirect()->route('admin.campaigns.index')->with('message',"$campaign->name updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        // if($campaign->touchs()->count()){
        //     return redirect()->back()->with('error',"$campaign->name has active touches and cannot be deleted");
        // }
        $campaign->delete();
        return redirect()->back()->with('warning',"$campaign->name deleted");
    }

    public function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function addContacts($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        return view()->make('campaigns.add-contacts')->with('campaign',$campaign);
    }

    public function addContact($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        return view()->make('campaigns.add-contact')->with('campaign',$campaign);
    }

    public function storeContact($campaign_id, Request $request)
    {

        $email = $request->input('email');
        $email = trim($email);
        if( !$this->checkEmail($email) ) return redirect()->back()->with('error','the email address you entered was not able to be parsed');

        $campaign = Campaign::find($campaign_id);
        $contact = Contact::firstOrCreate([
            'email' => $email,
            'client_id' => $campaign->client->id,
        ]);

        if($contact->unsubscribe || $contact->bounced)
        {
            return redirect()->back()->with('message',"$contact->email is unreachable or has unsubscribed");
        }

        if(!$campaign->contacts->contains($contact))
        {
            $campaign->contacts()->attach($contact->id);
        }

        return redirect()->back()->with('message',"$contact->email added to Campaign");
    }

    public function storeContacts($campaign_id, Request $request)
    {
        set_time_limit(0);
        $date = \Carbon\Carbon::parse($request->input('dateTime'))->toDateTimeString();

        $file = $request->file('file');


        $campaign = Campaign::find($campaign_id);

        $contacts = [];

        $results = \Excel::selectSheetsByIndex(0)->load($file,function($reader) use ($campaign){

            $reader->ignoreEmpty();
            $reader->each(function($row) use ($campaign){

                if(isset($row['email']) && $row['email'])
                {
                    $email = $row['email'];
                    $email = trim($email);

                    if(!$this->checkEmail($email)) return false;

                    $contact = Contact::firstOrCreate([
                        'email' => $email,
                        'client_id' => $campaign->client->id,
                    ]);

                    if(isset( $row['first_name']) ) $contact->first_name = $row['first_name'];
                    if(isset( $row['last_name']) ) $contact->last_name = $row['last_name'];
                    if(isset( $row['company']) ) $contact->company = $row['company'];
                    if(isset( $row['title']) ) $contact->title = $row['title'];
                    if(isset( $row['address']) ) $contact->address = trim(str_replace("\n", ' ', $row['address']) );
                    if(isset( $row['city']) ) $contact->city = $row['city'];
                    if(isset( $row['state']) ) $contact->state = $row['state'];
                    if(isset( $row['zip']) ) $contact->zip = $row['zip'];

                    $contact->save();

                    if(!$contact->bounced && !$contact->unsubscribe)
                    {
                        array_push($this->contacts, $contact->id);
                    }
                }
            });
        });

        $contactCount = 0;
        foreach ($this->contacts as $contact) {
            if(!$campaign->contacts->contains($contact))
            {
                $campaign->contacts()->attach($contact);
                $contactCount++;
            }
        }

        return redirect()->route('admin.campaigns.show',$campaign->id)->with('message',"$contactCount contacts added to Campaign");
    }

    public function removeContact($campaign_id, $contact_id)
    {
        $campaign = Campaign::find($campaign_id);
        $contact = Contact::find($contact_id);
        $campaign->contacts()->detach($contact->id);
        return redirect()->back()->with('message',"$contact->email has been removed from the Campaign");
    }

    public function selectContacts($id)
    {
        $campaign = Campaign::find($id);

        $campaignContacts = $campaign->validContacts;
        $contacts = $campaign->client->validContacts->diff($campaignContacts);

        return view()->make('campaigns.select-contacts')->with([
            'contacts'=>$contacts,
            'campaign'=>$campaign
        ]);
    }

    public function addSelectedContacts($id,Request $request)
    {
        $contacts = $request->contacts;
        if(!$contacts){
            return redirect()->back()->with('error', "So... you uh, didnt select any contacts.");
        }
        $campaign = Campaign::find($id)->contacts()->attach($contacts);

        $count = count($contacts);

        return redirect()->route('admin.campaigns.show',$id)->with('message',"added $count contacts to the campaign.");
    }



}
