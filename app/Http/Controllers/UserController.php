<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller {

	
	 
	public function index()
	{
		$users = User::all();

		return view()->make('users/index',array('users'=>$users));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view()->make('users/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{

		if($request->input('password')!=$request->input('password2')){
			return redirect()->back()->with('warning','your passwords did not match')->withInput();
		}

		$input = $request->all();

		$user = new User;
		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->password = bcrypt($input['password']);
		$user->save();

		return redirect()->route('admin.users.index')->with('message',"$user->email successfully created");

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$user = User::find($id);

		return view()->make('users/edit',array('user'=>$user));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request,$id)
	{
		$input = $request->all();

		if(isset($input['password'])){
			if($request->input('password')!=$request->input('password2')){
				return redirect()->back()->with('warning','your passwords did not match')->withInput();
			}
		}


		$user = User::find($id);
		$user->email = $input['email'];
		$user->name = $input['name'];
		if(isset($input['password'])){
			$user->password = bcrypt($input['password']);
		}
		
		$user->save();

		return redirect()->route('admin.users.index')->with('message',"$user->email successfully edited");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		$user->delete();

		return redirect()->route('admin.users.index')->with('warning',"You have deleted $user->email");
	}


}
