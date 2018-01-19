@extends('site.layout.master')

@section('content')


        
        @if(Session::has('success'))
                        <div class="alert alert-success">
                        <em>{!! Session('success') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
        @endif

      @if(Session::has('error'))
                        <div class="alert alert-warning">
                        <em>{!! Session('error') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
       @endif



            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align: center;">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>

@if(Session::has('cart'))

@foreach($products as $product)

                 <tr>
                        <td>
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> 
                                <img class="media-object" src="{{ asset($product['item']['image']) }}" style="height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $product['item']['name'] }} </a></h4>
                                    <h5 class="media-heading"><strong> Description : </strong>
                                    <?= substr(strip_tags($product['item']['description']),0,100) ?> ...
                                    </h5>
                                    <span>Avaliable In Stock : </span><span class="text-success"><strong> {{ $product['item']['qty'] }}</strong></span>
                                </div>
                            </div></td>
                            <td style="text-align: center">
                           <div class="input-group">                             
                                <span class="input-group-addon">
                                <a href="{{ route('shopping.reducebyone', $product['item']['id']) }}"><i class=" fa fa-minus"></i></a></span>  
                                  <input style="width:40%"  type="number" readonly="true" class="form-control"  value="{{ $product['qty'] }}">   
                                   <span class="input-group-addon">
                                <a href="{{ route('shopping.addbyone', $product['item']['id']) }}"><i class=" fa fa-plus"></i></a></span>
                               
                           </div>
                            </td>
                            <td style="white-space: nowrap;"><strong>$ {{ $product['item']['price'] }}</strong></td>
                            <td class="text-center" style="white-space: nowrap;"><strong>$ {{ $product['price'] }}</strong></td>
                            <td>
                            <a href="{{ route('shopping.remove', $product['item']['id']) }}">
                            <button type="button" class="btn btn-danger">
                                <span class="fa fa-remove"></span> remove
                            </button>
                            </a>
                        </td>
                     </tr>

@endforeach
                    <tr>
                          <td colspan="3">   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$ {{ $totalPrice }}</strong></h5></td>
                    </tr>
                    
                    <tr>
                        <td colspan="3">   </td>
                       
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$ {{ $totalPrice }}</strong></h3></td>
                    </tr>
                    <tr>
                          <td colspan="3">  </td>
                        <td>
                        <a href="{{ url('/cancelCart') }}">
                        <button type="button" class="btn btn-default" >
                            <span class="glyphicon glyphicon-trash"></span> Cancel
                        </button></td>
                        <td>
                        <a href="{{ route('shopping.checkout') }}">
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr>




@else

                    <tr>
                        <td class="col-md-6" colspan="4">
                        No Item in Cart
                     </td>
                    </tr>

@endif 


                </tbody>
            </table>




@endsection
