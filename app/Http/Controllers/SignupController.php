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
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function signup(SignupRequest $request)
    {
        if($request->input('salted_id'))
        {
            $originalEmail = Email::where('salted_id','=',$request->input('salted_id'))->first();
        }

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
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

    public function engage($name, Request $request)
    {
        $email = $request->input('email')
            ? Email::where('salted_id','=',$request->input('email'))->first()
            : null;

        $campaign = $email
            ? $email->campaign
            : Campaign::where('title_slug','=',$name)->first();

        if($email && $email->trackable)
        {
            Action::firstOrCreate([
                'action'=>'clicked register',
                'contact_id'=>$email->contact->id,
                'campaign_id'=>$email->campaign->id,
            ]);
        }

        return view()->make('signups.engage')->with(['campaign'=>$campaign,'email'=>$email]);
    }
}
