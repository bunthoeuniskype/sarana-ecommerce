@extends('admin.layout.master')

@section('script')

<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>

@endsection
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.dataTables.css') }}"/>
@endsection

@section('content')

<div class="col-12">  
   <div class="col-xs-6">

<div class="panel panel-defualt" style="margin-top:-20px;">
     <div class="panel panel-heading clearfix" style="padding-top: 5px;">
      <h3 style="margin-top: 5px;"> {{ trans('common.gallery') }} </h3>
            </div>
     <div class="panel panel-body">

 <table class="table table-striped table-bordered nowrap table-over" id="gallery-table">
        <thead>
           <tr>
            <th width="5%">#</th>  
            <th>{{ trans('common.image') }}</th>
            <th width="10%">{{ trans('common.action') }}</th>
             <th width="5%">{{ trans('common.status') }}</th>        
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($gallery as $value)
          <tr>
            <td>{{ $i++ }}</td>                   
              <td><img src="{{ url($value->image) }}" style="height: 70px;"></td>              
               <td><a href="{{ url('admin/gallery/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>

               <a href="{{ url('admin/gallery/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> {{ trans('common.delete') }}</a>
               </td>
                <td>{!! $value->status==1?'<i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>':'<i class="fa fa-remove text-warning"></i>' !!}</td>
          </tr>
          @endforeach
        </body>
    </table>

<script>
$(function() {
    $('#gallery-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>

        </div>        
      </div>  

   </div>

      <div class="col-xs-6">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/post') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.gallery') }} </h3>
                         </div>
                            <div class="panel panel-body">

<!--show error -->
@include('errors/errors')

 @if(Session::has('save'))
                        <div class="alert alert-success">
                        <em>{!! Session('save') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
  @endif

 {!! Form::model($g, array('url' => 'admin/gallery/'.$g->id,'method'=>'PUT')) !!}
 
 {{ csrf_field() }}

 <table style="border: 1px solid #9f9f9f;" cellspacing="10" class="table">

 <tr>
    <td>
          <label for="post">{{ trans('common.product') }} </label>
        </td>
        <td>
  {!! Form::select('product_id',$product,null,array("class"=>"form-control", "required"=>"true" )) !!}
  </td>
  </tr>

<tr>
    <td>
            {!! Form::label('image','image: ') !!}
        </td>
        <td>

        <div class="input-group from-group col-xs-12"> 
          <div class="input-group">
          <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          {{ Form::text('image',null,['class'=>'form-control','id'=>'thumbnail','readonly'=>true, "required"=>"true"]) }}
        </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>

  </td>
  </tr>

  <tr>
    <td>
          <label for="status">{{ trans('common.status') }}</label>
        </td>
        <td>
   <div class="input-group">
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-success btn-sm {{ $g->status==1? 'active' : 'notActive' }}" data-toggle="status" data-title="1">Enable</a>
              <a class="btn btn-success btn-sm {{ $g->status==0? 'active' : 'notActive' }}" data-toggle="status" data-title="0">Disable</a>
            </div>
            <input type="hidden" name="status" value="{{ $g->status }}" id="status">
    </div>

  </td>
  </tr>
 
  <tr>
     <td style="border-top:0px;"> </td>
    <td class="pull-right" style="border-top:0px;">
    <button type="reset" class="btn btn-default"> <i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('common.reset') }}</button>      
          <button type="submit" class="btn btn-primary" id="btnsave"><i class="fa fa-save fa-fw" aria-hidden="true"></i> {{ trans('common.save') }}</button>
        </td>
      </tr>
    </table>
 
 {!! Form::close() !!} 
      </div>
    </div>
</div>

   </div>




<script>
 var route_prefix = "{{ url(config('lfm.prefix')) }}";
 </script>

 <script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});   
  </script>

@endsection
