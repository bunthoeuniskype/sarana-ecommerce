<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Language;
use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       $category = Category::where('language_code',App::getLocale())->orderBy('id','DESC')->get();         
       return view("admin.category.index",compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Category::max('order');
        $language = Language::where('status',1)->orderBy('id','asc')->get();        
        return view('admin.category.create',compact('language','order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {

    $group_id_max = Category::max('group_id');
    $group_id_max_add = $group_id_max + 1;
    $language = Language::where('status',1)->orderBy('id','asc')->get();
    $slug = str_random(6).''.date('Ymdhis');
    foreach ($language as $key => $v) {      
       $category = new Category(); 
       $category->name =  $request->name[$key];
       $category->group_id = $group_id_max_add;    
       $category->language_code = $v->code;
       $category->order =  $request->order; 
       $category->slug =  $slug;         
       $category->save();
    }
      
      Session::flash('save','Save is Successfully!');
      return Redirect::back();
    }

     public function insert_category_by_ajax(Request $request)
    {
        $validator=Validator::make($request->all(),[
         'course_id' => 'required',
         'name' => 'required',
        ]);

      if ($validator->fails()) {
        return 'Save is Failed';
      }
      $category = new Category(); 
      $requestDataAll = $request->all();
      $data =  array_merge($requestDataAll , array(              
        'created_by' => Auth::user()->id,
        )); 
        $category::create($data);      
        return 'Save is Successfully';
    }

    public function select_category_by_ajax(Request $request)
    {
      $category = Category::select(['name','id'])->where('status',1)->orderBy('id','DESC')->get();
      return response()->json($category);
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
        $category = Category::where('group_id',$id)->get();           
        $language = Language::where('status',1)->orderBy('id','asc')->get();
        return view('admin.category.edit',compact('category','language','id'));
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
      
      $category = Category::where('group_id',$id)->get();
      
      foreach($category as $key => $v){
       $category = Category::findOrFail($v->id); 
       $category->name =  $request->name[$key]; 
       $category->order =  $request->order;       
       $category->status =  $request->status;      
       $category->save();
      }  
     Session::flash('save','Save is Successfully!');
     return redirect('admin/category');
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
