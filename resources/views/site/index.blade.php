@extends('site.layout.master')
@include('site.layout.slide_header')
@section('content')
  @include('site.layout.product_featured')
 <h4>Latest Products </h4>
       <ul class="thumbnails">
        @foreach($products as $value)      
        <li class="span3">
          <div class="thumbnail">
          <a  href="{{url('product/detail/'.$value->slug)}}"><img src="{{$value->image==''?url('public/uploads/images/none.jpg'):url($value->image)}}" style="max-height: 120px" alt="{{ $value->name }}"></a>
          <div class="caption">
            <h5>{{ $value->name }}</h5>           
             <h4 style="text-align:center"><a class="btn" href="{{url('product/detail/'.$value->slug)}}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ route('shopping.addtocart',['id'=>$value->id]) }}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$ {{ $value->price }}</a></h4>
          </div>
          </div>
         </li>
        @endforeach
        </ul> 
        @if($paginate)
        <div align="center">{!!$products->links()!!}</div>
        @endif

        

@endsection