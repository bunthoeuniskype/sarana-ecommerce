<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Inventory;
use App\Product;
use App\Supplier;
use App\PurchaseDetail;
use App\Shipper;
use App\Exchange;
use App\CartPurchase;
use Validator;
use Session;
use App\Http\Requests;
use File;
use Input;
use Auth;
use DB;
use Redirect;


class PurchaseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
   public function AddToCart(Request $request,$id)
   {

    $products = Product::where('id',$id)->first();

    if($products){
          
    $oldCart = Session::has('cart_purchase') ? Session::get('cart_purchase') : null;
   
    $cart = new CartPurchase($oldCart);
    $cart->add($products,$products->id);
    $request->session()->put('cart_purchase',$cart);
    //$request->session()->forget('cart');
    return response()->json(['status'=>true]);
    }
    return response()->json(['status'=>false]);
   }

     public function getRemove(Request $request,$id)
   {
   
    $oldCart = Session::has('cart_purchase') ? Session::get('cart_purchase') : null;
    $cart = new CartPurchase($oldCart);
    $cart->Remove($id);
    $request->session()->put('cart_purchase',$cart);
    return Redirect::back();
   }

    public function getUpdateCart(Request $request)
   {
    
    $id = $request->id;
    $cost = $request->cost;
    $qty = $request->qty;
    $discount = $request->discount;

    $products = Product::find($id);
    
    $oldCart = Session::has('cart_purchase') ? Session::get('cart_purchase') : null;
   
    $cart = new CartPurchase($oldCart);
    $cart->update($products,$cost,$qty,$discount,$id);
    $request->session()->put('cart_purchase',$cart);
    //$request->session()->forget('cart');
    return response()->json(['status'=>true]);

   }

   public function getCart()
   {
  if(!Session::has('cart_purchase')){
    return view('shoppingcart');
  }else{
    $oldCart=Session::get('cart_purchase');
    $cart=new CartPurchase($oldCart);
    return view('shoppingcart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
  }
   
}

      public function mode(Request $res)
      {
        Session::put('mode_purchase',$res->mode);
      }

    public function store(request $request){  

    
            DB::beginTransaction();

            try {
              
            $purchase= new Purchase;
            $purchase->user_id = Auth::user()->id;
            $purchase->supplier_id = $request->supplier_id;
            $purchase->shipper_id = $request->shipper_id;
            $purchase->sub_total = $request->sub_total;
            $purchase->discount_amount = $request->discount_amount;
            $purchase->total = $request->total;
            $purchase->amount_paid = $request->amount_paid;
            $purchase->amount_due = $request->amount_due;
            $purchase->description = $request->description;
            $purchase->date = date('Y-m-d');
            $purchase->mode = Session::get('mode_purchase');
            
          if($purchase->save()){ 
            $purchase_id = $purchase->id;

            $oldCart = Session::get('cart_purchase');
            $cart=new CartPurchase($oldCart);

                foreach($cart->items as $key => $v){     
                $data = array(
                    'purchase_id' => $purchase_id,
                    'product_id' => $v['item']['id'],
                    'cost' => $v['cost'],
                    'qty' => $v['qty'],
                    'discount' => $v['discount'],
                    'amount' => $v['amount']                  
                 );  
                PurchaseDetail::insert($data);                     
                 }

        $purchasedetails = PurchaseDetail::where('purchase_id', $purchase_id)->get();

        if(Session::get('mode_purchase') == 'Receive'){
           //purchase receive
          foreach($purchasedetails as $value)
        {
          $product = Product::find($value->product_id);
          $product->qty_purchased = $product->qty_purchased  + $value->qty;    
          $product->qty = $product->qty  + $value->qty;                
          $product->save();

          $inventories = new Inventory;
          $inventories->product_id = $value->product_id;
          $inventories->user_id = Auth::User()->id;
          $inventories->in_out_qty = $value->qty;
          $inventories->remarks = 'PO-RECEIVE'.$purchase_id;
          $inventories->save();                    
        }

        }else{
          //purchase return
          foreach($purchasedetails as $value)
        {
          $product = Product::find($value->product_id); 
          $product->qty = $product->qty  - $value->qty;                
          $product->save();

          $inventories = new Inventory;
          $inventories->product_id = $value->product_id;
          $inventories->user_id = Auth::User()->id;
          $inventories->in_out_qty = $value->qty;
          $inventories->remarks = 'PO-RETURN'.$purchase_id;
          $inventories->save();                    
        }

        }

        }

            } catch (Exception $e) {
              DB::rollback();
              var_dump($e->getErrors());
            }
          DB::commit();
            
        Session::flash('purchase_create', 'Purchase is Successfully!');
        Session::forget('cart_purchase');                  
        return redirect('admin/purchase/complete/'.$purchase_id);   

        }

      function complete(Request $res, $id){

        $exchange = Exchange::orderBy('id','desc')->first();

         $purchase= Purchase::findOrFail($id);
         $receivingdetail = PurchaseDetail::where('purchase_id',$purchase->id)->get();
        
         return view('admin.purchase.complete')   
            ->with('receiving', $purchase)    
            ->with('exchange', $exchange)          
            ->with('receivingdetail', $receivingdetail); 
        }

     public function scanBarcode(Request $request){      
    // $data=Product::select('id','name','price')->where('barcode', $request->barcode)->orderBy('created_at','DESC')->first();
      $data = DB::table('product')
        ->join('change_price', 'change_price.product_id', '=', 'product.id')
        ->select('product.id', 'product.name', 'change_price.cost')
        ->where('barcode', $request->barcode)
        ->orderBy('change_price.created_at','DESC')->first();
   // dd($data);
     return response()->json($data);

    }

    public function load_initial()
    {
        
        $data = $this->_loadCart();

        $suppliers=array();
        foreach (Supplier::all() as $supplier) {
         $suppliers[$supplier->id]=$supplier->company_name;
        }

         $shippers=array();
        foreach (Shipper::all() as $shipper) {
         $shippers[$shipper->id]=$shipper->company_name;
        }     

      $exchange = Exchange::orderBy('id','desc')->first();
     return view('admin.purchase.purchase_initial',compact('data','exchange','shippers','suppliers'));

    }

    public function index(){

        //Session::forget('cart_purchase');
        $data = $this->_loadCart();
       
         $suppliers=array();
        foreach (Supplier::all() as $supplier) {
         $suppliers[$supplier->id]=$supplier->company_name;
        }

         $shippers=array();
        foreach (Shipper::all() as $shipper) {
         $shippers[$shipper->id]=$shipper->company_name;
        }    

        $exchange = Exchange::orderBy('id','desc')->first();

        return view('admin.purchase.purchase',compact('data','shippers','suppliers','exchange'));
    }

     function _loadCart()
      {
      if(!Session::has('mode_purchase')){
       $data['mode'] = Session::put('mode_purchase','Receive');
      }else{
        $data['mode'] = Session::get('mode_purchase');
      }
      if(!Session::has('cart_purchase')){
      $data['totalCost'] = 0;        
      }else{
      $oldCart=Session::get('cart_purchase');
      $cart=new CartPurchase($oldCart);
      $data['totalCost'] = $cart->totalCost;
      }
      return $data;
}


}

