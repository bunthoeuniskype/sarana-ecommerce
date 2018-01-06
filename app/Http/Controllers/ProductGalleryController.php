<?php

namespace App\http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Gallery;
use App\Language;
use App\Http\Classes\Youtube;

use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class ProductGalleryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

      public function addGallery($product_id)
    {
        $gallery = Gallery::where(['product_id'=>$product_id])->orderBy('id','asc')->get();
        $product = Product::where(['id'=>$product_id])->pluck('name','id')->all();        
        return view('admin.product_gallery.create',compact('product','gallery'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {

    $g = new Gallery();
    $g->product_id = $request->product_id;
    $g->image = $request->image;
    $g->status = 1;
    $g->user_id = Auth::user()->id;
    $g->save();
   
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
        $g = Gallery::findOrFail($id);
        $gallery = Gallery::where(['product_id'=>$g->product_id])->orderBy('id','asc')->get();
        $product = Product::where(['id'=>$g->product_id])->pluck('name','id')->all();        
        return view('admin.product_gallery.edit',compact('product','gallery','g'));
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

      //dd($request->all());
      $g = new Gallery();
      $g->product_id = $request->product_id;
      $g->image = $request->image;
      $g->status = $request->status;
      $g->user_id = Auth::user()->id;
      $g->save();

     Session::flash('save','Save is Successfully!');
     return redirect('admin/gallery/'.$request->product_id);
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $g = Gallery::findOrFail($id); 
      $g->delete();    
      Session::flash('save','Delete is Successfully!');
     return Redirect::back();
  
    }
}
