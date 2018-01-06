<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Feedback;
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
       $feedback = Feedback::orderBy('id','DESC')->get();         
       return view("Admin::feedback.index",compact('feedback'));
    }

      public function view($id)
    {     
       $feedback = Feedback::findOrFail($id);         
       return view("Admin::feedback.view",compact('feedback'));
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
