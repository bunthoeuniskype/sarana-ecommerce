<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use Validator;
use Session;
use App\Http\Requests;
use File;
use Auth;
use App;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
   public function index(Request $request){
        $product = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.product.index', compact('product'));
    }

    public function create(){

        $categories=array();
        $categories['']='-- Select Category';
        foreach (Category::where(['status'=>1,'language_code'=>App::getLocale()])->get() as $category) {
          $categories[$category->group_id]=$category->name;
        }

        $subcategories=array();
        $subcategories['']='-- Select Sub Category';
        foreach (SubCategory::where(['status'=>1,'language_code'=>App::getLocale()])->get() as $subc) {
          $subcategories[$subc->group_id]=$subc->name;
        }   
 
        return view('admin.product.create',compact('subcategories','categories'));

    }
     public function store(Request $request){
        
        $input = $request->all();   

        $slug = str_random(30).''.date('Ymdhis');
        $input['user_id'] = Auth::user()->id;
        $input['slug'] = $slug;        
        Product::create($input);

        Session::flash('save','Save is Successfully !');
        return redirect('admin/product/create');

    }
    public function edit($id){      
        
        $product = Product::findorfail($id);

        $categories=array();
        $categories['']='-- Select Category';
        foreach (Category::where(['status'=>1,'language_code'=>App::getLocale()])->get() as $category) {
          $categories[$category->group_id]=$category->name;
        }

        $subcategories=array();
        $subcategories['']='-- Select Sub Category';
        foreach (SubCategory::where(['status'=>1,'language_code'=>App::getLocale()])->get() as $subc) {
          $subcategories[$subc->group_id]=$subc->name;
        }   
 
        return view('admin.product.edit',compact('product','subcategories','categories'));
       
    }

    public function alert($id){      

        $products = Product::findorfail($id);

        $categories=array();
        foreach (SubCategory::all() as $category) {
          $categories[$category->id]=$category->title;
        }
        $measures=array();
        foreach (Measure::all() as $measure) {
         $measures[$measure->id]=$measure->label;
        }

         $currencies=array();
        foreach (Currency::all() as $currency) {
         $currencies[$currency->id]=$currency->label;
        }       
        return view('admin.product.alert',compact('products','categories','measures','currencies'));
       

    }

    public function update(Request $request, $id){

        $product = Product::findorfail($id);        
     
        //create product
        $input = $request->all();        
        $input['user_id'] = Auth::user()->id;  
        $product->update($input);

        Session::flash('save','Save is Successfully !');
        return redirect('admin/product');
    }

   public function select_product_color()
    {        
    $product = Product::select('color')->where('color','!=','')->orderBy('color','asc')->groupBy('color')->get();
    $color = array();
    foreach ($product as $value) {     
      $color[]=array('label' =>  $value->color);
    }
    return $color;    
    }

      public function select_product_unit()
    {
       $product = Product::select('unit')->where('unit','!=','')->orderBy('unit','asc')->groupBy('unit')->get();
    $unit = array();   
    foreach ($product as $value) {     
        $unit[]=array('label' =>  $value->unit);
    }
    return $unit;
    }

    public function select_product_barcode(Request $res)
    {        
    $product = Product::select('id','name')->where('name','like','%'.$res->term.'%')->orderBy('name','asc')->get();
    $barcode = array();
    foreach ($product as $value) {     
      $barcode[]=array('id' =>  $value->id,'label' =>  $value->name);
    }
    return $barcode;    
    }


    public function delete($id){       
        $product= Product::find($id);
        $product->status = 0;
        $product->save();
        Session::flash('save','Delete is Successfully !');
        return redirect('admin/product');

    }

    public function destroy($id){       
        $product= Product::find($id);        
        return redirect('product');
    }


 
}

