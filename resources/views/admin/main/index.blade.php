@extends('admin.main.main')

@section('content')

 {{ Html::style('public/assets/css/plugins/morris.css') }}

                 <!-- Page Heading -->
                <div class="row">
                {{ checkPermission(['sale']) }}

                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                
               

                <div class="row">
             
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{DB::table('purchase')->count('id')}}</div>
                                        <div>All Purchase!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('/reportpurchase')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{DB::table('sale')->count('id')}}</div>
                                        <div>All Sales !</div>
                                    </div>
                                </div>
                            </div>
                             <a href="{{ url('/reportsale')}}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                                
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Sale Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sale #</th>
                                                <th>Sale Date</th>
                                               <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($salesReport as $saleReport)
                                            <tr>
                                                <td>SALE{{ $saleReport->id }}</td>
                                                <td>{{ $saleReport->created_at }}</td>
                                                <td>{{ $saleReport->total }}</td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('/reportsale')}}">View All Sale <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Purchase Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                         <thead>
                                            <tr>
                                                <th>Purchase #</th>
                                                <th>Purchase Date</th>
                                               <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchasesReport as $purchaseReport)
                                            <tr>
                                                <td>RECV{{ $purchaseReport->id }}</td>
                                                <td>{{ $purchaseReport->created_at }}</td>
                                                <td>{{ $purchaseReport->total }}</td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="{{url('/reportpurchase')}}">View All Purchase <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

{{ Html::script('public/assets/js/plugins/morris/raphael.min.js') }} 
{{ Html::script('public/assets/js/plugins/morris/morris.min.js') }} 
{{ Html::script('public/assets/js/plugins/morris/morris-data.js') }} 

@endsection