<?php

namespace App\Http\Controllers;

use App\Action;
use App\Campaign;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SignupRequest;
use App\Signup;
use App\Touch;
use Illuminate\Http\Request;

class SignupController extends Controller
{

     public function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function signup(SignupRequest $request)
    {
        $email = $request->input('email');
        if(!$this->checkEmail($email))
        {
            return redirect()->back()->withInput()->with('error', "$email is not a valid email");
        }

        if($request->input('salted_id'))
        {
            $originalEmail = Email::where('salted_id','=',$request->input('salted_id'))->first();
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        
        $phone = $request->input('phone');
        $campaign = Campaign::find($request->input('campaign'));

        $contact = Contact::firstOrCreate([
            'email' => $email,
            'client_id' => $campaign->client->id,
        ]);
        
        if($first_name) $contact->first_name = $first_name;
        if($last_name) $contact->last_name = $last_name;
        if($phone) $contact->phone = $phone;
        $contact->save();

        Action::firstOrCreate([
            'action'=>'signed up',
            'contact_id' => $contact->id,
            'campaign_id' => $campaign->id,
        ]);

        Signup::firstOrCreate([
            'contact_id' => $contact->id,
            'campaign_id' => $campaign->id,
        ]);

        return redirect()->back()->with('message',"Thanks for signing up $first_name!");
    }

    public function engageGeneric()
    {
        return view()->make('signups.engage-generic');
    }

    public function engageRedirect(Request $request)
    {
        $city = $request->input('city');
        $customer = $request->input('customer');
        if(!$city || !$customer) return redirect()->back()->withInput()->with('error',"Please let us know what city you're in and if you're currently working with us.");
        
        if($city === 'boston')
        {
            if($customer === 'yes') 
            {
                return redirect()->route('engage_signup',['name'=>'engage_boston_c']);
            }
            return redirect()->route('engage_signup',['name'=>'engage_boston_p']);
        }
        if($city === 'new_york')
        {
            if($customer === 'yes') 
            {
                return redirect()->route('engage_signup',['name'=>'engage_new_york_c']);
            }
            return redirect()->route('engage_signup',['name'=>'engage_new_york_p']);
        }
        return redirect()->back()->with('error',"Sorry, something seems to have gone wrong with your request");
    }

    public function engage($name, Request $request)
    {
        $email = $request->input('email')
            ? Email::where('salted_id','=',$request->input('email'))->first()
            : null;

            
        $touch = $email
            ? $email->campaign
            : Touch::where('title_slug','=',$name)->first();

        $campaign = $touch->campaign;

        if($email && $email->trackable)
        {
            Action::firstOrCreate([
                'action'=>'clicked register',
                'contact_id'=>$email->contact->id,
                'campaign_id'=>$email->campaign->id,
                'touch_id' => $email->touch_id
            ]);
        }

        return view()->make('signups.engage')->with(['campaign'=>$campaign,'email'=>$email]);
    }

    public function signupForward(Request $request)
    {
        $email = $request->input('email');
        if(!$this->checkEmail($email))
        {
            return redirect()->back()->withInput()->with('error', "$email is not a valid email");
        }

        $campaign = Campaign::find($request->input('campaign_id'));

        $touch = $campaign->touchs()->first();

        $date = \Carbon\Carbon::now()->toDateTimeString();

        $contact = Contact::firstOrCreate([
            'email' => $email,
            'client_id' => $touch->campaign->client->id,
        ]);
        
        if($contact->unsubscribe || $contact->bounced)
        {
            return redirect()->back()->with('message',"$contact->email is unreachable or has unsubscribed");
        }  

        $newEmail = Email::create([
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

        $newEmail->salted_id = bcrypt($newEmail->id);
        $newEmail->save();

        return redirect()->back()->with('message',"We will contact $email right away");
    }
}
