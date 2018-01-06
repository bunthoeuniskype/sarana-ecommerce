@section('slide')


<div id="carouselBlk">
  <div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
    @foreach($slide as $key => $value)
      <div class="item {{$key==0?'active':''}}">
      <div class="container">
      <a href="#"><img style="width:100%" src="{{url($value->image)}}" alt="special offers"/></a>
      <div class="carousel-caption">
          <h4>{{$value->title}}</h4>
          <p>{{$value->description}}</p>
        </div>
      </div>
      </div>
    @endforeach   
    </div>
    <a class="left carousel-control" href="{{url('')}}/public/assets/#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="{{url('')}}/public/assets/#myCarousel" data-slide="next">&rsaquo;</a>
    </div> 
</div>

@endsection

