<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Test;
class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
    }

    
    public function test(Request $request){

   /*     $arr = array();
        foreach ($request->append as $key => $value) {
           $arr[] = $value[$key];
        }*/

     /*   $t = new Test();

        $comma_separated = implode("|", $request->append);

        $t->data_arr = $comma_separated;
        $t->save();*/

        $jsonD =  json_encode($request->all());
        $t = new Test();
        $t->data_arr = $jsonD;
        $t->save();

        $t = Test::find(3);
        $jsonD = json_decode($t->data_arr,true);
        $jsonD['append'];

       /* $comma_arry = explode("|", $t->data_arr);*/
       foreach ($jsonD['append'] as $key => $value) {
          echo $value.'<br>';
       }
        dd($jsonD['append']);
    }

    public function testview(){
        return view('site.form.testform');
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

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
