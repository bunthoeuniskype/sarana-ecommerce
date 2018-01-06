@extends('admin.layout.master_side')

@section('content')

<div class="row">
  <div class="col-xs-12" style="padding-left: 15px; padding-right:15px;"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/user/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.user') }} </h3>
                         </div>
                            <div class="panel panel-body">

 @if(Session::has('save'))
                        <div class="alert alert-success">
                        <em>{!! Session('save') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
  @endif

    <table class="table table-striped table-bordered nowrap table-over" id="user-table">      <thead>
               <tr>
             <th width="2%">#</th> 
             <th width="5%">{{ trans('common.image') }}</th>            
            <th width="10%">{{ trans('common.firstname') }}</th> 
            <th width="10%">{{ trans('common.lastname') }}</th>
             <th width="10%">{{ trans('common.username') }}</th>
             <th width="15%">{{ trans('common.email') }}</th>
             <th width="5%">{{ trans('common.role') }}</th>          
             <th width="5%">{{ trans('common.action') }}</th>             
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($user as $value)
          <tr>
            <td>{{ $i++ }}</td>    
            <td>
            @if($value->employee_id=='' || $value->employee_id==0 )
            <img style="height: 30px" src="{{ asset('public/uploads/images/none.jpg') }}">
             @else
             @if($value->employee->image=='')
             <img style="height: 30px" src="{{ asset('public/uploads/images/none.jpg') }}">
             @else
             <img style="height: 30px" src="{{ asset('public/'.$value->employee->image) }}">
             @endif

             @endif
             </td>       
             <td>{{ $value->employee_id=='' || $value->employee_id==0?'':$value->employee->firstname }}</td>
              <td>{{ $value->employee_id=='' || $value->employee_id==0?'':$value->employee->lastname }}</td>
             <td>{{ $value->name }}</td>
              <td>{{ $value->email }}</td>            
             <td>{{ $value->role }}</td>         
            <td>
            <a href="{{ url('admin/user/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash-o"></i> {{ trans('common.delete') }}</a>
            <a href="{{ url('admin/user/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>
            </td>
              
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#user-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


