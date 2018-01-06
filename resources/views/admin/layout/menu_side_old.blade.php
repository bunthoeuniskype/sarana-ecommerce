 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                
                    <li class="active">
                        <a href="{{ url('/') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>                

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Trans"><i class="fa fa-cube" aria-hidden="true"></i> Transation <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Trans" class="collapse">
                         @if(checkPermission(['admin','stock']))
                          <li>
                        <a href="{{url('/purchase')}}"><i class="fa fa-hand-o-right fa-fw"></i>Purchase</a>
                    </li>
                    @endif
                     @if(checkPermission(['admin','sale']))
                     <li>
                        <a href="{{url('/sale')}}"><i class="fa fa-hand-o-right fa-fw"></i>Sale</a>
                    </li>
                    @endif
                     @if(checkPermission(['admin','account']))
                     <li>
                        <a href="{{url('/expenseincome')}}"><i class="fa fa-hand-o-right fa-fw"></i>Expense Income</a>
                    </li>
                     @endif
                        </ul>
                    </li>
                   
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#setup1"><i class="fa fa-database" aria-hidden="true"></i> Set Up <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="setup1" class="collapse">


                    @if(checkPermission(['admin','stock']))
                       <li>
                        <a href="{{url('/changeprice')}}"><i class="fa fa-hand-o-right fa-fw"></i>Product Price</a>
                    </li>
                        <li>
                        <a href="{{url('/category')}}"><i class="fa fa-hand-o-right fa-fw"></i>Category</a>
                    </li>
                    <li>
                        <a href="{{url('/subcategory')}}"><i class="fa fa-hand-o-right fa-fw"></i>Sub Category</a>
                    </li>    
                        <li>
                        <a href="{{url('/measure')}}"><i class="fa fa-hand-o-right fa-fw"></i>Measure</a>
                    </li>
                    <li>
                        <a href="{{url('/currency')}}"><i class="fa fa-hand-o-right fa-fw"></i>Currency</a>
                    </li>
                    @endif
                     @if(checkPermission(['admin','stock','account']))
                    <li>
                        <a href="{{url('/shipper')}}"><i class="fa fa-hand-o-right fa-fw"></i>Shipper</a>
                    </li>
                    <li>
                        <a href="{{url('/supplier')}}"><i class="fa fa-hand-o-right fa-fw"></i>Supplier</a>
                    </li>
                      <li>
                        <a href="{{url('/product')}}"><i class="fa fa-hand-o-right fa-fw"></i>Products</a>
                    </li>
                    @endif

                    @if(checkPermission(['admin','sale','account']))
                    <li>
                        <a href="{{url('/customer')}}"><i class="fa fa-hand-o-right fa-fw"></i>Customer</a>
                    </li>
                    @endif

                     @if(checkPermission(['admin','account']))
                    <li>
                        <a href="{{url('/employee')}}"><i class="fa fa-hand-o-right fa-fw"></i>Employee</a>
                    </li>
                    @endif
                                    
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Report"><i class="fa fa-book fa-fw " aria-hidden="true"></i> Report<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Report" class="collapse">
                        @if(checkPermission(['admin','stock','sale','account']))
                    <li>
                        <a href="{{url('/reportsale')}}"><i class="fa fa-hand-o-right fa-fw"></i> Sale</a>
                    </li>
                     @endif
                    @if(checkPermission(['admin','stock','account']))
                      <li>
                        <a href="{{url('/reportpurchase')}}"><i class="fa fa-hand-o-right fa-fw"></i> Purchase</a>
                    </li>
                    <li>
                        <a href="{{url('/reportinventory')}}"><i class="fa fa-hand-o-right fa-fw"></i> Inventory</a>
                    </li>
                     @endif
                    @if(checkPermission(['admin','account']))
                      <li>
                        <a href="{{url('/reportexpenseincome')}}"><i class="fa fa-hand-o-right fa-fw"></i> Expense Income</a>
                    </li>
                    @endif
                    @if(checkPermission(['admin']))
                      <li>
                        <a href="{{url('/reportlog')}}"><i class="fa fa-hand-o-right fa-fw"></i> User LogIn History</a>
                    </li>
                    @endif
                        </ul>
                    </li>                      
                    
                    @if(checkPermission(['admin']))

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#security"><i class="fa fa-fw fa-gear"></i> Security <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="security" class="collapse">
                             <li>
                        <a href="{{url('/user/create')}}"><i class="fa fa-hand-o-right fa-fw"></i>Add New Users</a>
                    </li>
                     <li>
                        <a href="{{url('/user')}}"><i class="fa fa-hand-o-right fa-fw"></i>View Users</a>
                    </li>

                     <li>
                        <a href="{{url('/role')}}"><i class="fa fa-hand-o-right fa-fw"></i>Role</a>
                    </li>

                        </ul>
                    </li>
                    @endif
                  
                </ul>
            </div>