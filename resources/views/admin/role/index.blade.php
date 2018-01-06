@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Roles
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
                        @if(count($roles)>0)
                        <div class="panel panel-defualt">
                        <div class="panel panel-heading">All Role</div>
                            <div class="panel panel-body">

                            
                            <table class="table table-striped task-table">
                            <tr>

       
                            <th>Title</th>
                            <th>Description</th>
                          
                            <th>Modify</th>
                            <th>Action</th>
                            </tr>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{!! $role->name !!}</td>
                                    <td>{!! $role->description !!}</td>
                                     
                                    <td><a href="{!! url('role/'.$role->id.'/edit') !!}"><button class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
                                    <td>
                 {!! Form::open(array('url' =>'role/'.$role->id ,'method'=>'DELETE')) !!}
                  {!! csrf_field() !!}  
                  {!! method_field('DELETE') !!}  
                                    <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     {!! Form::close() !!}                               

                                    </td>
                                </tr>
                                @endforeach
                                </table>
                                {!! $roles->render() !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.row -->
@endsection