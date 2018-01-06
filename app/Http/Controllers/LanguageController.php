<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
      \Session::put('locale', $request->locale);      
     
        return Redirect::back();
    }
}
