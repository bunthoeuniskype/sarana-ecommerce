<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Customer;

class LoginCustomerController extends Controller
{
  
    protected $redirectTo = '/customerprofile';

   public function __construct()
    {
      $this->middleware('guest:customer')->except('logout');
    }

     public function getLogin(Request $request)
    {
       return view('site.customerlogin');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'username'   => 'required',
        'password' => 'required|min:6'
      ]);

      $cust = Customer::where('email',$request->username)->orWhere('username', $request->username)->first();
      if($cust){
         // Attempt to log the user in
        if (Auth::guard('customer')->attempt(['username' => $cust->username, 'password' => $request->password,'status'=>1], $request->remember)) {
          // if successful, then redirect to their intended location       
            return redirect()->intended('customerprofile');      
        }
           // if unsuccessful, then redirect back to the login with the form data
       \Session::flash('login','Invalid Email and Password!');
       return redirect()->back()->withInput($request->only('username', 'remember'));
      }   
      // if unsuccessful, then redirect back to the login with the form data
       \Session::flash('login','Invalid Email and Password!');
      return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout()
    {
       Auth::guard('customer')->logout();
       return redirect('/');
    }
}
