<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MIS Computer</title>

    <!-- Bootstrap Core CSS -->
    {{ Html::style('public/assets/css/bootstrap.min.css') }}
   
    
     {{ Html::style('public/assets/css/sb-admin.css') }}
    {{ Html::style('public/assets/css/fileinput.min.css') }}
     {{ Html::style('public/assets/css/jquery-ui.min.css') }}
     {{ Html::style('public/assets/css/datepicker.css') }}
    {{ Html::style('public/assets/css/font-awesome.min.css') }}

    
    {{ Html::script('public/assets/js/jquery.js') }}
    {{ Html::script('public/assets/js/jquery-ui.min.js') }}
    {{ Html::script('public/assets/js/fileinput.min.js') }}    
    {{ Html::script('public/assets/js/bootstrap.min.js') }}
    {{ Html::script('public/assets/js/bootstrap-datepicker.js') }}
    {{ Html::script('public/assets/js/bootbox.min.js') }}

<script type="text/javascript">

 var baseurl = window.location.origin;


</script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{url('uploads/images/logo.jpg')}}" height="30px"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav"> 


                <li>
                    <a href="{{ url('/mail') }}" ><i class="fa fa-envelope"></i> </a>     
                </li>

               @include('admin.main.productAlert')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img width="30px" src="{{ url(Auth::user()->employee->image) }}"> {{ Auth::user()->name }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                         @if(checkPermission(['admin']))
                        <li>
                            <a href="{{url('/user')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        @endif

                        <li class="divider"></li>
                      <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>



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
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <script>

$(document).ready(function(){

$('#image').fileinput({
        maxFileSize: 2000,
        allowedFileExtensions : ['jpeg', 'jpg', 'png', 'gif', 'bmp'],
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });

    });


</script>


 <script>
    var route_prefix = "{{ url('/') }}";
    var lfm_route = "{{ url(config('lfm.prefix')) }}";
    var lang = {!! json_encode(trans('laravel-filemanager::lfm')) !!};
  </script>

 
  <script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: lfm_route});
  </script>
</body>

</html>
