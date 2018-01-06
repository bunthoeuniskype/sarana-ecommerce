<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => ['web']], function () {
	
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ShoppingController@index');

Route::get('/shopping_app', 'ShoppingController@shopping_app');

Route::get('/shoppingcart_app', array(
	'uses' => 'ShoppingController@getCart_app',
	'as' => 'shopping.shoppingcart_app'
	 ));


Route::get('/addtocart/{id}', array(
	'uses' => 'ShoppingController@AddToCart',
	'as' => 'shopping.addtocart'
	 ));

Route::get('/reducebyone/{id}', array(
	'uses' => 'ShoppingController@getReduceByOne',
	'as' => 'shopping.reducebyone'
	 ));

Route::get('/addbyone/{id}', array(
	'uses' => 'ShoppingController@getAddByOne',
	'as' => 'shopping.addbyone'
	 ));

Route::get('/remove/{id}', array(
	'uses' => 'ShoppingController@getRemove',
	'as' => 'shopping.remove'
	 ));


Route::get('/getcart', array(
	'uses' => 'ShoppingController@getCart',
	'as' => 'shopping.getcart'
	 ));

Route::get('/checkout', array(
	'middleware' => 'checkout',
	'uses' => 'ShoppingController@CheckOut',
	'as' => 'shopping.checkout'
	 ));

Route::get('/checkout_app', array(
	'middleware' => 'checkout-app',
	'uses' => 'ShoppingController@CheckOut_App',
	'as' => 'shopping.checkout_app'
	 ));

Route::post('/PaymentByStripe', array(
	'middleware' => 'checkout',
	'uses' => 'ShoppingController@PaymentByStripe',
	'as' => 'shopping.PaymentByStripe'
	 ));

Route::get('/customerlogin_app', 'Customercontroller@getLogin_app');

Route::get('/customerlogin', 'Customercontroller@getLogin');

Route::post('/customerlogin', ['uses'=>'Customercontroller@postLogin',
							 'as'=>'customer.postLogin']);
Route::get('/customerlogout', 'Customercontroller@logout');
Route::get('/customerprofile', 'Customercontroller@profile');



Route::get('/welcome', 'Welcomecontroller@index');
Route::get('/welcome/{locale}', 'Welcomecontroller@index');

Route::group(['before' => 'auth'], function () {
	Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
	Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
	// list all lfm routes here...
});



});


//Route::get('/', 'HomeController@index');
Auth::routes();

Route::group(['middleware'=>'auth'], function () {

Route::get('/admin', 'DashboardController@index');

Route::get('/PurchaseScanBarcode',['uses'=>'Purchasecontroller@scanBarcode', 'as'=>'PurchaseScanBarcode']);
Route::get('/SaleScanBarcode',['uses'=>'Salecontroller@scanBarcode', 'as'=>'SaleScanBarcode']);
Route::get('/findCost',['uses'=>'Purchasecontroller@findCost', 'as'=>'findCost']);
Route::get('/findPrice',array('as' => 'findPrice','uses' => 'Salecontroller@findPrice'));

Route::resource('admin/user', 'Usercontroller');

Route::resource('changeprice', 'ChangePricecontroller');
Route::resource('user', 'Usercontroller');
Route::resource('role', 'Rolecontroller');
Route::resource('supplier', 'Suppliercontroller');
Route::resource('shipper', 'Shippercontroller');
Route::resource('customer', 'Customercontroller');
Route::resource('employee', 'Employeecontroller');
Route::resource('category', 'Categorycontroller');
Route::resource('subcategory', 'SubCategorycontroller');
Route::resource('product', 'Productcontroller');

Route::get('product/{id}/alert', 'Productcontroller@alert');

Route::resource('measure', 'Measurecontroller');
Route::resource('currency', 'Currencycontroller');
Route::resource('purchase', 'Purchasecontroller');
Route::resource('sale', 'Salecontroller');
Route::resource('expenseincome', 'ExpenseIncomecontroller');

Route::get('/reportpurchase', 'ReportPurchaseController@index');
Route::get('/reportpurchase/{id}/print', 'ReportPurchaseController@printreport');

Route::get('/reportsale', 'ReportSaleController@index');
Route::get('/reportsale/{id}/print', 'ReportSaleController@printreport');

Route::get('/reportexpenseincome', 'ReportExpenseIncomeController@index');
Route::get('/reportinventory', 'ReportInventoryController@index');

Route::get('mail', 'Mailcontroller@index');
Route::post('mail/send', 'Mailcontroller@send');


Route::get('/reportlog', 'LogController@index');

	


	Route::get('permissions-all-users',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
	Route::get('permissions-admin-superadmin',['middleware'=>'check-permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
	Route::get('permissions-superadmin',['middleware'=>'check-permission:superadmin','uses'=>'HomeController@superadmin']);

});



