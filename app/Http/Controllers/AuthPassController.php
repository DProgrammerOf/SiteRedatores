<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthPassController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }
    //
	/**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */

	public function index(){
			return view('authpass', ['page'=>'authpass']);
	}

	public function indexFake(){
		return view('authpass', ['page'=>'authpass']);
	}

    public function update(Request $request)
    {
        // Validate the new password length...

        if($request->all()){

        	//dd($request->all());
               $validatedData = $this->validate($request, [
			        'password' => 'required|string|min:6|confirmed',
			    ]);

        $request->user()->fill([
            'password' 	=> Hash::make($request->password),
            'status' 	=> 1
        ])->save();

        	return redirect()->route('senha')->with('status', "Sua senha foi alterada com sucesso.<br>O acesso está liberado.");
    	}
    }	
}

