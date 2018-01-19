 <li class="dropdown pull-right" role="menu" style="list-style: none; margin-top:5px; margin-lef:5px;margin-right: 13px;">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>&nbsp; @if($alert>0) <span class="badge badge-warning" style="background-color: #d44848;"> {{$alert}}</span> <b class="caret"></b>@endif</a>
            <ul class="dropdown-menu alert-dropdown">                    
                    @foreach($productAlert as $product)
	                     <li>
	                       <a href="#">{{ $product->name }} <span class="label label-warning">remain {{ $product->qty }}</span></a>
	                     </li>
                    @endforeach                      
           </ul>
 </li>