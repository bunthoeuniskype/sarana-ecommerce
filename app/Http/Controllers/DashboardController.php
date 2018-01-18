<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
use App\Http\Classes\RestoreDB;
use DB;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
  public function index(Request $request){

  		
    /* $salesReport = Sale::orderby('id','DESC')->take(5)->get();
    $purchasesReport = Purchase::orderby('id','DESC')->take(5)->get();*/
    $data['count_product'] = Product::where('status',1)->count('*');
    $data['count_sale'] = Sale::count('*');
    $data['count_purchase'] = Purchase::count('*');
    $data['count_supplier'] = Supplier::where('status',1)->count('*');
    $data['count_shipper'] = Shipper::where('status',1)->count('*');
    $data['count_customer'] = Customer::where('status',1)->count('*');
    $data['count_employee'] = Employee::where('status',1)->count('*');
    $data['count_payowed'] = Payowed::where('status',1)->count('*');
    $data['count_exchange'] = Exchange::where('status',1)->count('*');
    $data['count_expense_income'] = ExpenseIncome::where('status',1)->count('*');
	return view('admin.dashboard', $data);
    }

    public function backup()
    {
        
    $con = DB::connection()->getconfig();    

    $host = $con['host'];
    $username = $con['username'];
    $password = $con['password'];
    $database = $con['database'];

    $backupDatabase = new BackupDB($host, $username, $password, $database);
    $result = $backupDatabase->backupTables("*");
    return redirect(url($result));

   } 


}
