<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Category;
use App\SubCategory;
use App\Ads;
use App\Cart;
use App\Orders;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use Redirect;
use App\Fav;
use Auth;

class ShoppingController extends Controller
{

  public function index()
   {
      $paginate = false;
     $products = Product::where(['status'=>1,['qty','>',0]])->orderBy('id','desc')->get();
    if (count($products)>18) {
      $products = Product::where(['status'=>1,['qty','>',0]])->orderBy('id','desc')->paginate(18);
      $paginate = true;
    }
    
   // dd($products);
    $slide = Ads::where(['ads_type'=>'Slide','location'=>'Header'])->orderBy('order','asc')->get();
    return view('site.index',compact('products','paginate','slide'));
   }

   public function detail(Request $request,$slug)
   {
    
    $product = Product::where('slug',$slug)->orderBy('id','desc')->first();
    if($product->category_id !== 0){
      $product_related = Product::where(['status'=>1,'category_id'=>$product->category_id,['qty','>',0]])->orderBy('id','desc')->limit(6)->get();
    }else if($product->subcategory_id !== 0){
       $product_related = Product::where(['status'=>1,'subcategory_id'=>$product->subcategory_id,['qty','>',0]])->orderBy('id','desc')->limit(6)->get();
    }else{
       $product_related = Product::where(['status'=>1,['qty','>',0]])->orderBy('id','desc')->limit(6)->get();
    }
   
    return view('site.product_detail',compact('product','product_related'));

   }

   public function byCategory($slug)
   {
    $paginate = false;
    $c = Category::where('slug',$slug)->first();
    $products = Product::where(['status'=>1,'category_id'=>$c->group_id,['qty','>',0]])->orderBy('id','desc')->get();  
    $list = $c->name;
    if(count($products)>30) {
      $products = Product::where(['status'=>1,'category_id'=>$c->group_id,['qty','>',0]])->orderBy('id','desc')->paginate(30);
      $paginate = true;
    }
     return view('site.product_list',compact('products','list','paginate'));
   }

      public function search(Request $request)
   {

    $category_id = $request->byCategory;
    $query = $request->search;
   
    $paginate = false;
    if($request->byCategory == 'all'){
       $products = Product::where(['status'=>1,['qty','>',0],['name','like','%'.$query.'%']])->orderBy('id','desc')->get();   
    if (count($products)>30) {
      $products = Product::where(['status'=>1,['qty','>',0],['name','like','%'.$query.'%']])->orderBy('id','desc')->paginate(30);
      $paginate = true;
        }
       $list = 'All';
    }else{
      $c = Category::where('group_id',$request->byCategory)->first();
       $list = $c->name;
        $products = Product::where(['status'=>1,'category_id'=>$c->group_id,['qty','>',0],['name','like','%'.$query.'%']])->orderBy('id','desc')->get();   
    if (count($products)>30) {
      $products = Product::where(['status'=>1,'category_id'=>$c->group_id,['qty','>',0],['name','like','%'.$query.'%']])->orderBy('id','desc')->paginate(30);
      $paginate = true;
    }
    }
    return view('site.product_list',compact('products','list','paginate'));
   }

