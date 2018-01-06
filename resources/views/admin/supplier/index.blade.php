@extends('admin.layout.master')

@section('content')

<div class="row">
  <div class="col-xs-12" style="padding-left: 15px; padding-right:15px;"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/supplier/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.supplier') }} </h3>
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


    <table class="table table-striped table-bordered nowrap table-over" id="supplier-table">      
     

        <thead>
               <tr>
             <th width="5%">#</th>    
              <th width="5%">{{ trans('common.image') }}</th>                      
            <th width="10%">{{ trans('common.firstname') }}</th> 
            <th width="10%">{{ trans('common.lastname') }}</th>
             <th width="10%">{{ trans('common.company_name') }}</th> 
             <th width="5%">{{ trans('common.gender') }}</th>
             <th width="10%">{{ trans('common.email') }}</th>
             <th width="5%">{{ trans('common.phone') }}</th>
             <th width="15%">{{ trans('common.address') }}</th>
             <th width="5%">{{ trans('common.action') }}</th>             
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($supplier as $value)
          <tr>
            <td>{{ $i++ }}</td>   
            <td>@if($value->image == '')
             <img style="height: 30px" src="{{ asset('public/uploads/images/none.jpg') }}">
             @else
             <img style="height: 30px" src="{{ asset('public/'.$value->image) }}">
             @endif
             </td>                 
             <td>{{ $value->firstname }}</td>
              <td>{{ $value->lastname }}</td>
               <td>{{ $value->company_name }}</td> 
             <td>{{ $value->gender }}</td>
              <td>{{ $value->email }}</td>
             <td>{{ $value->phone }}</td>
             <td>{{ $value->address }}</td>
            <td>
            <a href="{{ url('admin/supplier/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash-o"></i> {{ trans('common.delete') }}</a>
            <a href="{{ url('admin/supplier/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>
            </td>
              
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#supplier-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


