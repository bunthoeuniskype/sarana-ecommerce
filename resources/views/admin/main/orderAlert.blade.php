  <li class="dropdown pull-right" role="menu" style="list-style: none;margin-top:5px;margin-right: 13px;">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i>&nbsp; @if($alert>0) <span class="badge badge-warning" style="background-color: blue;"> {{$alert}}</span> <b class="caret"></b>@endif</a>
            <ul class="dropdown-menu alert-dropdown">                    
                    @foreach($orderAlert as $ord)
	                     <li>
	                       <a href="{{url('admin/orders/check/'.$ord->id)}}">{{ $ord->customer->username }} <span class="label text-primary">Total Qty : {{ $ord->total_qty }} => Total Amount : $ {{ $ord->total_amount }}</span></a>
	                     </li>
                    @endforeach                      
           </ul>
 </li>