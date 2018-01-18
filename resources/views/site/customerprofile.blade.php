@extends('site.layout.master')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading"><h3>Detail Profile</h3><hr></div>
                 
                    <div class="panel-body"> 
                    <div class="row">  
                     <div class="col-md-9">                             
                        @foreach ($orders as $order)                  	
                        <ul class="list-group">
                        	@foreach($order->cart->items as $item)
                        	<li  class="list-group-item"> 
                        	<img src="{{ asset($item['item']['image']) }}" style="height: 50px;"> 
                      	 {{ $item['item']['name']  }} | QTY : {{ $item['qty']  }} Unit <span class="badge badge-success"> $ {{ $item['price']  }} </span></li>
                        	@endforeach	
                        </ul>
                       @endforeach
                    </div>
                     <div class="col-md-3">
                          <h4>Profile</h4>    
                          <hr>
                            <img src="{{ Auth::guard('customer')->user()->image? Auth::guard('customer')->user()->image : Auth::guard('customer')->user()->image_socail }}" class="cycle img-thumnail"> 
                          <hr>
                          UserName : {{ Auth::guard('customer')->user()->username }} 
                          <hr>
                          First Name : {{ Auth::guard('customer')->user()->firstname }} 
                          <hr>
                          Last Name : {{ Auth::guard('customer')->user()->lastname }} 
                          <hr>
                          Gender : {{ Auth::guard('customer')->user()->gender }} 
                          <hr>
                          Email : {{ Auth::guard('customer')->user()->email }} 
                           <hr>
                          Phone : {{ Auth::guard('customer')->user()->phone }} 
                          <hr>
                          Address : {{ Auth::guard('customer')->user()->address }} 
                          <hr>
                          Password : <a href="#">Change Password</a>

                    </div>
                  </div>
               </div>
            </div>

@endsection
