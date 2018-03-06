<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Inventory;
use App\Product;
use App\Customer;
use App\SaleDetail;
use App\Exchange;
use App\CartSale;
use Validator;
use Session;
use App\Http\Requests;
use File;
use Input;
use Auth;
use DB;
use Redirect;


class SaleController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
   public function AddToCart(Request $request,$id)
   {

    if(Session::has('mode_sale') == 'Sale'){
      $where = ['id'=>$id,['qty','>', 0]];      
    }else{
      $where = ['id'=>$id];
    }

    $products = Product::where($where)->first();  
    
    if(!$products){
       if(Session::has('mode_sale') == 'Sale'){
          $where = ['barcode'=>$id,['qty','>', 0],['barcode','!=','']];      
        }else{
          $where = ['barcode'=>$id,['barcode','!=','']];
        }
      $products = Product::where($where)->first();      
    }
   
    if($products){

    $oldCart = Session::has('cart_sale') ? Session::get('cart_sale') : null;
   
    $cart = new CartSale($oldCart);
    $cart->add($products,$products->id);
    $request->session()->put('cart_sale',$cart);
    //$request->session()->forget('cart');
    return response()->json(['status'=>true]);
  }

 return response()->json(['status'=>false]);

}

     public function getRemove(Request $request,$id)
   {
   
    $oldCart = Session::has('cart_sale') ? Session::get('cart_sale') : null;
    $cart = new CartSale($oldCart);
    $cart->Remove($id);
    $request->session()->put('cart_sale',$cart);
    return Redirect::back();
   }

   
    public function getUpdateCart(Request $request)
   {
    
    $id = $request->id;
    $price = $request->price;
    $qty = $request->qty;
    $discount = $request->discount;
    $tax = $request->tax;

    $products = Product::find($id);
    
    $oldCart = Session::has('cart_sale') ? Session::get('cart_sale') : null;
   
    $cart = new CartSale($oldCart);
    $cart->update($products,$price,$qty,$discount,$tax,$id);
    $request->session()->put('cart_sale',$cart);
    //$request->session()->forget('cart');
    return response()->json(['status'=>true]);

   }

   public function getCart()
   {
  if(!Session::has('cart_sale')){
    return view('shoppingcart');
  }else{
    $oldCart=Session::get('cart_sale');
    $cart=new CartSale($oldCart);
    return view('shoppingcart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
  }
   
}

      public function mode(Request $res)
      {
        Session::put('mode_sale',$res->mode);
      }

    public function store(request $request){  

    
            DB::beginTransaction();

            try {
              
            $sale= new Sale;
            $sale->user_id = Auth::user()->id;           
            $sale->customer_id = $request->customer_id;                       
            $sale->total = $request->total;
            $sale->amount_paid = $request->amount_paid;
            $sale->amount_due = $request->amount_due;
            $sale->description = $request->description;
            $sale->change_due = $request->change_due;           
            $sale->date = date('Y-m-d');
            $sale->mode = Session::get('mode_sale');
            
          if($sale->save()){ 
            $sale_id = $sale->id;

            $oldCart = Session::get('cart_sale');
            $cart=new CartSale($oldCart);

                foreach($cart->items as $key => $v){     
                $data = array(
                    'sale_id' => $sale_id,
                    'product_id' => $v['item']['id'],
                    'price' => $v['price'],
                    'qty' => $v['qty'],
                    'discount' => $v['discount'],
                    'tax' => $v['tax'],
                    'amount' => $v['amount']                  
                 );  
                SaleDetail::insert($data);                     
                 }

        $saledetails = SaleDetail::where('sale_id', $sale_id)->get();

        if(Session::get('mode_sale') == 'Sale'){
           //Sale receive
          foreach($saledetails as $value)
        {
          $product = Product::find($value->product_id);             
          $product->qty = $product->qty  - $value->qty;                
          $product->save();

          $inventories = new Inventory;
          $inventories->product_id = $value->product_id;
          $inventories->user_id = Auth::User()->id;
          $inventories->in_out_qty = $value->qty;
          $inventories->remarks = 'POS-SALE'.$sale_id;
          $inventories->save();                    
        }

        }else{
          //Sale return
          foreach($saledetails as $value)
        {
          $product = Product::find($value->product_id); 
          $product->qty = $product->qty  + $value->qty;                
          $product->save();

          $inventories = new Inventory;
          $inventories->product_id = $value->product_id;
          $inventories->user_id = Auth::User()->id;
          $inventories->in_out_qty = $value->qty;
          $inventories->remarks = 'POS-RETURN'.$sale_id;
          $inventories->save();                    
        }

        }

        }

            } catch (Exception $e) {
              DB::rollback();
              var_dump($e->getErrors());
            }
          DB::commit();
            
        Session::flash('sale_create', 'Sale is Successfully!');
        Session::forget('cart_sale');                  
        return redirect('admin/sale/complete/'.$sale_id);   

        }

      function complete(Request $res, $id){

        $exchange = Exchange::orderBy('id','desc')->first();

         $sale= Sale::findOrFail($id);
         $saledetail = SaleDetail::where('sale_id',$sale->id)->get();
        
         return view('admin.sale.complete')   
            ->with('sale', $sale)    
            ->with('exchange', $exchange)          
            ->with('saledetail', $saledetail); 
        }

     public function scanBarcode(Request $request){      
    // $data=Product::select('id','name','price')->where('barcode', $request->barcode)->orderBy('created_at','DESC')->first();
      $data = DB::table('product')
        ->join('change_price', 'change_price.product_id', '=', 'product.id')
        ->select('product.id', 'product.name', 'change_price.price')
        ->where('barcode', $request->barcode)
        ->orderBy('change_price.created_at','DESC')->first();
   // dd($data);
     return response()->json($data);

    }

    public function load_initial()
    {
        
        $data = $this->_loadCart();

        $customers=array();
        foreach (Customer::all() as $cust) {
         $customers[$cust->id]=$cust->firstname.' '.$cust->lastname.' - '.$cust->phone;
        }     

      $exchange = Exchange::orderBy('id','desc')->first();
     return view('admin.sale.sale_initial',compact('data','exchange','customers'));

    }

    public function index(){

        //Session::forget('cart_sale');
        $data = $this->_loadCart();
       
       
       $customers=array();
        foreach (Customer::all() as $cust) {
         $customers[$cust->id]=$cust->firstname.' '.$cust->lastname;
        }

        $exchange = Exchange::orderBy('id','desc')->first();

        return view('admin.sale.sale',compact('data','customers','exchange'));
    }

     function _loadCart()
      {
      if(!Session::has('mode_sale')){
       $data['mode'] = Session::put('mode_sale','Sale');
      }else{
        $data['mode'] = Session::get('mode_sale');
      }
      if(!Session::has('cart_sale')){
      $data['totalPrice'] = 0;        
      }else{
      $oldCart=Session::get('cart_sale');
      $cart=new CartSale($oldCart);
      $data['totalPrice'] = $cart->totalPrice;
      }
      return $data;
}


}

