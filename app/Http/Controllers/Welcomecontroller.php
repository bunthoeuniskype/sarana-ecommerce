<?php

namespace App\Http\Controllers;


use Mail;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;

class Welcomecontroller extends Controller
{

	public function index(request $request,$locale="kh"){
      //set’s application’s locale
        
      app()->setLocale($locale);
      
      //Gets the translated message and displays it     
    return view('welcome');
    }

}
