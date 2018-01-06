@extends('admin.layout.master')

@section('content')

<div class="row">
  <div class="col-xs-8 col-xs-offset-2"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
        <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/exchange/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.exchange_rate') }} </h3>
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

    <table class="table table-striped table-bordered nowrap table-over" id="exchange-table">
        <thead>
            <tr>
            <th width="5%">#</th>            
            <th width="40%">{{ trans('common.dollar') }}</th> 
            <th width="40%%">{{ trans('common.riel') }}</th>
            <th width="40%%">{{ trans('common.date') }}</th>
            <th width="15%">{{ trans('common.action') }}</th>
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($exchange as $value)
          <tr>
              <td>{{ $i++ }}</td>           
              <td>{{ $value->dollar }}</td>
               <td>{{ $value->riel }}</td>
               <td>{{ date("d-M-Y", strtotime($value->date)) }}</td>
               <td><a href="{{ url('admin/exchange/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>
               <a href="{{ url('admin/exchange/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> {{ trans('common.delete') }}</a>
               </td>
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#exchange-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


