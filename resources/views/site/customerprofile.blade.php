@extends('site.layout.master')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">                
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
            </div>

@endsection
