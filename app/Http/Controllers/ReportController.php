<?php

namespace App\Http\Controllers;

use App\Action;
use App\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Signup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Excel;

class ReportController extends Controller
{
    public function actions($id)
    {
        $campaign = Campaign::find($id);

        $actions = Action::with('contact')->where('campaign_id','=',$campaign->id)
            ->orderBy('action')
            ->orderBy('contact_id','DESC')
            ->get(['action','contact_id']);

        $actions = array_map(function($action){
            foreach ($action['contact'] as $key => $value) {
                    $action[$key] = $value;
            }
            unset($action['contact_id'],$action['id'],$action['contact'],$action['unsubscribe'],$action['client_id'],$action['updated_at'],$action['created_at'],$action['bounced']);
            return $action;
        }, $actions->toArray());
        
        $metrics = Excel::create("$campaign->name Metrics",function($excel) use($campaign, $actions){
            $excel->setTitle("Email Metrics for $campaign->name");
            $excel->setCreator("EP-Productions");
            $excel->setCompany('Exhibit Partners');
            $excel->setDescription("Email metrics from an email campaign for $campaign->client->name by Exhibit Partners");

            $excel->sheet('Metrics',function($sheet) use($actions){
                $sheet->fromArray($actions);
            });

            $excel->sheet('Bounces', function($sheet) use ($campaign){
                $bounces = $campaign->bounces->toArray();
                $bounces = array_map(function($contact){
                    unset($contact['id'],$contact['client_id'],$contact['bounced'],$contact['unsubscribe'],$contact['updated_at'],$contact['created_at']);
                    return $contact;
                }, $bounces);
                $sheet->fromArray($bounces);
            });

            $excel->sheet('Unsubscribes', function($sheet) use ($campaign){
                $unsubscribes = $campaign->unsubscribes->toArray();
                $unsubscribes = array_map(function($contact){
                    unset($contact['id'],$contact['client_id'],$contact['bounced'],$contact['unsubscribe'],$contact['updated_at'],$contact['created_at']);
                    return $contact;
                }, $unsubscribes);
                $sheet->fromArray($unsubscribes);
            });

        })->download('xlsx');

        return $metrics;
    }

    public function signups($id)
    {
        $campaign = Campaign::find($id);

        $signups = Signup::with('contact')->where('campaign_id','=',$campaign->id)
            ->orderBy('contact_id','DESC')
            ->get(['contact_id']);

        $signups = array_map(function($signup){
            foreach ($signup['contact'] as $key => $value) {
                    $signup[$key] = $value;
            }
            unset($signup['contact_id'],$signup['id'],$signup['contact'],$signup['unsubscribe'],$signup['client_id'],$signup['updated_at'],$signup['created_at']);
            return $signup;
        }, $signups->toArray());
        
        $metrics = Excel::create("$campaign->name Signups",function($excel) use($campaign, $signups){
            $today = Carbon::now()->format('M jS');
            $excel->setTitle("Event Signups as of $today for $campaign->name");
            $excel->setCreator("EP-Productions");
            $excel->setCompany('Exhibit Partners');
            $excel->setDescription("Event Signups from an email campaign for $campaign->client->name");

            $excel->sheet('Signups',function($sheet) use($signups){
                $sheet->fromArray($signups);
            });

        })->download('xlsx');

        return $metrics;
    }

    private function arrayFlatten($array) { 
        $flattern = array(); 
        foreach ($array as $key => $value){ 
            $new_key = array_keys($value); 
            $flattern[] = $value[$new_key[0]]; 
        } 
        return $flattern; 
    } 
}
