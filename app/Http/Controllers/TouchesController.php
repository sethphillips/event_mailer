<?php

namespace App\Http\Controllers;

use App\Action;
use App\Campaign;
use App\Contact;
use App\Email;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\TouchRequest;
use App\Touch;
use Illuminate\Http\Request;

class TouchesController extends Controller
{

    public function __construct()
    {
        $templates = Touch::all()->each(function($touch){
            $client = $touch->campaign->client->name;
            $campaign = $touch->campaign->name;
            $title = $touch->title;
            $touch->myValue = "$client | $campaign | $title";
        })->lists('myValue','id')->sort();

        view()->share([
            'templates'=>$templates,
        ]);
    }
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
    public function create(Request $request)
    {
        if(!$request->input('campaign')) return redirect()->back();
        $campaign = Campaign::find($request->input('campaign'));
        return view()->make('touches.create')->with([
                'campaign'=>$campaign,
                'client'=>$campaign->client,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TouchRequest $request)
    {
        if(!strtotime($request->input('send_on')))
        {
            return redirect()->back()->withInput()->with('error','The send on date was not parseable'); 
        }
        $send_on = \Carbon\Carbon::parse($request->input('send_on'))->toDateTimeString();

        $touch = Touch::create($request->all());
        $touch->send_on = $send_on;
        $touch->title_slug = md5($touch->id);
        $touch->save();

        return redirect()->route('admin.touches.show',$touch->id)->with('message',"Touch $touch->title created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $touch = Touch::find($id);
        $actions = Action::where('touch_id','=',$touch->id)
            ->groupBy('action')
            ->select(\DB::raw('count(contact_id) as count, action'))
            ->orderBy('count','DESC')
            ->get();

        return view()->make('touches.show')->with([
                'touch'=>$touch,
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
        $touch = Touch::find($id);
        return view()->make('touches.edit')
            ->with([
                'touch'=>$touch,
                'client'=>$touch->campaign->client,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TouchRequest $request, $id)
    {
        if(!strtotime($request->input('send_on')))
        {
            return redirect()->back()->withInput()->with('error','The send on date was not parseable'); 
        }
        $send_on = \Carbon\Carbon::parse($request->input('send_on'))->toDateTimeString();

        $touch = Touch::find($id);
        $touch->update($request->all());
        $touch->send_on = $send_on;
        $touch->save();
        $touch->emails()->update(['send_on'=>$touch->send_on]);
        return redirect()->route('admin.touches.show',$touch->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $touch = Touch::find($id);
        $touch->delete();
        return redirect()->back()->with('error',"$touch->title was deleted");
    }

    public function queueEmails($id)
    {
        $touch = Touch::find($id);


        $signups = array_column($touch->campaign->signups->toArray(),'contact_id');
        $contactIds = array_column($touch->campaign->contacts->toArray(),'id');
        $sentContactIds = Email::where('touch_id',$touch->id)->where('trackable',true)->groupBy('contact_id')->lists('contact_id')->toArray();
        $unsentContactIds = array_diff($contactIds,$sentContactIds,$signups);

        $queuedEmails = 0;

        foreach ($unsentContactIds as $contact_id) {
            
            $contact = Contact::find($contact_id);

            if(!$contact->unsubscribe && !$contact->bounced)
            {
                $email = Email::create([
                    'subject' => $touch->subject,
                    'reply_to' => $touch->campaign->client->reply_to,
                    'from' => $touch->campaign->client->reply_to,
                    'send_on' => $touch->send_on,
                    'template' => "emails.$touch->template",
                    'draft' => false,
                    'trackable' => true,
                    'campaign_id' => $touch->campaign->id,
                    'contact_id' => $contact->id,
                    'touch_id' => $touch->id,
                ]);
                
                $email->salted_id = bcrypt($email->id);
                $email->save();
                $queuedEmails++;
            }
        }
        

        return redirect()->back()->with('message',"$queuedEmails emails queued");

    }

    public function getTemplate($id)
    {
        $touch = Touch::find($id);
        return $touch->template_html;
    }
}
