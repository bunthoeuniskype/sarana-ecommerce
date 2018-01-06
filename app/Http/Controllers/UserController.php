<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\Http\Requests;
use Redirect;
use Session;
use Validator;
use Auth;
use DB;

use Illuminate\Foundation\Auth\ThrottlesLogins;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;


class UserController extends Controller
{

  use ThrottlesLogins, RedirectsUsers;

 // protected $redirectTo = '/admin';

  public function __construct()
    {
      //  $this->middleware('auth');
    }
     public function index(Request $request){
       $user = User::where('status',1)->orderBy('id','desc')->get();
        return view('admin.user.index',compact('user'));
    }
   
    public function create(){

       $employees=array();
       $employees['']='-- select Employee --';
        foreach (Employee::where('status',1)->get() as $employee) {
          $employees[$employee->id]=$employee->firstname.' '.$employee->lastname;
        }

        $roles = array(''=>'-- select Role --','User'=>'User','Admin'=>'Admin','Seller'=>'Seller','Stock'=>'Stock');

       
    	return view('admin.user.create', compact('employees','roles'));
    }


     public function store(Request $request){

      $this->validate($request,[ 
            'employee_id' => 'required',         
            'name' => 'required', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:30|min:6|same:confirm_password', 
            'role' => 'required',                    
            ]); 

      $user = new User;     
      $user->employee_id = $request->employee_id;
      $user->role = $request->role;
      $user->name = $request->name;
      $user->email = $request->email;      
      $user->password = bcrypt($request->password);    
      $user->remember_token = $request->_token;        
      $user->save();
      Session::flash('save','Save is Successfully !');
      return redirect('admin/user/create');
    	
    }

     public function edit($id){  

       $employees=array();
       $employees['']='-- select Employee --';
        foreach (Employee::where('status',1)->get() as $employee) {
          $employees[$employee->id]=$employee->firstname.' '.$employee->lastname;
        }

        $roles = array(''=>'-- select Role --','User'=>'User','Admin'=>'Admin','Seller'=>'Seller','Stock'=>'Stock');

      $user = User::findorfail($id);
      return view('admin.user.edit',compact('employees','roles','user'));

    }

    public function update(Request $request, $id){

        $user = User::find($id);

      $this->validate($request,[
            'employee_id' => 'required',
            'name' => 'required', 
            'email' => 'required|email|unique:users,email,'.$user->id.'id',          
            'role' => 'required',  
            'password' => 'same:confirm_password',         
            ]); 
        
     if(!empty($input['password'])){ 
           $user->password = Hash::make($input['password']);
        }

      $user->employee_id = $request->Input('employee_id');
      $user->name = $request->Input('name');
      $user->email = $request->Input('email');      
      $user->role = $request->Input('role');
      $user->remember_token = $request->Input('_token');
      $user->save();
      Session::flash('save','Save is Successfully !');
      return redirect('admin/user');
    }


    public function delete($id){ 
      $users = User::find($id);
      $users->status = 0;
      $users->save();
      Session::flash('save','Delete is Successfully !');
      return redirect('admin/user');

    }

    public function destroy($id){ 
      $users = User::find($id);
      $users->delete();
      return redirect('admin/user');

    }

   
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
  
 public function username()
    {
        return 'email';
    }


    public function getLogin()
    {
      if(Auth::guest()){         
          return view('auth.login');
        }else{
          return redirect('/admin');           
        }  
    }


    public function logout()
    {
        Auth::guard($this->getGuard2())->logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/admin');
    }

  protected function getGuard2()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

   
    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.


        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
       
        $credentials = $this->getCredentials($request,['status'=>1]);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
             DB::table('log_history')->insert(['user_id' => Auth::user()->id,'ip_address' => $_SERVER['REMOTE_ADDR'] ]);           
        
         return $this->handleUserWasAuthenticated($request, $throttles);            
        }

        
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }
        
        Session::flash('failed','E-mail and Password Invalid !');
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        \Session::put('locale',$request->locale);       

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);        
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request, $status)
    {
        $r = $request->only($this->loginUsername(), 'password');
        $data = array_merge($status,$r);
        return $data;
    }

 
    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

}
