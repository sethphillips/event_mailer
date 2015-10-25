<?php

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
	$id = $request->input('id')?:'anonymous';
    return view('halloween')->with('id',$id);
}]);


Route::get('moreinfo', ['as'=>'moreinfo',function(Request $request){
	$id = $request->input('id')?:'anonymous';
	return view('halloween2')->with('id',$id);
}]);

Route::get('action',function(){
	return 'action captured';
});

Route::get('halloween_email',['as'=>'halloween',function(Request $request){
	$id = $request->input('id')?:'anonymous';
	return view('emails.halloween')->with(['id'=>$id,'email'=>false]);
}]);

Route::get('testmail',function(){

	\Mail::send('emails.halloween',['email'=>true],function($mail){
		$mail->to('seth.phillips@trms.com','Seth Phillips')->subject('Happy Halloween!');
	});

	return 'tested';
});