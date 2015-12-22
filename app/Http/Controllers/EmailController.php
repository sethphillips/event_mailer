<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Client;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private $contacts = [];

    public function createList($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        return view()->make('email.create-list')->with('campaign',$campaign);
    }

    public function create($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        return view()->make('email.create-single')->with('campaign',$campaign);
    }

    public function storeList($campaign_id, Request $request)
    {
        set_time_limit(0);
        $date = \Carbon\Carbon::parse($request->input('dateTime'))->toDateTimeString();

        $file = $request->file('file');

        
        $campaign = Campaign::find($campaign_id);

        $results = \Excel::selectSheetsByIndex(0)->load($file,function($reader) use ($campaign){

            $reader->ignoreEmpty();
            $reader->each(function($row) use ($campaign){

                if(isset($row['email']) && $row['email'])
                {
                    $contact = Contact::firstOrCreate([
                        'email' => $row['email'],
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
                    array_push($this->contacts, $contact);

                }
            });
        });
        
        
        foreach ($this->contacts as $contact) {
        
            $email = Email::create([
                'subject' => $request->input('subject'),
                'reply_to' => $campaign->client->reply_to,
                'from' => $campaign->client->reply_to,
                'send_on' => $date,
                'template' => "emails.$campaign->template",
                'draft' => false,
                'trackable' => true,
                'campaign_id' => $campaign->id,
                'contact_id' => $contact->id,
            ]);
            $email->salted_id = bcrypt($email->id);
            $email->save();
        }
        $queuedEmails = count($this->contacts);
        return redirect()->route('admin.campaigns.show',$campaign->id)->with('message',"$queuedEmails emails queued");

    }

    public function store($campaign_id, Request $request)
    {
        $date = \Carbon\Carbon::parse($request->input('dateTime'))->toDateTimeString();

        $send_to = $request->input('email');
        if(!$send_to || !$date) return redirect()->back()->with('error','the email address or date you entered was not able to be parsed');

        $campaign = Campaign::find($campaign_id);

        $contact = Contact::firstOrCreate([
            'email' => $send_to,
            'client_id' => $campaign->client->id,
        ]);
     
        $email = Email::create([
            'subject' => $request->subject,
            'reply_to' => $campaign->client->reply_to,
            'from' => $campaign->client->reply_to,
            'send_on' => $date,
            'template' => "emails.$campaign->template",
            'draft' => false,
            'trackable' => true,
            'campaign_id' => $campaign->id,
            'contact_id' => $contact->id,
        ]);

        $email->salted_id = bcrypt($email->id);
        $email->save();
        

        return redirect()->back()->with('message',"email queued for $contact->email");
    }

    public function destroy($id)
    {
        $email = Email::find($id);
        $contact = $email->contact;
        $email->delete();
        return redirect()->back()->with('warning',"email to $contact->email deleted" );
    }
}