    public function bySubCategory($slug)
   {
    $paginate = false;
    $sc = SubCategory::where('slug',$slug)->first();
    $products = Product::where(['status'=>1,'subcategory_id'=>$sc->group_id,['qty','>',0]])->orderBy('id','desc')->get();  
     if (count($products)>30) {
      $products = Product::where(['status'=>1,'subcategory_id'=>$sc->group_id,['qty','>',0]])->orderBy('id','desc')->paginate(30);
      $paginate = true;
    }
    $list = $sc->name;
     return view('site.product_list',compact('products','list','paginate'));
   }

public function CheckOut()
{
  if(!Session::has('cart')){
    return view('customerprofile');
  }else{

    $oldCart=Session::get('cart');
    $cart=new Cart($oldCart);
    return view('site.shoppingcheckout',['totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
  }
}

public function AddToCart(Request $request,$id)
   {
   	$products = Product::find($id);
   	$oldCart = Session::has('cart') ? Session::get('cart') : null;
   
   	$cart = new Cart($oldCart);
   	$cart->add($products,$products->id);
   	$request->session()->put('cart',$cart);
   //dd(Session::get('cart'));
  //$request->session()->forget('cart');
  	return Redirect::back();
   }

      public function getReduceByOne(Request $request,$id)
   {
   
   	$oldCart = Session::has('cart') ? Session::get('cart') : null;
   	$cart = new Cart($oldCart);
   	$cart->reduceByOne($id);
   	$request->session()->put('cart',$cart);
  	return Redirect::back();
   }

     public function getRemove(Request $request,$id)
   {
   
   	$oldCart = Session::has('cart') ? Session::get('cart') : null;
   	$cart = new Cart($oldCart);
   	$cart->Remove($id);
   	$request->session()->put('cart',$cart);
  	return Redirect::back();
   }

     public function getAddByOne(Request $request,$id)
   {
   
   	$oldCart = Session::has('cart') ? Session::get('cart') : null;
   	$cart = new Cart($oldCart);
   	$cart->AddByOne($id);
   	$request->session()->put('cart',$cart);
  	return Redirect::back();
   }

   public function getCart()
   {
  if(!Session::has('cart')){
  	return view('site.shoppingcart');
  }else{

  	$oldCart=Session::get('cart');
  	$cart=new Cart($oldCart);
  	return view('site.shoppingcart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
  }
   
}

 public function PaymentByStripe(Request $request)
  {
    if(!Session::has('cart')){
      return redirect()->route('shopping.getcart')->with('success','You Don\'t have Product in Cart!');
    }else{

    try {
      
    $oldCart=Session::get('cart');
    $cart=new Cart($oldCart);

   $customer = Session::get('customer');

   Stripe::setApiKey("sk_test_COwoecPS3mUhyqEYxsoS8M6A");

  $charge = Charge::create(array(
  "amount" => $cart->totalPrice * 100,
  "currency" => "usd",
  "source" => $request->StripeToken, // obtained with Stripe.js
  "description" => 'User Name : '.$customer->username.' Email : '.$customer->email.' Phone : '.$customer->phone.' Total Qty : '.$cart->totalQty
));


$order = new Orders();
$order->customer_id = $customer->id;
$order->cart = serialize($cart);
$order->total_qty = $cart->totalQty;
$order->total_amount = $cart->totalPrice;
$order->payment_id = $charge->id;
$order->save();

} catch (Exception $e) {
      return redirect()->route('shopping.getcart')->with('error', $e->getMessage());
    }

  Session::forget('cart');
  return redirect()->route('shopping.getcart')->with('success','You Order is Successfully!');

 }

}

public function cancelCart(){
  Session::forget('cart');
  return redirect('/');
}

public function OrdersItems($value='')
{
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);            

            $order = new Orders();
            $order->customer_id = Auth::guard('customer')->user()->id;
            $order->cart = serialize($cart);
            $order->total_qty = $cart->totalQty;
            $order->total_amount = $cart->totalPrice;
            $order->payment_id = '###';
            $order->status = 'No Paid';          
            if($order->save()){
              Session::forget('cart');
              Session::flash('success','Your Order is Successfully');
            }else{
              Session::flash('error','Your Order is Failed');
            }
            return redirect('customerprofile');
}

public function favoriteProduct()
       {

        $cid = Session::get('customer')->id;
        $fav = Fav::where('user_id',$cid)->get();               
        $products = array();
        foreach ($fav as $key => $value) {
          $products[] = $value->product;
        }
       $paginate = false;        
        $list = "favorite";
        if(count($products)>30) {
           foreach ($fav as $key => $value) {
          $products[] = $value->product;
          }
          $paginate = true;
        }
         return view('site.product_list',compact('products','list','paginate'));
       }

}