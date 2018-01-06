@extends('admin.layout.master')

@section('content')

<div class="row">
  <div class="col-xs-8 col-xs-offset-2"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/expense_income/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.expense_income') }} </h3>
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


    <table class="table table-striped table-bordered nowrap table-over" id="expense_income-table">
        <thead>
               <tr>
             <th width="5%">#</th>   
              <th width="30%">{{ trans('common.date') }}</th>         
            <th width="30%">{{ trans('common.total_income') }}</th> 
            <th width="30%%">{{ trans('common.total_expense') }}</th>
            <th width="30%%">{{ trans('common.profit') }}</th>
             <th width="15%">{{ trans('common.action') }}</th>
           
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($exp_inc as $value)
          <tr>
            <td>{{ $i++ }}</td> 
             <td>{{ date('j-M-Y',strtotime($value->date)) }}</td>          
              <td>$ {{ $value->total_income }}</td>
               <td>$ {{ $value->total_expense }}</td>
               <td>$ {{ $value->total_income - $value->total_expense }}</td>
               <td><a href="{{ url('admin/expense_income/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>

               <a href="{{ url('admin/expense_income/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> {{ trans('common.delete') }}</a>
               </td>
                
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#expense_income-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


