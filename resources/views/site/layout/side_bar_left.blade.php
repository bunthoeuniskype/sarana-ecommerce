<div class="gw-sidebar">
  <div id="gw-sidebar" class="gw-sidebar">
    <div class="nano-content">
      <ul class="gw-nav gw-nav-list">

      @foreach($category_side_left as $value)        
          @if(count($value->subcategory) > 0)
        <li class="init-arrow-down"> <a href="javascript:void(0)"> <span class="gw-menu-text">{{$value->name}}</span> <i  class="fa fa-angle-down text-right" style="float:right;padding-top:10px;"></i></a>
          <ul class="gw-submenu"> 
            @foreach(\App\SubCategory::where(['status'=>1,'category_group_id'=>$value->group_id,'language_code'=>App::getLocale()])->orderBy('order','asc')->get() as $v)
            <li><i  class="fa fa-hand-o-right text-left" style="float:left;padding-top:9px; padding-left: 19px;"></i> <a href="{{url('subcategory/'.$v->slug)}}"> {{$v->name}}</a></li>
            @endforeach       
          </ul>
        </li>
       @else
        <li class="init-un-active"><a href="{{url('category/'.$value->slug)}}"> <span class="gw-menu-text">{{$value->name}}</span> </a> </li>
        @endif
      @endforeach        
      </ul>
    </div>
  </div>
</div>

<br/>
   @foreach($ads_left as $value)
      <div class="thumbnail">
      <img src="{{url($value->image)}}"/>  
      </div>
      <br/> 
   @endforeach       
      <div class="thumbnail">
        <img src="{{url('')}}/public/assets/themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
        <div class="caption">
          <h5>Payment Methods</h5>
    </div>
</div>