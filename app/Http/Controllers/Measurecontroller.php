<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Measure;
use Validator;
use DB;
use Session;
use App\Http\Requests;


class Measurecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request){
       $measure = Measure::orderBy('label','ASC')->paginate(7);
        return view('admin.measure.index',compact('measure'))      
        ->with('i', ($request->input('page', 1) - 1) * 7);
    }

    public function create(){
      
    	return view('admin.measure.create');
        
    }
     public function store(Request $request){
    
    $validator=Validator::make($request->all(),[
             'label' => 'required|min:3|unique:measure,label',                    
            ]);
    	//create measure
    	$measure = new Measure;
    	$measure->label = $request->label;        
    	$measure->save();
    	Session::flash('measure_create','measure Insert is Successfully !');
    	return redirect('measure/create');
    }
    public function edit($id){    	

    	$measure = Measure::findorfail($id);
    	return view('admin.measure.edit')
    	->with('measure', $measure);

    }

    public function update(Request $request, $id){
        $measure = Measure::find($id);

    	$validator=Validator::make($request->all(),[

             'label' => 'required|min:3|unique:measure,label,'.$measure->id.'id',
             		
    		]);
    	if ($validator->fails()) {
    		return redirect('measure/'.$measure->id.'/edit')
    		->withInput()
    		->withErrors($validator);
    	}
    	//create measure
    	$measure = Measure::find($id);
    	$measure->label = $request->Input('label');       
    	$measure->save();
    	Session::flash('measure_update','measure Update is Successfully !');
    	return redirect('measure');
    }
    public function destroy($id){    	
    	$measure = Measure::find($id);
    	$measure->delete();
    	return redirect('measure');

    }
}
