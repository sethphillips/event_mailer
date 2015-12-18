<?php

use App\Action;
use App\Campaign;
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

Route::get('/',function(){
	return redirect()->route('video');
});

Route::get('vitality_holidays',['as'=>'vitalityXmas',function(Request $request){

	$id = $request->input('email');
	if($id){
		$action = $request->input('action');

		$email = Email::where('salted_id','=',$id)->first();

		if($email){
			$action = Action::firstOrCreate([
				'action' => 'opened',
				'contact_id' => $email->contact->id,
				'campaign_id' => $email->campaign->id,
			]);
		}
	}


	return view()->make('vitality.xmas-video');
	
}]);

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

	$id = $request->input('email');
	if(!$id) return 'anonymous';
	$action = $request->input('action');

	$email = Email::where('salted_id','=',$id)->first();

	$action = Action::firstOrCreate([
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




Route::group(['prefix'=>'admin','middleware'=>['auth']],function(){
	Route::get('/',['as'=>'admin.index','uses'=>'AdminController@index']);
	Route::get('dashboard/{id}',['as'=>'admin.dashboard','uses'=>'DashboardController@index']);
	Route::get('report/{id}',['as'=>'admin.report','uses'=>'DashboardController@report']);
	
	Route::resource('users','UserController');
	Route::resource('clients','ClientController');
	Route::resource('campaigns','CampaignController');
	
	Route::get('new-emails/{campaign_id}',['as'=>'admin.emails.new','uses'=>'EmailController@createList']);
	Route::post('new-emails/{campaign_id}',['as'=>'admin.emails.post','uses'=>'EmailController@storeList']);
	Route::get('new-email/{campaign_id}',['as'=>'admin.email.new','uses'=>'EmailController@create']);
	Route::post('new-email/{campaign_id}',['as'=>'admin.email.post','uses'=>'EmailController@store']);
	Route::delete('emails/{id}',['as'=>'admin.emails.destroy','uses'=>'EmailController@destroy']);

	Route::get('reports/actions/{campaign_id}',['as'=>'admin.reports.actions','uses'=>'ReportController@actions']);
	Route::get('reports/signups/{campaign_id}',['as'=>'admin.reports.signups','uses'=>'ReportController@signups']);

});

// Login Logout routes
Route::get('login','AuthController@login');
Route::get('logout','AuthController@destroy');
Route::resource('auth', 'AuthController');
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



Route::get('halloween_email',['as'=>'halloween',function(Request $request){
	if($request->input('email'))
	{
		$salted_id = $request->input('email');
		$request->session()->put('salted_id',$salted_id);
	}
	else
	{
		$salted_id = $request->session()->get('salted_id',null);
	}

	return view('emails.halloween')->with(['salted_id'=>$salted_id,'email'=>false]);
}]);

Route::get('tracking',['as'=>'tracking',function(Request $request){
	if($request->input('email'))
	{
		$salted_id = $request->input('email');
		$email = Email::where('salted_id','=',$salted_id)->first();

		if($email)
		{
			$action = Action::firstOrCreate([
				'action' => 'opened',
				'contact_id' => $email->contact->id,
				'campaign_id' => $email->campaign->id,
			]);
		}
	}
	return \Image::canvas(10,10)->encode('gif');
}]);

Route::get('emails/{title_slug}',['as'=>'emails',function($title_slug,Request $request){
	
	$campaign = Campaign::where('title_slug','=',$title_slug)->first();
	
	if(!$campaign) abort(404);

	if($request->input('email'))
	{
		$salted_id = $request->input('email');
		$request->session()->put('salted_id',$salted_id);
	}
	else
	{
		$salted_id = $request->session()->get('salted_id',null);
	}

	return view("emails.$campaign->template")->with([
		'salted_id' => $salted_id,
		'campaign' => $campaign,
		'email' => false
		]);
}]);


Route::get('engage_signup/{name}',['as'=>'engage_signup','uses'=>'SignupController@engage']);
Route::post('signup', ['as'=>'signup','uses'=>'SignupController@signup']);



Route::get('testmail',function(){
	$campaign = Campaign::find(2);

	\Mail::send('emails.cwt.engage',['email'=>true,'campaign'=>$campaign,'salted_id'=>'foo'],function($mail){
		$mail->to('seth.phillips@trms.com','Seth Phillips')->subject('test email');
	});

	return 'tested';
});