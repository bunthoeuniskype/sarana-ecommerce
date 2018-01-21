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

Route::post('/locale', array(
    'Middleware' => 'LanguagesMiddleware',
    'uses' => 'LanguageController@index'
     ));
Route::get('/locale', array(
    'Middleware' => 'LanguagesMiddleware',
    'uses' => 'LanguageController@index'
     ));

Route::group(['middleware' => ['checkout']], function () {	

Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'AddMoneyController@payWithPaypal',));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'AddMoneyController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'AddMoneyController@getPaymentStatus',));

Route::get('cancelCart', 'ShoppingController@cancelCart');
Route::get('/checkout', array(
	'uses' => 'ShoppingController@CheckOut',
	'as' => 'shopping.checkout'
	 ));

Route::get('order-items', ['uses'=>'ShoppingController@OrdersItems','as'=>'order.items']);

Route::get('/customerlogout', ['as'=>'customer.logout','uses'=>'Auth\LoginCustomerController@logout']);
Route::get('/customerprofile', 'CustomerController@profile')->name('customer');

Route::get('/getcart', array(
	'uses' => 'ShoppingController@getCart',
	'as' => 'shopping.getcart'
	 ));	 
});

Route::group(['middleware' => ['web']], function () {	

Route::get('/contact', 'HomeController@contact');
Route::post('/feedback', ['uses'=>'HomeController@feedback','as'=>'feedback']);

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::get('/customerlogin', ['as'=>'customer.login','uses'=>'Auth\LoginCustomerController@getLogin']);
Route::post('/customerlogin', ['uses'=>'Auth\LoginCustomerController@login','as'=>'customer.postLogin']);

Route::get('/customersignup', 'CustomerController@getSignup');
Route::post('/customersignup', 'CustomerController@postSignup');

Route::get('test','TestController@testview');
Route::post('test-form','TestController@test');

Route::get('admin/product/select_product_unit',['uses'=>'ProductController@select_product_unit','as'=>'select_product_unit']);
Route::get('admin/product/select_product_color',['uses'=>'ProductController@select_product_color','as'=>'select_product_color']);
Route::get('admin/product/select_product_barcode',['uses'=>'ProductController@select_product_barcode','as'=>'select_product_barcode']);

Route::get('/favorite', 'ShoppingController@favoriteProduct');

//site
Route::get('/', 'ShoppingController@index');
Route::get('category/{slug}', 'ShoppingController@byCategory');
Route::get('/subcategory/{slug}', 'ShoppingController@bySubCategory');

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

Route::get('product/detail/{slug}','ShoppingController@detail');

Route::get('search','ShoppingController@search');

Route::get('admin/login',['uses'=>'UserController@getLogin','as'=>'login']);
Route::post('user/login',['uses'=>'UserController@login','as'=>'user.login']);
});

Route::group(['middleware'=>'auth'], function () {
//admin	
Route::get('user/logout',['uses'=>'UserController@logout','as'=>'user.logout']);

Route::resource('admin/advertisement','AdsController');

Route::get('admin','DashboardController@index');
Route::get('admin/backup','DashboardController@backup');

Route::get('admin/orders','OrderController@index');

Route::resource('admin/category','CategoryController');
Route::resource('admin/subcategory','SubCategoryController');
Route::resource('admin/customer','CustomerController');
Route::get('admin/customer/{id}/delete','CustomerController@delete');
Route::resource('admin/supplier','SupplierController');
Route::get('admin/supplier/{id}/delete','SupplierController@delete');
Route::resource('admin/shipper','ShipperController');
Route::get('admin/shipper/{id}/delete','ShipperController@delete');
Route::resource('admin/employee','EmployeeController');
Route::get('admin/employee/{id}/delete','EmployeeController@delete');

Route::resource('admin/exchange','ExchangeController');
Route::get('admin/exchange/{id}/delete','ExchangeController@delete');

Route::resource('admin/expense_income','ExpenseIncomeController');
Route::get('admin/expense_income/{id}/delete','ExpenseIncomeController@delete');

Route::resource('admin/product','ProductController');
Route::get('admin/product/{id}/delete','ProductController@delete');

Route::get('admin/gallery/{product_id}','ProductGalleryController@addGallery');
Route::post('admin/gallery','ProductGalleryController@store');
Route::get('admin/gallery/{id}/delete','ProductGalleryController@destroy');
Route::get('admin/gallery/{id}/edit','ProductGalleryController@edit');
Route::put('admin/gallery/{id}','ProductGalleryController@update');

Route::resource('admin/user', 'UserController');
Route::get('admin/user/{id}/delete','UserController@delete');

Route::resource('admin/setting', 'SettingController');

Route::get('admin/purchase', 'PurchaseController@index');
Route::post('admin/purchase', 'PurchaseController@store');
Route::get('admin/purchase/complete/{id}', 'PurchaseController@complete');
Route::get('admin/purchase/addcart/{id}', 'PurchaseController@AddToCart');
Route::get('admin/purchase/load_initial_purchase', ['uses'=>'PurchaseController@load_initial','as'=>'load_initial.purchase']);
Route::get('admin/purchase/remove/{id}', 'PurchaseController@getRemove');
Route::get('admin/purchase/mode', ['uses'=>'PurchaseController@mode','as'=>'mode.purchase']);
Route::get('admin/purchase/updatecart',['uses'=>'PurchaseController@getUpdateCart','as'=>'purchase.updatecart']);


Route::get('admin/sale', 'SaleController@index');
Route::post('admin/sale', 'SaleController@store');
Route::get('admin/sale/complete/{id}', 'SaleController@complete');
Route::get('admin/sale/addcart/{id}', 'SaleController@AddToCart');
Route::get('admin/sale/load_initial_sale', ['uses'=>'SaleController@load_initial','as'=>'load_initial.sale']);
Route::get('admin/sale/remove/{id}', 'SaleController@getRemove');
Route::get('admin/sale/mode', ['uses'=>'SaleController@mode','as'=>'mode.sale']);
Route::get('admin/sale/updatecart',['uses'=>'SaleController@getUpdateCart','as'=>'sale.updatecart']);

Route::resource('admin/pay-deposite', 'PayowedController');
Route::get('admin/pay-deposite/{id}/view', 'PayowedController@view');
Route::get('admin/pay-deposite/{id}/payment', 'PayowedController@payment');
Route::post('admin/pay-deposite/{id}/payment', 'PayowedController@paymentPost');

Route::get('admin/report/', 'ReportController@index');
Route::get('admin/report/product', 'ReportController@product');
Route::get('admin/report/customer', 'ReportController@customer');
Route::get('admin/report/shipper', 'ReportController@shipper');
Route::get('admin/report/supplier', 'ReportController@supplier');
Route::get('admin/report/employee', 'ReportController@employee');
Route::get('admin/report/pay-deposite', 'ReportController@pay_deposite');
Route::get('admin/report/exchange', 'ReportController@exchange');
Route::get('admin/report/expense_income', 'ReportController@expense_income');
Route::get('admin/report/inventory', 'ReportController@inventory');
Route::get('admin/report/sale', 'ReportController@sale');
Route::get('admin/report/purchase', 'ReportController@purchase');
//end admin
});

