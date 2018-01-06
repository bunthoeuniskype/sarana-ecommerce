<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Validator;
use Session;
use App\Http\Requests;
use Redirect;
use App\Payowed;
use App\PayowedDetail;
use Auth;
use DB;
class PayowedController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
   public function index(Request $request){

        $payowed = Payowed::orderBy('id','DESC')->get();
        return view('admin.payowed.index',compact('payowed'));
    }

   
    public function create(){

        $customers=array();
        $customers['']='-- Select Customer --';
        foreach (Customer::all() as $cust) {
         $customers[$cust->id]=$cust->firstname.' '.$cust->lastname.' - '.$cust->phone;
        }  
    	return view('admin.payowed.create')->with('customers',$customers);
    }

    public function store(Request $request){      

        //payment per term
        $payment_term = number_format(round($request->total_amount / $request->month_to_pay, 2), 2, '.', ',');
        $start_date_payment = date('Y-m-d', strtotime($request->start_date_payment));
         DB::beginTransaction();

            try {
              
                $payowed = new Payowed();
                $payowed->customer_id = $request->customer_id;
                $payowed->total_amount = $request->total_amount;
                $payowed->payment_term = $payment_term;
                $payowed->month_to_pay = $request->month_to_pay;
                $payowed->total_paid = 0;
                $payowed->status = 1;
                $payowed->description = $request->description;
                $payowed->start_date_payment = $start_date_payment;
                $payowed->user_id = Auth::user()->id;               
            
          if($payowed->save()){ 
            $payowed_id = $payowed->id;
            $days = 30; // per month = 30 days
             for ($i = 1; $i <= $request->month_to_pay; $i++){

            $frequency = $days * $i;
            $newdate = strtotime('+'.$frequency.' day', strtotime($start_date_payment));

            
            //check if payment date landed on weekend
            //if Sunday, make it Monday. If Saturday, make it Friday
            if(date('D', $newdate) == 'Sun') {
                $newdate = strtotime('+1 day', $newdate);
            } elseif(date ('D' , $newdate) == 'Sat') {
                $newdate = strtotime('-1 day', $newdate);
            }

           // dd(date('Y-m-d', strtotime($start_date_payment)));
            
            $payment_date = date('Y-m-d', $newdate);

                $data = array(
                    'payowed_id' => $payowed_id,
                    'payment_date'=> $payment_date,
                    'payment_term' => $payment_term,
                    'paid' => 0,
                    'status' => 1,
                    'user_id' => Auth::user()->id             
                 );  
                PayowedDetail::insert($data);                     
                 }

                }

            } catch (Exception $e) {
              DB::rollback();
              var_dump($e->getErrors());
            }
          DB::commit();

    	Session::flash('save','Save is Successfully !');
    	return redirect('admin/pay-deposite/'.$payowed_id.'/view');
    }


    public function paymentPost(Request $request,$id){      

        //payment per term
        $payment_term = $request->payment_term;
        $payment_date = date('Y-m-d', strtotime($request->payment_date));
         DB::beginTransaction();

            try {
              
                $payowed = Payowed::findorfail($id);              
                $payowed->total_paid =  $payowed->total_paid+$payment_term;                
                $payowed->user_id = Auth::user()->id;               
            
          if($payowed->save()){ 
           
           $pay = PayowedDetail::where(['payowed_id'=>$id,'status'=>1,['payment_term','>','paid']])->orderBy('id','asc')->first();
           $pay->paid = $payment_term;
           $pay->status = 0;   
           $pay->paid_date = $payment_date;    
           $pay->save();                    
       
                }

            } catch (Exception $e) {
              DB::rollback();
              var_dump($e->getErrors());
            }
          DB::commit();

        Session::flash('save','Payment is Successfully !');
        return redirect('admin/pay-deposite/'.$id.'/view');
    }
    

    public function view($id){  

    	$payowed = Payowed::findorfail($id);
        $payoweddetail = PayowedDetail::where('payowed_id',$payowed->id)->get();
    	return view('admin.payowed.view_2')
    	->with('payowed', $payowed)
        ->with('payoweddetail',$payoweddetail);

    }

    function payment(Request $request,$id){
        $payowed = Payowed::findorfail($id);
        $payoweddetail = PayowedDetail::where('payowed_id',$payowed->id)->get();
        return view('admin.payowed.payment')
        ->with('payowed', $payowed)
        ->with('payoweddetail',$payoweddetail); 
    }

   
}
