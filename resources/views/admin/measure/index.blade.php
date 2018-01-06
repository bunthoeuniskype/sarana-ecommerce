@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Measure
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
                        @if(count($measure)>0)
                        <div class="panel panel-defualt">
                        <div class="panel panel-heading">All Measure</div>
                            <div class="panel panel-body">
                            <table class="table table-striped task-table">
                            <tr>
                            <th>No</th>
                            <th>Measure</th>                            
                            <th>Modify</th>
                            <th>Action</th>
                            </tr>
                            <?php $i=1; ?>
                                @foreach ($measure as $measures)
                                <tr>
                                 <td><?= $i++ ?></td>
                                    <td>{!! $measures->label !!}</td>

                                    <td><a href="{!! url('measure/'.$measures->id.'/edit') !!}"><button class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
                                    <td>
                 {!! Form::open(array('url' =>'measure/'.$measures->id ,'method'=>'DELETE')) !!}
                  {!! csrf_field() !!}  
                  {!! method_field('DELETE') !!}  
                                    <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                     {!! Form::close() !!}                               

                                    </td>
                                </tr>
                                @endforeach
                                </table>
                                {!! $measure->render() !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.row -->
@endsection