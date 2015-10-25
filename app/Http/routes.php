<?php

use App\Action;
use App\Contact;
use App\Email;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('halloween', ['as'=>'video',function (Request $request) {
	
	
	if($request->input('email'))
	{
		$id = $request->input('email');
		$request->session()->put('id',$id);
	}
	else
	{
		$id = $request->session()->get('id',null);
	}


    return view('halloween')->with('id',$id);
}]);


Route::get('moreinfo', ['as'=>'moreinfo',function(Request $request){
	if($request->input('email'))
	{
		$id = $request->input('email');
		$request->session()->put('id',$id);
	}
	else
	{
		$id = $request->session()->get('id',null);
	}

	return view('halloween2')->with('id',$id);
}]);


Route::post('action',function(Request $request){

	$id = $request->input('id');
	if(!$id) return 'anonymous';
	$action = $request->input('action');

	$email = Email::find($id);

	$action = Action::create([
		'action' => $action,
		'contact_id' => $email->contact->id,
		'campaign_id' => $email->campaign->id,
	]);
	
	return 'action captured';
});


Route::get('unsubscribe',['as'=>'unsubscribe.form',function(Request $request){

	return view()->make('unsubscribe.form');

}]);

Route::post('unsubscribe',['as'=>'unsubscribe.submit',function(Request $request){

	$email = $request->input('email');
	
	$contact = Contact::where('email','=',$email)->first();

	if(!$contact) return view()->make('unsubscribe.form')->with('message',"Sorry, I dont think we ever sent anything to $email");

	$contact->unsubscribe = true;
	$contact->save();

	return view()->make('unsubscribe.response')->with([
		'message' => "$contact->email has been unsubscribed",
	]);


}]);


Route::get('halloween_email',['as'=>'halloween',function(Request $request){
	if($request->input('email'))
	{
		$id = $request->input('email');
		$request->session()->put('id',$id);
	}
	else
	{
		$id = $request->session()->get('id',null);
	}

	return view('emails.halloween')->with(['id'=>$id,'email'=>false]);
}]);





Route::get('testmail',function(){

	\Mail::send('emails.halloween',['email'=>true],function($mail){
		$mail->to('seth.phillips@trms.com','Seth Phillips')->subject('Happy Halloween!');
	});

	return 'tested';
});