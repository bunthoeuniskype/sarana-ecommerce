@extends('site.layout.master')
@include('site.layout.slide_header')
@section('content')
  @include('site.layout.product_featured')

<?php use App\Exchange; 
 $exchange = Exchange::whereStatus(1)->orderBy('id','desc')->first()->riel;
 if($exchange){
  $riel = $exchange;
 }else{
  $riel = 4000;
 }
?>

 <h4>Latest Products </h4>
       <ul class="thumbnails">
        @foreach($products as $value)      
        <li class="span3">
          <div class="thumbnail">
          <a  href="{{url('product/detail/'.$value->slug)}}"><img src="{{$value->image==''?url('public/uploads/images/none.jpg'):url($value->image)}}" style="max-height: 120px" alt="{{ $value->name }}"></a>
          <div class="caption">
            <h5>{{ $value->name }}</h5>  <h5 class="price">@if(App::getLocale() == 'en') ${{number_format($value->price,2)}} @else {{ number_format($riel * $value->price,2) }}៛  @endif<h5>          
          <a class="btn btn-small" href="{{url('product/detail/'.$value->slug)}}"> <i class="icon-zoom-in"></i></a> <a class="btn btn-small btn-primary" href="{{ route('shopping.addtocart',['id'=>$value->id]) }}">Add to <i class="icon-shopping-cart"></i></a>
          </div>
          </div>
         </li>
        @endforeach
        </ul> 
        @if($paginate)
        <div align="center">{!!$products->links()!!}</div>
        @endif

        

@endsection