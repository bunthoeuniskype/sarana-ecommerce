@extends('admin.layout.master')

@section('content')

<div class="row">
  <div class="col-xs-12" style="padding-left: 15px; padding-right:15px;"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/pay-deposite/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.pay_deposite') }} </h3>
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


    <table class="table table-striped table-bordered nowrap table-over" id="customer-table">      
     

        <thead>
               <tr>
             <th width="5%">#</th> 
             <th width="5%">{{ trans('common.date') }}</th> 
             <th width="5%">{{ trans('common.fullname') }}</th>     
            <th width="5%">{{ trans('common.gender') }}</th>
             <th width="10%">{{ trans('common.email') }}</th>
             <th width="5%">{{ trans('common.phone') }}</th>       
            <th width="10%">{{ trans('common.payowed') }}</th> 
             <th width="10%">{{ trans('common.paid') }}</th> 
            <th width="10%">{{ trans('common.balance') }}</th>  
             <th width="10%">{{ trans('common.status') }}</th>         
            <th width="5%">{{ trans('common.action') }}</th>             
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($payowed as $value)
          <tr>
            <td>{{ $i++ }}</td>      
              <td>{{ date("d-M-Y", strtotime($value->created_at)) }}</td>               
            <td>{{ $value->customer->firstname.' '.$value->customer->lastname }}</td>             
             <td>{{ $value->customer->gender }}</td>
              <td>{{ $value->customer->email }}</td>
             <td>{{ $value->customer->phone }}</td>
             <td>{{ $value->total_amount }}</td>
             <td>{{ $value->total_paid }}</td>
             <td>{{ $value->total_amount -  $value->total_paid }}</td>
             <td>{{ $value->status==1?'Active':'Close' }}</td>
            <td>          
            <a href="{{ url('admin/pay-deposite/'.$value->id.'/payment') }}" class="btn btn-xs btn-primary"><i class="fa fa-dollar"></i> {{ trans('common.payment') }}</a>
             <a href="{{ url('admin/pay-deposite/'.$value->id.'/view') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-search"></i> {{ trans('common.view') }}</a>
            </td>
              
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#customer-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


