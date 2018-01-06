@extends('mastershopping')

@section('content')
<div class="container">
    <div class="row">

    
        <div class="col-xs-12">
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
        </div>
    </div>
</div>
@endsection
