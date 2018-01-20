<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use Redirect;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function feedback(Request $request)
    {
  
        $f = new Contact();
        $f::create($request->all());
        \Session::flash('success','Message Send Successfully');
        return Redirect::back();
    }
}
