<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\SupplierRequest;
use File;


class SupplierController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){

        $supplier = Supplier::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.supplier.index',compact('supplier'));
    }

   
    public function create(){
        return view('admin.supplier.create');
    }

    public function store(Request $request){           

        //create Supplier
        $supplier = new Supplier;
        $req = $request->all();
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=> $supplier->encryptedAttribute($request->account_number)));
        $supplier->create($data);
        Session::flash('save','Save is Successfully !');
        return redirect('admin/supplier/create');
    }

    public function edit($id){  

        $supplier = Supplier::findorfail($id);
        $supplier->account_number = $supplier->decryptedAttribute($supplier->account_number);
        return view('admin.supplier.edit')
        ->with('supplier', $supplier);

    }

    public function update(Request $request, $id){

        $supplier = Supplier::findorfail($id);
        $req = $request->all();
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),
            'account_number'=>$supplier->encryptedAttribute($request->account_number)));
        $supplier->update($data);       
        Session::flash('save','Save is Successfully!');
        return redirect('admin/supplier');
    }

       public function delete($id){        
        $supplier= Supplier::find($id);
        $supplier->status = 0;
        $supplier->update();
        Session::flash('save','Delete is Successfully!');
        return redirect('admin/supplier');
    }

    public function destroy($id){       
        $supplier= Supplier::find($id);
        $supplier->delete();
        return redirect('supplier');
    }
}


