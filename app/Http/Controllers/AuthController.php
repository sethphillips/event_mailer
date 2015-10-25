<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller {

	public function login()
	{
		return view()->make('users.login');
	}

	
	public function create()
	{
		return view()->make('sessions/create');
	}


	
	public function store(Request $request)
	{
		$input = $request->all();

		$login = \Auth::attempt([
			'email'=>$input['email'],
			'password'=>$input['password']
			]);

		if($login) return redirect()->intended('admin')->with('message','You have been logged in.');

		else return redirect()->back()->with('warning','Invalid Credentials')->withInput();
	}


	
	public function destroy()
	{
		\Auth::logout();

		return redirect()->to('login')->with('warning', "You have been logged out");
	}

}
