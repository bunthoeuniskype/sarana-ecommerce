@extends('layouts.layout')

@section('script')

<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>

@endsection
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.dataTables.css') }}"/>
@endsection

@section('content')


<div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                        
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.message') }} </h3>
                         </div>
                            <div class="panel panel-body">


    <table class="table table-striped table-bordered nowrap table-over" id="feedback-table">
        <thead>
               <tr>
             <th width="2%">#</th>            
            <th>{{ trans('common.name') }}</th> 
            <th>{{ trans('common.email') }}</th>
            <th>{{ trans('common.message') }}</th>            
            <th width="5%">{{ trans('common.status') }}</th>        
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($feedback as $value)
          <tr>
            <td>{{ $i++ }}</td>           
              <td>{{ $value->name }}</td>            
              <td>{{$value->email}}</td>
              <td><a href="{{url('admin/feedback/'.$value->id.'/view')}}"> {{ substr($value->message,0,140)}} {{ strlen($value->message) > 140 ? '...' : '' }}</a></td>
              <td>{!! $value->status==1?'<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>':'<i class="fa fa-remove text-warning"></i>' !!}</td>
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#feedback-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>

    @stop

@push('scripts')
  
@endpush
