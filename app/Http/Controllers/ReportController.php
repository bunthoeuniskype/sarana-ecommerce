<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Product;
use App\Customer;
use App\Supplier;
use App\Shipper;
use App\Employee;
use App\Payowed;
use App\Exchange;
use App\ExpenseIncome;
use App\Inventory;
use App\Sale;
use App\Purchase;

class ReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
  public function index(Request $request){    
	return view('admin.report.index');
    }

// CREATE TEMPORARY TABLE
//$modelductList = DB::insert( DB::raw( "CREATE TEMPORARY TABLE tempproducts") );
// DELETE TEMPORARY TABLE
//$dropTable = DB::unprepared( DB::raw( "DROP TEMPORARY TABLE tempproducts" ) );

  public function product(Request $request)
  {
   
   $model = new Product();
   $model->create_table_temp();
   $report_data = $model->get_table_temp();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
        array('data'=>$row->barcode, 'align' => 'left'), 
        array('data'=>$row->name, 'align' => 'left'),
        array('data'=>$row->cost, 'align' => 'left'), 
        array('data'=>$row->price, 'align' => 'left'),
        array('data'=>$row->qty, 'align' => 'left'), 
        array('data'=>$row->discount, 'align' => 'left'),
        array('data'=>$row->unit, 'align' => 'left'), 
        array('data'=>$row->color, 'align' => 'left'),
        array('data'=>$row->qty_purchased, 'align' => 'left')
       );
    }

    $data = array(
      "title" => trans('common.product'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);

  }

  public function customer()
  {
   $model = new Customer();

   $report_data = Customer::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
      array('data'=>$row->firstname, 'align' => 'left'), 
        array('data'=>$row->lastname, 'align' => 'left'),
        array('data'=>$row->gender, 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->dob)), 'align' => 'left'), 
        array('data'=>$row->email, 'align' => 'left'), 
        array('data'=>$row->phone, 'align' => 'left'),        
        array('data'=>$row->address, 'align' => 'left')        
       );
    }

    $data = array(
      "title" => trans('common.customer'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

  public function shipper()
  {
   $model = new Shipper();

   $report_data = Shipper::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
      array('data'=>$row->firstname, 'align' => 'left'), 
        array('data'=>$row->lastname, 'align' => 'left'),
        array('data'=>$row->gender, 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->dob)), 'align' => 'left'), 
        array('data'=>$row->email, 'align' => 'left'), 
        array('data'=>$row->phone, 'align' => 'left'),        
        array('data'=>$row->address, 'align' => 'left')        
       );
    }

    $data = array(
      "title" => trans('common.shipper'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

   public function supplier()
  {
   $model = new Supplier();

   $report_data = Supplier::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
      array('data'=>$row->firstname, 'align' => 'left'), 
        array('data'=>$row->lastname, 'align' => 'left'),
        array('data'=>$row->gender, 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->dob)), 'align' => 'left'), 
        array('data'=>$row->email, 'align' => 'left'), 
        array('data'=>$row->phone, 'align' => 'left'),        
        array('data'=>$row->address, 'align' => 'left')        
       );
    }

    $data = array(
      "title" => trans('common.supplier'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

   public function employee()
  {
   $model = new Employee();

   $report_data = Employee::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
      array('data'=>$row->firstname, 'align' => 'left'), 
        array('data'=>$row->lastname, 'align' => 'left'),
        array('data'=>$row->gender, 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->dob)), 'align' => 'left'), 
        array('data'=>$row->email, 'align' => 'left'), 
        array('data'=>$row->phone, 'align' => 'left'),        
        array('data'=>$row->address, 'align' => 'left')        
       );
    }

    $data = array(
      "title" => trans('common.employee'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }


   public function pay_deposite()
  {
   $model = new Payowed();

   $report_data = Payowed::orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(
        array('data'=>date("d-M-Y", strtotime($row->created_at)), 'align' => 'left'), 
        array('data'=>$row->customer->firstname.' '.$row->customer->lastname, 'align' => 'left'),        
        array('data'=>$row->customer->gender, 'align' => 'left'),        
        array('data'=>$row->customer->email, 'align' => 'left'), 
        array('data'=>$row->customer->phone, 'align' => 'left'),        
        array('data'=>$row->total_amount, 'align' => 'left'),
        array('data'=>$row->total_paid, 'align' => 'left'), 
        array('data'=>$row->total_amount -  $row->total_paid, 'align' => 'left'),    
       );
    }

    $data = array(
      "title" => trans('common.pay_deposite'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

   public function exchange()
  {
   $model = new Exchange();

   $report_data = Exchange::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(       
        array('data'=>'$ '.$row->dollar, 'align' => 'left'),        
        array('data'=>'៛ '.$row->riel, 'align' => 'left'),        
        array('data'=>date("d-M-Y", strtotime($row->date)), 'align' => 'left'),     
       );
    }

    $data = array(
      "title" => trans('common.exchange_rate'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

  public function expense_income()
  {
   $model = new ExpenseIncome();

   $report_data = ExpenseIncome::where('status',1)->orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(   
        array('data'=>'$ '.$row->total_income, 'align' => 'left'),            
        array('data'=>'$ '.$row->total_expense, 'align' => 'left'),
        array('data'=>'$ '.($row->total_income-$row->total_expense), 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->date)), 'align' => 'left'),        
             
       );
    }

    $data = array(
      "title" => trans('common.expense_income'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }

   public function inventory()
  {
   $model = new Inventory();

   $report_data = Inventory::orderBy('id','desc')->get();

    $tabular_data = array();
    foreach($report_data as $row)
    {
      $tabular_data[] = array(   
        array('data'=>$row->product->name, 'align' => 'left'),            
        array('data'=>$row->in_out_qty, 'align' => 'left'),
        array('data'=>$row->remarks, 'align' => 'left')      
             
       );
    }

    $data = array(
      "title" => trans('common.inventory'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "data" => $tabular_data,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular',$data);
  }


    public function sale()
  {
   $model = new Sale();

   $report_data = Sale::orderBy('id','desc')->get();

    $detailData = array();
    $summayData = array();

    foreach($report_data as $key => $row)
    {
      $summayData[] = array(   
        array('data'=>'<a href='.url('admin/sale/complete/'.$row->id).'>'.$row->mode.'-'.$row->id.'</a>', 'align' => 'left'),
        array('data'=>$row->user->name, 'align' => 'left'),
        array('data'=>$row->customer_id==''?'':$row->customer->firstname.' '.$row->customer->lastname, 'align' => 'left'),            
        array('data'=>$row->saledetail->sum('qty'), 'align' => 'left'),
        array('data'=>'$ '.$row->total, 'align' => 'left'),
        array('data'=>'$ '.$row->amount_paid, 'align' => 'left'),
        array('data'=>'$ '.$row->amount_due, 'align' => 'left'),
        array('data'=>'$ '.$row->change_due, 'align' => 'left'),
        array('data'=>date("d-M-Y", strtotime($row->date)), 'align' => 'left'),  
        array('data'=>$row->mode, 'align' => 'left')      
             
       );

       
        foreach($row->saledetail as $drow)
        {
          $detailData[$key][] = array(
            array('data'=>$drow->product->barcode, 'align' => 'left'),
            array('data'=>$drow->product->name, 'align' => 'left'),
            array('data'=>$drow->qty, 'align' => 'left'),
            array('data'=>'$ '.$drow->price, 'align' => 'left'),
            array('data'=>$drow->discount.' %', 'align' => 'left'),
            array('data'=>$drow->tax.' %', 'align' => 'left'),
            array('data'=>'$ '.$drow->amount, 'align' => 'left')
            );
        }

    }

    //dd($detailData);


    $data = array(
      "title" => trans('common.sale'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "summayData" => $summayData,
      "detailData" => $detailData,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular_detail',$data);
  }

   public function purchase()
  {

   $model = new Purchase();
   $report_data = Purchase::orderBy('id','desc')->get();

    $detailData = array();
    $summayData = array();
    
    foreach($report_data as $key => $row)
    {
      $summayData[] = array(   
        array('data'=>'<a href='.url('admin/purchase/complete/'.$row->id).'>'.$row->mode.'-'.$row->id.'</a>', 'align' => 'left'),
        array('data'=>$row->user->name, 'align' => 'left'),
        array('data'=>$row->supplier_id ==''?'':$row->supplier->company_name, 'align' => 'left'), 
        array('data'=>$row->shipper_id ==''?'':$row->shipper->company_name, 'align' => 'left'),                
        array('data'=>$row->purchasedetail->sum('qty'), 'align' => 'left'),
        array('data'=>'$ '.$row->sub_total, 'align' => 'left'),
        array('data'=>'$ '.$row->discount_amount, 'align' => 'left'),
        array('data'=>'$ '.$row->total, 'align' => 'left'),
        array('data'=>'$ '.$row->amount_paid, 'align' => 'left'),
        array('data'=>'$ '.$row->amount_due, 'align' => 'left'),       
        array('data'=>date("d-M-Y", strtotime($row->date)), 'align' => 'left'),  
        array('data'=>$row->mode, 'align' => 'left')      
             
       );

       
        foreach($row->purchasedetail as $drow)
        {
          $detailData[$key][] = array(
            array('data'=>$drow->product->barcode, 'align' => 'left'),
            array('data'=>$drow->product->name, 'align' => 'left'),
            array('data'=>$drow->qty, 'align' => 'left'),
            array('data'=>'$ '.$drow->cost, 'align' => 'left'),
            array('data'=>$drow->discount.' %', 'align' => 'left'),         
            array('data'=>'$ '.$drow->amount, 'align' => 'left')
            );
        }

    }

    //dd($detailData);


    $data = array(
      "title" => trans('common.purchase'),
      "subtitle" => '',
      "headers" => $model->get_column(),
      "summayData" => $summayData,
      "detailData" => $detailData,
      "summary_data" => $model->get_summary(),
      "searchable"=>0
    );

   return view('admin.report.tabular_detail',$data);
  }




}
