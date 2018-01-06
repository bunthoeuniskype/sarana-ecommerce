@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create New Role
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Roles
                            </li>
                        </ol>
                        
                        <nav class="navbar navbar-inverse">
                        <ul class="nav navbar-nav">
                           <li><a href="{{url('role')}}">View All Roles</a></li>
                            <li><a href="{{url('role/create')}}">Create Role</a></li>
                        </ul>
                        </nav>

                        @if(Session::has('role_create'))
                        <div class="alert alert-success">
                        <em>{!! Session('role_create') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
                        @endif
                        <div class="panel-body">
                        
                        <!-- show error input-->
                        @include('admin/common/errors')

                        {!! Form::open(array('url'=>'role')) !!}

                         <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('name','Title English: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('name',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>                         

                           
                         <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('description','Description : ') !!}
                        </div>                                             
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('description',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>

                                             
                          
                        <div class="from-group col-sm-9 col-sm-offset-9">
                           {!! Form::submit('Create role',array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                         </div>
                </div>
                <!-- /.row -->
@endsection