@extends('site.layout.master')

@section('content')
<?php use App\Exchange; 
 $exchange = Exchange::whereStatus(1)->orderBy('id','desc')->first()->riel;
 if($exchange){
  $riel = $exchange;
 }else{
  $riel = 4000;
 }
?>

<div class="span9">

    <ul class="breadcrumb">
    <li><a href="{{url('')}}">Home</a> <span class="divider">/</span></li>   
    <li class="active">{{$list}}</li>
    </ul>	
	<div class="row">	  

		<div class="tab-pane" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-small"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-small btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane" id="listView">
				  @foreach($products as $value)   

				<div class="row">	  
					<div class="span2">
						<img src="{{$value->image==''?url('public/uploads/images/none.jpg'):url($value->image)}}" style="max-height: 120px" alt="{{ $value->name }}
						"/>
					</div>
					<div class="span4">					
						<h5>{{ $value->name }}</h5>
						<p>
						{{ substr($value->detail,0,150) }} ...
						</p>
						<!-- <a class="btn btn-small pull-right" href="{{url('product/detail/'.$value->slug)}}">View Details</a> -->
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
					<form class="form-horizontal qtyFrm">
				    <h5 class="price">@if(App::getLocale() == 'en') ${{number_format($value->price,2)}} @else {{ number_format($riel * $value->price,2) }}៛  @endif<h5>   
					<div class="btn-group">
					  <a href="{{ route('shopping.addtocart',['id'=>$value->id]) }}" class="btn btn-small btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
					  <a href="{{url('product/detail/'.$value->slug)}}" class="btn btn-small"><i class="icon-zoom-in"></i></a>
					 </div>
						</form>
					</div>
			</div>
			<hr class="soft"/>
			@endforeach
		</div>
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				   @foreach($products as $value)      
			        <li class="span3">
			          <div class="thumbnail">
			          <a  href="{{url('product/detail/'.$value->slug)}}"><img src="{{$value->image==''?url('public/uploads/images/none.jpg'):url($value->image)}}" style="max-height: 120px" alt="{{ $value->name }}"></a>
			          <div class="caption">
			            <h5>{{ $value->name }}</h5>  <h5 class="price">@if(App::getLocale() == 'en') ${{number_format($value->price,2)}} @else {{ number_format($riel * $value->price,2) }}៛  @endif<h5>         
			             <h4 style="text-align:center"><a class="btn btn-small" href="{{url('product/detail/'.$value->slug)}}"> <i class="icon-zoom-in"></i></a> <a class="btn btn-small btn-primary" href="{{ route('shopping.addtocart',['id'=>$value->id]) }}">Add to <i class="icon-shopping-cart"></i></a></h4>
			          </div>
			          </div>
			         </li>
        			@endforeach
        		</ul>	
			<hr class="soft"/>
			</div>
		</div>
			<br class="clr">
		 </div>
	</div>

	    @if($paginate)
        <div align="center">{!!$products->links()!!}</div>
        @endif

</div>

@endsection