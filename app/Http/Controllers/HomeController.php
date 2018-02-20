<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use Redirect;
use App\User;
use App\Product;

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

    public function countView($id)
    {
       $pro = Product::find($id);
       $pro->count_view = $pro->count_view + 1;
       $pro->save();
       return 1;
    }

    public function ratingProduct(Request $request)
    {
       $pro = Product::find($request->id);
       $pro->rate = $request->rate;
       $pro->save();
       return 1;
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
