<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use File;
use Redirect;
use App\Orders;
class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
  public function profile(Request $request)
    {
        $orders = Orders::where('customer_id', Session::get('customer')->id)->get();
        $orders->transform(function($order,$key)
        {
            $order->cart = unserialize( $order->cart);
            return $order;
        });

   return view('customerprofile',compact('orders'));
    }

    public function getLogin(Request $request)
    {
       return view('customerlogin');
    }
       public function getLogin_app(Request $request)
    {
       return view('customerlogin_app');
    }

      public function logout(Request $request)
    {
        Session::forget('customer');
       return redirect('shopping');
    }

     public function PostLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $customers = Customer::where('email','=', $email)
                                    ->where('password','=',$password)
                                    ->first();

        
       Session::put('customer',$customers);
       if(!Session::has('customer')){
        Session::flash('login','Invalid Email and Password!');
        return Redirect::back();
       }
        if(Session::has('oldUrl')){
            $oldUrl = Session::get('oldUrl');
            Session::flash('login','Invalid Email and Password!');
            return redirect::to($oldUrl);
        }else{
           return view('customerprofile');
        }
        
       
    }
     public function GetRegister(Request $request)
    {
       return view('customerlogin');
    }

     public function PostRegister(Request $request)
    {
       return view('customerlogin');
    }



    public function index(Request $request){

        $customer = Customer::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.customer.index',compact('customer'));
    }

   
    public function create(){
    	return view('admin.customer.create');
    }

    public function store(Request $request){           

    	//create customer
    	$customer = new Customer();
        $req = $request->all();
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=> $customer->encryptedAttribute($request->account_number)));
        $customer->create($data);
    	Session::flash('save','Save is Successfully !');
    	return redirect('admin/customer/create');
    }

    public function edit($id){  

    	$customer = Customer::findorfail($id);
        $customer->account_number = $customer->decryptedAttribute($customer->account_number);
    	return view('admin.customer.edit')
    	->with('customer', $customer);

    }

    public function update(Request $request, $id){

        $customer = Customer::findorfail($id);
        $req = $request->all();
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),
            'account_number'=>$customer->encryptedAttribute($request->account_number)));
        $customer->update($data);    	
    	Session::flash('save','Save is Successfully!');
    	return redirect('admin/customer');
    }

       public function delete($id){        
        $customer= Customer::find($id);
        $customer->status = 0;
        $customer->update();
        Session::flash('save','Delete is Successfully!');
        return redirect('admin/customer');
    }

    public function destroy($id){    	
    	$customer= Customer::find($id);
        $customer->delete();
    	return redirect('customer');
    }
}
