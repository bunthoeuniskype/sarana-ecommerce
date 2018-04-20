<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipper;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\ShipperRequest;
use File;


class ShipperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $shipper = Shipper::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.shipper.index',compact('shipper'));
    }

   
    public function create(){
        return view('admin.shipper.create');
    }

    public function store(Request $request){           


          $this->validate($request,[           
            'firstname' => 'required',
            'lastname' => 'required',   
            'company_name' => 'required',
            'email' => 'required|email|unique:shipper',
            'firstname' => 'required',        
            'gender' => 'required',          
            'phone' => 'required',
            'address' => 'required',
            ]); 

        //create shipper
        $shipper = new shipper;
        $req = $request->all();
        //$data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=> $shipper->encryptedAttribute($request->account_number)));
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
        $shipper->create($data);
        Session::flash('save','Save is Successfully !');
        return redirect('admin/shipper/create');
    }

    public function edit($id){  

        $shipper = Shipper::findorfail($id);
       //$shipper->account_number = $shipper->decryptedAttribute($shipper->account_number);
        return view('admin.shipper.edit')
        ->with('shipper', $shipper);

    }

    public function update(Request $request, $id){

        $shipper = Shipper::findorfail($id);
        $req = $request->all();

         $this->validate($request,[           
            'firstname' => 'required',
            'lastname' => 'required',   
            'company_name' => 'required',
            'email' => 'required|email|unique:shipper,email,'.$shipper->id.',id',
            'firstname' => 'required',        
            'gender' => 'required',          
            'phone' => 'required',
            'address' => 'required',
            ]);

       // $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=>$shipper->encryptedAttribute($request->account_number)));
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
        $shipper->update($data);       
        Session::flash('save','Save is Successfully!');
        return redirect('admin/shipper');
    }

       public function delete($id){        
        $shipper= Shipper::find($id);
        $shipper->status = 0;
        $shipper->update();
        Session::flash('save','Delete is Successfully!');
        return redirect('admin/shipper');
    }

    public function destroy($id){       
        $shipper= Shipper::find($id);
        $shipper->delete();
        return redirect('shipper');
    }

}

