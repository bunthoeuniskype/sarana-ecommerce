@extends('site.layout.master')

@section('content')
<style type="text/css">
  .img-rounded {
    border: 1px solid #a7da92;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 104px;
    max-height: 99px;
    padding: 3px;
}
</style>

<?php use App\Http\Classes\MakeDateClass; ?>
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Detail Profile</h3></div> 

                  @if ($message = Session::get('success'))
                    <div class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php Session::forget('success');?>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="custom-alerts alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    @endif

                    <div class="panel-body"> 
                    <div class="row">  
                     <div class="col-md-9">   
                       <table class="table table-responsive">   
                        <tr>
                         <td>    
                         <h4>Items Ordered</h4>
                         <hr>
                          @foreach ($orders as $order)
                           <table class="table table-responsive table-bordered">    
                              <tr>
                                <td colspan="2">Payment ID :  {{ $order['payment_id'] }}</td>                  
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
                                  	 {{ $item['item']['name']  }} | QTY : {{ $item['qty']  }} Unit <span class="badge badge-success"> $ {{ $item['price']  }} </span></li>
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
                     <div class="col-md-3">
                        <table class="table table-responsive">
                          <tr>
                            <td> 
                            <button class="btn btn-small btn-primary" style="float:right"><i class="fa fa-edit"></i> Edit Profile</button>
                            <h4>Profile</h4> </td>
                          </tr>
                          <tr>
                            <td style="text-align: center;">
                            <img src="{{ Auth::guard('customer')->user()->image ? Auth::guard('customer')->user()->image : Auth::guard('customer')->user()->image_socail ? Auth::guard('customer')->user()->image_socail : 'public/uploads/images/user.jpg' }}" class="img-rounded img-thumnail"> </td>
                          </tr>
                           <tr>
                            <td>
                              UserName : {{ Auth::guard('customer')->user()->username }}
                            </td>
                          </tr>
                             <tr>
                            <td>
                               First Name : {{ Auth::guard('customer')->user()->firstname }} 
                            </td>
                          </tr>
                             <tr>
                            <td>
                               Last Name : {{ Auth::guard('customer')->user()->lastname }} 
                            </td>
                          </tr>
                            <tr>
                            <td>
                              Gender : {{ Auth::guard('customer')->user()->gender }} 
                            </td>
                          </tr>
                           <tr>
                            <td>
                               Email : {{ Auth::guard('customer')->user()->email }} 
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Phone : {{ Auth::guard('customer')->user()->phone }} 
                            </td>
                          </tr>
                           <tr>
                            <td>
                               Address : {{ Auth::guard('customer')->user()->address }} 
                            </td>
                          </tr>
                          <tr>
                            <td>                             
                              Password : <a href="#">Change Password</a> 
                            </td>
                          </tr>
                        </table>           
                    </div>
                  </div>
               </div>
            </div>

@endsection
