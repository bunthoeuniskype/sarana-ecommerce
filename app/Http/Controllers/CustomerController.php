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
use Auth;
class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
  public function profile(Request $request)
    {

        $orders = Orders::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('id','desc')->get();
        $orders->transform(function($order,$key)
        {
            $order->cart = unserialize($order->cart);
            return $order;
        });

   return view('site.customerprofile',compact('orders'));
    }

    public function getLogin(Request $request)
    {
       return view('site.customerlogin');
    }
    
      public function logout(Request $request)
    {
       Session::forget('customer');
       return redirect('/');
    }

     public function PostLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $customers = Customer::where('username','=', $username)
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
           return view('site.customerprofile');
        }
        
       
    }
     public function getSignup(Request $request)
    {
       return view('site.customersignup');
    }

    public function postSignup(Request $request)
    {
          $this->validate($request,[           
            'username' => 'required|unique:customer,username', 
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required',
            'password' => 'required|max:30|min:6|same:confirm_password',
            'agree'  => 'required',
            ]); 

          $cust = new Customer;     
          $cust->username = $request->username;
          $cust->password =  bcrypt($request->password);
          $cust->email = $request->email;
          $cust->phone = $request->phone;     
          $cust->save();
      Session::flash('save','Save is Successfully !');
      return redirect('customerlogin');
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
