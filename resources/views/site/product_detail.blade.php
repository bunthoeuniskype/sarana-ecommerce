@extends('site.layout.master')

@section('script')
<script type="text/javascript">
	$('#listView').on('click',function(){
		$('#listView').addClass('btn-primary');	
		$('#blockView').removeClass('btn-primary');	
	});

	$('#blockView').on('click',function(){
		$('#blockView').addClass('btn-primary');	
		$('#listView').removeClass('btn-primary');		
	});
</script>
@endsection

@section('content')

<?php
use App\Http\Classes\MakeDateClass;
use App\Exchange; 
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
    <li><a href="{{url('')}}">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>	
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="{{url($product->image)}}" title="{{$product->name}}">
				<img src="{{url($product->image)}}" style="width:100%" alt="{{$product->name}}"/>
            </a>
			<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                  <div class="item active">
                   <a href="{{url($product->image)}}"> <img style="width:29%" src="{{url($product->image)}}" alt=""/></a>
                  @foreach($product->gallery()->get() as $key=>$g)
                   	@if($key < 2)
                    <a href="{{url($g->image)}}"> <img style="width:29%" src="{{url($g->image)}}" alt=""/></a>
                    @else
                    </div>
                   <div class="item">
                    <a href="{{url($g->image)}}"> <img style="width:29%" src="{{url($g->image)}}" alt=""/></a>
                    @endif
                  @endforeach
                  </div>
                 
                  
                </div>
              <!--  
			  <a class="left carousel-control" href="{{url('public/assets')}}/#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="{{url('public/assets')}}/#myCarousel" data-slide="next">›</a> 
			  -->
              </div>
			  
			<!--  <div class="btn-toolbar">
			  <div class="btn-group">
				<span class="btn"><i class="icon-envelope"></i></span>
				<span class="btn" ><i class="icon-print"></i></span>
				<span class="btn" ><i class="icon-zoom-in"></i></span>
				<span class="btn" ><i class="icon-star"></i></span>
				<span class="btn" ><i class=" icon-thumbs-up"></i></span>
				<span class="btn" ><i class="icon-thumbs-down"></i></span>
			  </div>
			</div> -->
			</div>
			<div class="span6">
				<span><h3>{{$product->name}}</h3> <span>Created Date : {{MakeDateClass::time_elapsed_string($product->created_at)}} {{$product->created_at}}</span></span>
				<!-- <small>- (14MP, 18x Optical Zoom) 3-inch LCD</small> -->
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm">
				  <div class="control-group">
					<h4 class="control-label">Price : </h4><h4 class="price"><span>@if(App::getLocale() == 'en') ${{number_format($product->price,2)}} @else {{ number_format($riel * $product->price,2) }}៛  @endif</span></h4>
					<div class="controls">
					<!-- <input type="number" class="span1" value="1" placeholder="Qty."/> -->
					  <a href="{{ route('shopping.addtocart',['id'=>$product->id]) }}" class="btn btn-xs btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></a>
					</div>
				  </div>
				</form>
				
				<hr class="soft"/>
				<h4>{{$product->qty}} items in stock</h4>
				<form class="form-horizontal qtyFrm pull-right">
				  <div class="control-group">
					<label class="control-label"><span>Color</span></label>
					<div class="controls">
					  <select class="span2">
						  <option>{{$product->color}}</option>						 
						</select>
					</div>
				  </div>
				</form>
				<hr class="soft clr"/>
				<p>
				{{$product->detail}}
				
				</p>
				<!-- <a class="btn btn-small pull-right" href="{{url('public/assets')}}/#detail">More Details</a> -->		
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
              <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			 	
			 	{!!$product->description!!}

              </div>
		<div class="tab-pane fade" id="profile">
		<div id="myTab" class="pull-right">
		 <a href="#listView" data-toggle="tab"><span class="btn btn-small"><i class="icon-list"></i></span></a>
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-small btn-primary"><i class="icon-th-large"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<div class="tab-pane" id="listView">
				  @foreach($product_related as $value)   

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
					<h5 class="price">@if(App::getLocale() == 'en') ${{number_format($product->price,2)}} @else {{ number_format($riel * $product->price,2) }}៛  @endif</h5>
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
				   @foreach($product_related as $value)      
			        <li class="span3">
			          <div class="thumbnail">
			          <a  href="{{url('product/detail/'.$value->slug)}}"><img src="{{$value->image==''?url('public/uploads/images/none.jpg'):url($value->image)}}" style="max-height: 120px" alt="{{ $value->name }}"></a>
			          <div class="caption">
			            <h5>{{ $value->name }}</h5>  <h5 class="price">@if(App::getLocale() == 'en') ${{number_format($product->price,2)}} @else {{ number_format($riel * $product->price,2) }}៛  @endif<h5>          
			             <a class="btn btn-small" href="{{url('product/detail/'.$value->slug)}}"> <i class="icon-zoom-in"></i></a> <a class="btn btn-small btn-primary" href="{{ route('shopping.addtocart',['id'=>$value->id]) }}">Add to <i class="icon-shopping-cart"></i></a>
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
     </div>
  </div>
</div>

@endsection