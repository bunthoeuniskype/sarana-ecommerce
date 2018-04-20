<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Language;
use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class SubCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $subcategory = SubCategory::where('language_code', App::getLocale())->orderBy('id','DESC')->get(); 

       return view("admin.sub_category.index",compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('language_code',App::getLocale())->pluck('name','group_id')->all();
        $order = SubCategory::max('order');
        $language = Language::where('status',1)->orderBy('id','asc')->get();        
        return view('admin.sub_category.create',compact('language','order','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {

    $group_id_max = SubCategory::max('group_id');
    $group_id_max_add = $group_id_max + 1;
    $language = Language::where('status',1)->orderBy('id','asc')->get();
    $slug = str_random(6).''.date('Ymdhis');
    foreach ($language as $key => $v) {      
       $subcategory = new SubCategory(); 
       $subcategory->group_id = $group_id_max_add;
       $subcategory->category_group_id = $request->category_group_id;
       $subcategory->name =  $request->name[$key];        
       $subcategory->language_code = $v->code;
       $subcategory->order =  $request->order;  
       $subcategory->slug = $slug;      
       $subcategory->save();
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
        $category = Category::where('language_code',App::getLocale())->pluck('name','group_id')->all();
        $subcategory = SubCategory::where('group_id',$id)->get();
        return view('admin.sub_category.edit',compact('subcategory','category','id'));
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
      
      $subcategory = SubCategory::where('group_id',$id)->get();

      foreach($subcategory as $key => $v){
       $subcategory = SubCategory::findOrFail($v->id); 
       $subcategory->category_group_id =  $request->category_group_id;
       $subcategory->name =  $request->name[$key]; 
       $subcategory->order =  $request->order; 
       $subcategory->status =  $request->status;      
       $subcategory->save();
      }  
     Session::flash('save','Save is Successfully!');
     return redirect('admin/subcategory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function select_sub_category(Request $request)
    {
      $subcategory = SubCategory::where(['category_group_id'=>$request->id,'status'=>1,'language_code'=>App::getLocale()])->get(['name','group_id as id']);
      return response()->json($subcategory);

    }

    public function destroy($id)
    {
        //
    }
}
