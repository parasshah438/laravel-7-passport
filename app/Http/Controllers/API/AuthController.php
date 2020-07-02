<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;

class AuthController extends Controller
{	

	//status
	public $successStatus = 200;

    public function login(Request $request){ 
 
	    $data = [
	        'email' => $request->email, 
	        'password' => $request->password
	    ];
 
	    if(Auth()->attempt($data) ){ 
	        $user = Auth::user(); 
	   		$success['token'] =  $user->createToken('AppName')->accessToken; 
	        return response()->json(['success' => $success], $this-> successStatus);
	    }else{ 
	 		return response()->json(['error'=>'Unauthorised'], 401);
	    } 
    }
    
    public function register(Request $request) 
    { 
	    $validator = Validator::make($request->all(), [ 
	      'name' => 'required', 
	      'email' => 'required|email', 
	      'password' => 'required', 
	      'password_confirmation' => 'required|same:password', 
	    ]);
	 
	    if($validator->fails()){ 
	      return response()->json([ 'error'=> $validator->errors() ]);
  		}
 
 		$data = $request->all(); 
 		$user = User::create($data); 
 		$success['token'] =  $user->createToken('AppName')->accessToken;
 		return response()->json(['success'=>$success], $this-> successStatus); 
  	}
    
    public function user_detail() 
  	{ 
		$user = Auth::user();
 		return response()->json(['success' => $user], $this-> successStatus); 
  	} 
}
