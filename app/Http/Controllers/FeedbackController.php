<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Language;
use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class FeedbackController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
       $feedback = Contact::orderBy('id','DESC')->get();         
       return view("admin.feedback.index",compact('feedback'));
    }

      public function view($id)
    {     
       $feedback = Contact::findOrFail($id);         
       return view("admin.feedback.view",compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
