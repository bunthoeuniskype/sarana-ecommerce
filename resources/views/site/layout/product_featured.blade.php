<div class="well well-small">
      <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
      <div class="row-fluid">
      <div id="featured" class="carousel slide">
      <div class="carousel-inner">
        
         @foreach($products->chunk(4) as $key=>$product)
         <div class="item {{ $key==0?'active':''}}">
          <ul class="thumbnails">
         @foreach($product as $value) 
        <li class="span3">
          <div class="thumbnail">
          <i class="tag"></i>
          <a href="{{url('product/detail/'.$value->slug)}}"><img src="{{$value->image==''?url('public/uploads/images/none.jpg'): url($value->image) }}" style="max-height:120px" alt=""></a>
          <div class="caption">
            <h5>{{ $value->name }}</h5>
            <h4><a class="btn" href="{{url('product/detail/'.$value->slug)}}">VIEW</a> <span class="pull-right">$ {{ $value->price }}</span></h4>
          </div>
          </div>
        </li>
        @endforeach
        </ul>
        </div>
         @endforeach
        
        </div>
        <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#featured" data-slide="next">›</a>
        </div>
        </div>
  </div>
