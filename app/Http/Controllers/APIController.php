<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
use Input;
use Auth;

class APIController extends Controller
{
	

    public function register(Request $request)
    {        
   
    	$input = $request->all();
    	$input['password'] = Hash::make($input['password']);
    	User::create($input);
        return response()->json(['result'=>true]);
    }
    

    public function login(Request $request)
    {
    	$input = $request->all();
    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => 'wrong email or password.']);
        }
        	return response()->json(['result' => $token]);
    }
    

    public function get_user_details(Request $request)
    {

    	//$input = $request->all();
    	/*$data = Input::json();
    	$user = JWTAuth::toUser($data->get('token'));*/
       // $user = JWTAuth::toUser($request->token);
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(['result' => $user]);

    }
      public function get_user_all(Request $request)
    {
    	
    	$user = User::all();
        return response()->json(['result' => $user]);
    }
    

}