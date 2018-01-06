<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AuthRole;
use Validator;
use DB;
use Session;
use App\Http\Requests;


class rolecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request){
       $roles = AuthRole::orderBy('name','ASC')->paginate(7);
        return view('admin.role.index',compact('roles'))      
        ->with('i', ($request->input('page', 1) - 1) * 7);
    }


    public function create(){
        
    	return view('admin.role.create');
        
    }
     public function store(Request $request){
    
    	$validator=Validator::make($request->all(),[
             'name' => 'required|min:3|unique:auth_role,name',            
            ]);

    	$role = new AuthRole;
        
    	$role->name = $request->name;
        $role->description = $request->description;
       
    	$role->save();
    	Session::flash('role_create','role Insert is Successfully !');
    	return redirect('role/create');
    }
    public function edit($id){    	

    	$roles = AuthRole::findorfail($id);
    	return view('admin.role.edit')
    	->with('roles', $roles);

    }

    public function update(Request $request, $id){
        $role = AuthRole::find($id);

       	$validator=Validator::make($request->all(),[
             'name' => 'required|min:3|unique:auth_role,name,'.$role->id.',id',
    		]);

    	if ($validator->fails()) {
    		return redirect('role/'.$role->id.'/edit')
    		->withInput()
    		->withErrors($validator);
    	}
    	//create role
    	
    	$role->name = $request->Input('name');
        $role->description = $request->Input('description');
        
    	$role->save();
    	Session::flash('role_update','role Update is Successfully !');
    	return redirect('role');
    }
    public function destroy($id){    	
    	$roles = AuthRole::find($id);
    	$roles->delete();
    	return redirect('role');

    }
}
