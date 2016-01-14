<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Client;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Touch;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private $contacts = [];

    public function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function createList($touch_id)
    {
        $touch = Touch::find($touch_id);
        return view()->make('email.create-list')->with('touch',$touch);
    }

    public function create($touch_id)
    {
        $touch = Touch::find($touch_id);
        return view()->make('email.create-single')->with('touch',$touch);
    }

    public function storeList($touch_id, Request $request)
    {
        
        $date = \Carbon\Carbon::now()->toDateTimeString();

        $file = $request->file('file');

        $touch = Touch::find($touch_id);

        $results = \Excel::selectSheetsByIndex(0)->load($file,function($reader) use ($touch){

            $reader->ignoreEmpty();
            $reader->each(function($row) use ($touch){

                $email = $row['email'];
                $email = trim($email);
                if(!$this->checkEmail($email)) return false;

                if(isset($row['email']) && $row['email'])
                {
                    $contact = Contact::firstOrCreate([
                        'email' => $email,
                        'client_id' => $touch->campaign->client->id,
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
        
        $queuedEmails = 0;
        foreach ($this->contacts as $contact) {
            if(!$contact->unsubscribe && !$contact->bounced)
            {
                $email = Email::create([
                    'subject' => $request->input('subject'),
                    'reply_to' => $touch->campaign->client->reply_to,
                    'from' => $touch->campaign->client->reply_to,
                    'send_on' => $date,
                    'template' => "emails.$touch->template",
                    'draft' => false,
                    'trackable' => false,
                    'campaign_id' => $touch->campaign->id,
                    'contact_id' => $contact->id,
                    'touch_id' => $touch->id,
                ]);
                
                $email->salted_id = bcrypt($email->id);
                $email->save();
                $queuedEmails++;
            }
        }

        return redirect()->route('admin.touches.show',$touch->id)->with('message',"$queuedEmails test emails sent");

    }

    public function store($touch_id, Request $request)
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();

        $email = $request->input('email');
        $email = trim($email);
        if(!$this->checkEmail($email)) return redirect()->back()->with('error','the email address you entered was not able to be parsed');

        $touch = Touch::find($touch_id);

        $contact = Contact::firstOrCreate([
            'email' => $email,
            'client_id' => $touch->campaign->client->id,
        ]);
        
        if($contact->unsubscribe || $contact->bounced)
        {
            return redirect()->back()->with('message',"$contact->email is unreachable or has unsubscribed");
        }  

        $email = Email::create([
            'subject' => $request->input('subject'),
            'reply_to' => $touch->campaign->client->reply_to,
            'from' => $touch->campaign->client->reply_to,
            'send_on' => $date,
            'template' => "emails.$touch->template",
            'draft' => false,
            'trackable' => false,
            'campaign_id' => $touch->campaign->id,
            'contact_id' => $contact->id,
            'touch_id' => $touch->id,
        ]);

        $email->salted_id = bcrypt($email->id);
        $email->save();
        

        return redirect()->back()->with('message',"test email sent to $contact->email");
    }

    public function destroy($id)
    {
        $email = Email::find($id);
        $contact = $email->contact;
        $email->delete();
        return redirect()->back()->with('warning',"email to $contact->email deleted" );
    }
}
