<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogHistory;
use App\Http\Requests;

class LogController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request){
       $logs = LogHistory::orderBy('id','DESC')->paginate(25);
        return view('admin.report.log',compact('logs'));     
        
    }
}
