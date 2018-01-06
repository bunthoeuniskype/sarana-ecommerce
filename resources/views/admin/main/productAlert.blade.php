 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>@if($alert>0)<span class="badge">{{$alert}}</span> <b class="caret"></b>@endif</a>
                    <ul class="dropdown-menu alert-dropdown">                    
                       @foreach($productAlert as $product)
                        <li>
                            <a href="{!! url('product/'.$product->id.'/alert') !!}">{{ $product->name }} <span class="label label-warning">remain {{ $product->qty }}</span></a>
                        </li>
                        @endforeach
                      
                    </ul>
 </li>