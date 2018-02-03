@extends('admin.layout.master')

@section('script')

<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>

@endsection
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.dataTables.css') }}"/>
@endsection

@section('content')


<div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">                        
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.order') }} </h3>
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


    <table class="table table-striped table-bordered nowrap table-over" id="advertisement-table">
        <thead>
 
          <tr>
          <th width="5%">#</th>            
          <th width="10%">{{ trans('common.customer') }}</th> 
          <th width="10%">{{ trans('common.qty') }}</th>
          <th width="10%">{{ trans('common.amount') }}</th>
           <th width="10%">{{ trans('common.payment_id') }}</th>
           <th width="10%">{{ trans('common.date') }}</th>
           <th width="5%">{{ trans('common.status') }}</th>        
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($order as $value)
          <tr>
            <td>{{ $i++ }}</td> 
            <td><a href="{{url('admin/orders/check/'.$value->id)}}"> {{ $value->customer->first_name.' '.$value->customer->last_name.' '.$value->customer->phone }}</a></td>          
            <td>{{ $value->total_qty }}</td>
            <td>{{ $value->total_amount }}</td>         
             <td><a href="{{url('admin/orders/check/'.$value->id)}}">{{ $value->payment_id }}</a></td>
             <td>{{ $value->created_at->diffForHumans() }}</td>
            <td>{!! $value->status !!}</td>
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#advertisement-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>

    @stop

@push('scripts')
  
@endpush
