<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseIncome;
use Validator;
use Session;
use App\Http\Requests;
use Auth;
use DB;
use Redirect;

class ExpenseIncomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       $exp_inc = ExpenseIncome::where('status',1)->orderBy('id','DESC')->get();         
       return view("admin.expense_income.index",compact('exp_inc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.expense_income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {

      $validator=Validator::make($request->all(),[
         'total_income' => 'required',
         'total_expense' => 'required',
         'date' => 'redired',
        ]);      

      $exp_inc = new ExpenseIncome();

     $data = array_merge($request->all(),
        array('user_id'=>Auth::user()->id));
      $exp_inc->create($data);
      Session::flash('save','Save is Successfully!');
      return Redirect::back();
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exp_inc = ExpenseIncome::findOrFail($id);
        return view('admin.expense_income.edit',compact('exp_inc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
      $exp_inc = ExpenseIncome::findOrFail($id);

      $validator=Validator::make($request->all(),[
         'total_income' => 'required',
         'total_expense' => 'required',
         'date' => 'redired',
        ]);
      

      $data = array_merge($request->all(),
        array('user_id'=>Auth::user()->id));
      $exp_inc->Update($data);   

     Session::flash('save','Save is Successfully!');
     return redirect('admin/expense_income');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
       $exp_inc = ExpenseIncome::findOrFail($id);
       $exp_inc->status = 0;
       $exp_inc->save();
       Session::flash('save','Delete is Successfully!');
       return Redirect::back();
    }


    public function destroy($id)
    {
        //
    }
  
}

