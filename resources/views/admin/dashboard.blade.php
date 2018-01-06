@extends('admin.layout.master')

@section('content')

 @if(checkPermission(['admin','stock']))
<div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-blue">
              <a href="{{url('admin/product')}}">
                    <div class="icon"><i class="fa fa-database"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_product">0</div>
                    <h3>{{trans('common.product')}}</h3>
                   <p>Product</p>
                   </a>
                </div>
 </div>
 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-orange">
               <a href="{{url('admin/purchase')}}">
                    <div class="icon"><i class="fa fa-server"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_purchase">0</div>
                    <h3>{{trans('common.purchase')}}</h3>
                   <p>Purchase</p>
                   </a>
                </div>
 </div>   

 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-white">
               <a href="{{url('admin/supplier')}}">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_supplier">0</div>
                    <h3>{{trans('common.supplier')}}</h3>
                   <p>Supplier</p>
                   </a>
                </div>
 </div>   

 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-white">
             <a href="{{url('admin/shipper')}}">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_shipper">0</div>
                    <h3>{{trans('common.shipper')}}</h3>
                   <p>Shipper</p>
                   </a>
                </div>
 </div>      
@endif
@if(checkPermission(['admin','sale']))
 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-green">
                <a href="{{url('admin/sale')}}">
                    <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_sale">0</div>
                    <h3>{{trans('common.sale')}}</h3>
                   <p>Sale</p>
                   </a>
                </div>
 </div>   
 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-white">
               <a href="{{url('admin/customer')}}">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_customer">0</div>
                    <h3>{{trans('common.customer')}}</h3>
                   <p>Customer</p>
                   </a>
                </div>
 </div>  
@endif
@if(checkPermission(['admin']))
 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-white">
               <a href="{{url('admin/employee')}}">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_employee">0</div>
                    <h3>{{trans('common.employee')}}</h3>
                   <p>Employee</p>
                   </a>
                </div>
 </div>   

  <div class="col-md-3 col-sm-3" style="margin-bottom: 3px;">
                <div class="tile-stats tile-pink">
                <a href="{{url('admin/pay-deposite')}}">
                    <div class="icon"><i class="fa fa-dollar"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_payowed">0</div>
                    <h3>{{trans('common.pay_deposite')}}</h3>
                   <p>Pay Deposite</p>
                   </a>
                </div>
 </div> 
 

  <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-pink">
                <a href="{{url('admin/exchange')}}">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_exchange">0</div>
                    <h3>{{trans('common.exchange_rate')}}</h3>
                   <p>Exchange Rate</p>
                   </a>
                </div>
 </div> 

<div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-pink">
                <a href="{{url('admin/expense_income')}}">
                    <div class="icon"><i class="fa fa-dollar"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="count_expense_income">0</div>
                    <h3>{{trans('common.expense_income')}}</h3>
                  <p>Expense Income</p>
                   </a>
                </div>
 </div> 

 <div class="col-md-3 col-sm-3">
                <div class="tile-stats tile-brown">
                <a href="{{url('admin/report')}}">
                    <div class="icon"><i class="fa fa-cog"></i></div>
                    <div class="num" data-start="0" data-end="8" data-postfix="#" data-duration="1500" data-delay="0" id="setting"> &nbsp;</div>
                    <h3>{{trans('common.report')}}</h3>
                  <p>Report</p>
                   </a>
                </div>
 </div> 

@endif


<script type="text/javascript">

  $(function () {
    $('#count_product').html('<?= $count_product ?>');  
    $('#count_sale').html('<?= $count_sale ?>');
    $('#count_purchase').html('<?= $count_purchase ?>');    
    $('#count_supplier').html('<?= $count_supplier ?>');  
    $('#count_shipper').html('<?= $count_shipper ?>');  
    $('#count_customer').html('<?= $count_customer ?>');  
     $('#count_employee').html('<?= $count_employee ?>');    
    $('#count_payowed').html('<?= $count_payowed ?>');  
    $('#count_exchange').html('<?= $count_exchange ?>');  
    $('#count_expense_income').html('<?= $count_expense_income ?>');  
  });


</script>

 @endsection