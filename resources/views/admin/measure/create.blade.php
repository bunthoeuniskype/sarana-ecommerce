@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create New Measure
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Measure
                            </li>
                        </ol>
                        <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                           <li><a href="{{url('measure')}}">View All Measure</a></li>
                            <li><a href="{{url('measure/create')}}">Create Measure</a></li>
                        </ul>
                        </nav>

                        @if(Session::has('measure_create'))
                        <div class="alert alert-success">
                        <em>{!! Session('measure_create') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
                        @endif
                        <div class="panel-body">
                        <!-- show error input-->
                         @include('admin/common/errors')

                        {!! Form::open(array('url'=>'measure')) !!}
                         {{ csrf_field() }}
                         <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('label','Measure : ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('label',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>    
                       
                        <div class="from-group col-sm-9 col-sm-offset-9">
                           {!! Form::submit('Create measure',array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                         </div>
                </div>
                <!-- /.row -->
@endsection