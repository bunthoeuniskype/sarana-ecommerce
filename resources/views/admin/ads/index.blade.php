@extends('admin.layout.master_side')

@section('script')

<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>

@endsection
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.dataTables.css') }}"/>
@endsection

@section('content')


<div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/advertisement/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.advertisement') }} </h3>
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
          <th width="10%">{{ trans('common.image') }}</th> 
          <th width="10%">{{ trans('common.title') }}</th>
          <th width="10%">{{ trans('common.description') }}</th>
           <th width="10%">{{ trans('common.ads_type') }}</th>
           <th width="10%">{{ trans('common.location') }}</th>
           <th width="5%">{{ trans('common.status') }}</th>        
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($advertisement as $value)
          <tr>
            <td>{{ $i++ }}</td>           
              <td><img src="{{ $value->ads_type=='Banner' || $value->ads_type=='Slide' ? asset($value->image) : asset('http://img.youtube.com/vi/'.$value->video_id.'/mqdefault.jpg')}}" height="50px"> </td>
               <td><a href="{{ url('admin/advertisement/'.$value->id.'/edit') }}">
                 {{ substr($value->title,0,35) }} ...
               </a></td>
             <td>{{ substr($value->description,0,50) }} ...</td>
             <td>{{ $value->ads_type }}</td>
             <td>{{ $value->location }}</td>
            <td>{!! $value->status==1?'<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>':'<i class="fa fa-remove text-warning"></i>' !!}</td>
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
