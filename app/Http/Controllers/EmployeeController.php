<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\EmployeeRequest;
use File;

class Employeecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request){

        $employee = Employee::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.employee.index',compact('employee'));
    }

   
    public function create(){
        return view('admin.employee.create');
    }

    public function store(Request $request){           

        //create employee
        $employee = new employee();


          $this->validate($request,[           
            'firstname' => 'required',
            'lastname' => 'required',           
            'gender' => 'required',          
            'phone' => 'required',
            'address' => 'required',
            ]); 

        $req = $request->all();
        //$data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=> $employee->encryptedAttribute($request->account_number)));
         $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
        $employee->create($data);
        Session::flash('save','Save is Successfully !');
        return redirect('admin/employee/create');
    }

    public function edit($id){  

        $employee = Employee::findorfail($id);
      //  $employee->account_number = $employee->decryptedAttribute($employee->account_number);
        return view('admin.employee.edit')
        ->with('employee', $employee);

    }

    public function update(Request $request, $id){

        $employee = Employee::findorfail($id);
        $req = $request->all();

          $this->validate($request,[           
            'firstname' => 'required',
            'lastname' => 'required',           
            'gender' => 'required',          
            'phone' => 'required',
            'address' => 'required',
            ]); 

        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
       // $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=>$employee->encryptedAttribute($request->account_number)));
        $employee->update($data);       
        Session::flash('save','Save is Successfully!');
        return redirect('admin/employee');
    }

       public function delete($id){        
        $employee= Employee::find($id);
        $employee->status = 0;
        $employee->update();
        Session::flash('save','Delete is Successfully!');
        return redirect('admin/employee');
    }

    public function destroy($id){       
        $employee= Employee::find($id);
        $employee->delete();
        return redirect('employee');
    }
}
