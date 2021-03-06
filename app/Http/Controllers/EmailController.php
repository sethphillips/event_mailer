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


    public function renderEmail($title_slug, Request $request){
    
        $touch = Touch::where('title_slug','=',$title_slug)->first();
        
        if(!$touch) abort(404);

        if($request->input('email')){
            $salted_id = $request->input('email');
        }
        else{
            $salted_id = null;
        }

        if($salted_id){
            $email = Email::where('salted_id',$salted_id)->first();
            $html = preg_replace_callback('/{{[^}]*}}/', 
            function($matches) use ($email){
               
               return collect($matches)
                ->map(function($match) use ($email){
                    $match = str_replace('{{','',$match);
                    $match = str_replace('}}','',$match);
                    $match = trim($match);
                    if($match === 'tracking'){
                        return $email->salted_id;
                    }
                    return $email->contact->{$match};
                })->first();

            }, $email->touch->template_html);
        }
        else{
            $html = $touch->template_html;
        }

        return view('emails.template')->with([
            'template_html'=>$html,
            'salted_id' => $salted_id,
            'campaign' => $touch->campaign,
            'email' => false,
            'preview_text'=>$touch->preview_text
            ]);
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
                    'subject' => $touch->subject,
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

        $emails = explode(',',$request->input('email') );

        $count = 0;
        foreach ($emails as $email) {
 
            $email = trim($email);
            if(!$this->checkEmail($email)) {
                continue;
            }

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
                'subject' => $touch->subject,
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
            $count++;
        }

        return redirect()->back()->with('message',"$count test emails sent");
    }

    public function destroy($id)
    {
        $email = Email::find($id);
        $contact = $email->contact;
        $email->delete();
        return redirect()->back()->with('warning',"email to $contact->email deleted" );
    }
}
