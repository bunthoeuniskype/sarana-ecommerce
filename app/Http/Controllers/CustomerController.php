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
use App\Exchange;
use Mail;
use Str;

class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
     public function uploadPicture(Request $request)
    {
      $name =  Customer::uploadImageProfile($request->file('picture'));
      $customer = Customer::findorfail(Auth::guard('customer')->user()->id);
      $customer->image = $name;      
      $customer->save();
      return response()->json(['status'=>200,'name'=>$name]);
    }


  public function profile(Request $request)
    {

        $orders = Orders::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('id','desc')->paginate(2);
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
                                ->orWhere('email',$username)
                                ->where('password','=',$password)
                                ->where('status',1)
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
    public function verify(Request $request,$token)
    {
        try {
          $cust = Customer::where('verify',$token);
          $cust->update(['status'=>1,'verify'=>null]);
        } catch (Exception $e) {
          
        }        
        Session::flash('login','Email verify is success!');
        return redirect('customerlogin');
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
          $cust->status = 0; 
          $cust->verify = str_random(60);  
          $cust->save();
                    
         $receiveby = $cust->email;
         $subject = 'Verify Register';
         $messages = 'Your register is Success, Please Verify Email Address before login!';
         $url      = route('verify.email',$cust->verify);
         try {
            Mail::send('site.verify_send_mail',compact('url','messages'), function ($message) use ($receiveby,$subject) {  
            $message->to($receiveby)->subject($subject);
         });
        } catch (Exception $e) {
            
        }
      Session::flash('login','Please Verify Email Address before login!');
      return redirect('customerlogin');
    }   

     public function changePassword(Request $request)
     {
        $validate = Validator::make($request->all(),[
           'password' => 'required|max:30|min:6|same:confirm_password',
          ]);

        if($validate->fails()){
          return response()->json(['error'=>$validate->messages(),'status'=>500]);
        }

        $cust = Customer::find(Auth::guard('customer')->user()->id);
        $cust->password =  bcrypt($request->password);
        if($cust->save()){
          return response()->json(['status'=>200]);
        }
     }

     public function changeProfile(Request $request)
     {
        $validate = Validator::make($request->all(),[
           'username' => 'required|min:3|unique:customer,username,'.Auth::guard('customer')->user()->id.',id', 
          ]);

        if($validate->fails()){
          return response()->json(['error'=>$validate->messages(),'status'=>500]);
        }

        $cust = Customer::find(Auth::guard('customer')->user()->id);      
        if($cust->update($request->all())){
          return response()->json(['status'=>200]);
        }
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
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
     //   $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),'account_number'=> $customer->encryptedAttribute($request->account_number)));
        $customer->create($data);
      Session::flash('save','Save is Successfully !');
      return redirect('admin/customer/create');
    }

    public function edit($id){  

        $customer = Customer::findorfail($id);
        //$customer->account_number = $customer->decryptedAttribute($customer->account_number);
      return view('admin.customer.edit')
      ->with('customer', $customer);

    }

    public function update(Request $request, $id){

        $customer = Customer::findorfail($id);
        $req = $request->all();
        $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob))));
      //  $data = array_merge($req,array('dob' => date('Y-m-d', strtotime($request->dob)),  'account_number'=>$customer->encryptedAttribute($request->account_number)));
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

    public function invoiceComplete($string)
    { 
       $id = base64_decode($string);
       $orders = Orders::where('id',$id)->get();         
        $orders->transform(function($order,$key)
        {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        $exchange = Exchange::orderBy('id','desc')->first();

        return view('site.order_complete',compact('orders','exchange'));
    }
    
}
