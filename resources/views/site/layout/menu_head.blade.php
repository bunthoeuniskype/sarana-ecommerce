
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="{{url('')}}"><img src="{{url('')}}/public/uploads/images/logo.png" style="    height: 62px;
}" alt="Bootsshop"/></a>
    <form class="form-inline navbar-search" method="get" action="{{url('search')}}" >
    <input id="srchFld"  name="search" class="srchTxt" type="text" />
      <select class="srchTxt" name="byCategory">
      <option value="all">All</option>
       @foreach($category as $value)    
         <option value="{{$value->group_id}}">{{$value->name}}</option>
        @endforeach   
    </select> 
      <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    </form>
    <ul id="topMenu" class="nav pull-right">  
   <li class=""><a href="{{url('delivery')}}">Delivery</a></li>
   <li class=""><a href="{{url('contact')}}">Contact Us</a></li>
    </ul>
  </div>
</div>




