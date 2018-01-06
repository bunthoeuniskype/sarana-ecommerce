<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exchange;
use App\Language;
use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class ExchangeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       $exchange = Exchange::where('status',1)->orderBy('id','DESC')->get();         
       return view("admin.exchange_rate.index",compact('exchange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.exchange_rate.create');
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
         'dollar' => 'required',
         'riel' => 'required',
         'date' => 'redired',
        ]);
      
      $exchange = new Exchange();
      $exchange->create($request->all());
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
        $exchange = Exchange::findOrFail($id);
        return view('admin.exchange_rate.edit',compact('exchange'));
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
      
      $exchange = Exchange::findOrFail($id);

      $validator=Validator::make($request->all(),[
         'dollar' => 'required',
         'riel' => 'required',
         'date' => 'redired',
        ]);
      
      $exchange->update($request->all());     
     
     Session::flash('save','Save is Successfully!');
     return redirect('admin/exchange');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
       $exchange = Exchange::findOrFail($id);
       $exchange->status = 0;
       $exchange->save();
       Session::flash('save','Delete is Successfully!');
       return Redirect::back();
    }


    public function destroy($id)
    {
        //
    }
}
