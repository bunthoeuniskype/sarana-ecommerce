@extends('admin.layout.master')

@section('content')
<?php use App\Http\Classes\MakeDateClass; ?>

<div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">  
                  		 <a href="{{ url('admin/orders') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>                
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.order') }} </h3>
                         </div>
                            <div class="panel panel-body">

		 @if(Session::has('save'))
		                        <div class="alert alert-success">
		                        <em>{!! Session('save') !!}</em>
		                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
		                            <span aria-hidden="true">&times</span>
		                        </button>
		                        </div>
		  @endif

         <div class="col-md-12">   
                       <table class="table table-responsive">   
                        <tr>
                         <td>    
                         <h4>Items Ordered</h4>
                         <hr>
                          @foreach ($orders as $order)
                           <table class="table table-responsive table-bordered">    
                              <tr>
                                <td>Payment ID :  {{ $order['payment_id'] }}</td>
                                <td>
                                @if($order->status == 'No Paid')
                                <a href="{{url('admin/orders/payment/'.$order->id)}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-dollar"></i> Payment</a>
                                @else
                                 <a href="{{url('admin/orders/complete/'.$order->id)}}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-print"></i> Invoice</a>
                                @endif
                                </td>                
                              </tr> 

                               <tr>
                                <td>First Name :  {{ $order->customer->first_name }}</td>
                                <td>Email :  {{ $order->customer->email }}</td>
                              </tr> 

                               <tr>
                                <td>Last Name :  {{ $order->customer->last_name }}</td>
                                <td>Phone :  {{ $order->customer->phone }}</td>
                              </tr>
                              
                              <tr>
                                <td>Total Qty :  {{ $order['total_qty'] }}</td>
                                <td>Payment Status :  {{ $order['status'] }}</td>
                              </tr>   
                                <tr>
                                <td>Total Amount :  $ {{ $order['total_amount'] }}</td>
                                <td>Order Date :  <i class="fa fa-clock-o"></i> {{ MakeDateClass::time_elapsed_string($order['created_at']) }}</td>
                              </tr>    
                              <tr>
                                <td colspan="2">
                                  <ul class="list-group" style="list-style: none;">
                                    	@foreach($order->cart->items as $item)
                                    	<li  class="list-group-item"> 
                                    	<img src="{{ asset($item['item']['image']) }}" style="height: 50px;"> 
                                    	barcode : {{ $item['item']['barcode']}} | 
                                  	Product Name : {{ $item['item']['name']  }} | 
                                  	QTY : {{ $item['qty']  }} Unit <span class="badge badge-success"> $ {{ $item['price']  }} </span></li>
                                    	@endforeach	
                                  </ul>                                
                                </td>
                              <tr>
                            </table>
                         @endforeach
                          </td>
                         <tr>
                       </table>   
                </div>
        </div>
</div>
          

@endsection