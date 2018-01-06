<ul id="sideManu" class="nav nav-tabs nav-stacked">
      
   
@foreach($category_side_left as $value)        
         @if(count($value->subcategory) > 0)
         <li class="subMenu"><a> {{$value->name}}</a>
         <ul style="display: none;">         
          @foreach(\App\SubCategory::where(['status'=>1,'category_group_id'=>$value->group_id,'language_code'=>App::getLocale()])->orderBy('order','asc')->get() as $v)
            <li><a href="{{url('subcategory/'.$v->slug)}}"><i class="icon-hand-right"></i>  {{$v->name}}</a></li>
          @endforeach          
         </ul>
        </li>
        @else
        <li><a href="{{url('category/'.$value->slug)}}">{{$value->name}}</a></li>
        @endif
 @endforeach     

 </ul>
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