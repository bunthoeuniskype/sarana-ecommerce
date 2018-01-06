@extends('admin.layout.master')

@section('content')

      <div class="col-xs-6 col-xs-offset-3">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/advertisement') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.advertisement') }} </h3>
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


 {!! Form::open(array('url'=>'admin/advertisement','id'=>'advertisement')) !!}
 
 {{ csrf_field() }}

 <table style="border: 1px solid #9f9f9f;" cellspacing="10" class="table">
   <tr>
    <td>
          <label for="name">{{ trans('common.title') }}</label>
        </td>
        <td>
  {!! Form::text('title',null,array("class"=>"form-control","id"=>"title", "required"=>"true" )) !!}
  </td>
  </tr>

  <tr>
    <td>
          <label for="ads_type">{{ trans('common.ads_type') }}</label>
        </td>
        <td>
  {!! Form::select('ads_type',[''=>'Select Type','Banner'=>'Banner','Slide'=>'Slide','Video'=>'Video'],null,array("class"=>"form-control","id"=>"ads_type", "required"=>"true" )) !!}
  </td>
  </tr>

    <tr>
    <td>
          <label for="location">{{ trans('common.location') }}</label>
        </td>
        <td>
  {!! Form::select('location',[''=>'Select Location','Header'=>'Header','Body'=>'Body','Side_Left'=>'Side Left','Side_Right'=>'Side Right'],null,array("class"=>"form-control","id"=>"location", "required"=>"true" )) !!}
  </td>
  </tr>

<tr>
    <td>
          <label for="video_id">{{ trans('common.video_id') }}</label>
        </td>
        <td>
  {!! Form::text('video_id',null,array("class"=>"form-control","id"=>"video_id")) !!}
  </td>
</tr>

 <tr>
    <td>
    <label for="link">{{ trans('common.image') }} </label>
        </td>
     <td>
 <div class="input-group">
          <span class="input-group-btn">
            <a data-input="thumbnail" id="lfm" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          <input id="thumbnail" class="form-control" type="text" name="image">
 </div>
 <img id="holder" src="{{url('public/uploads/images/none.jpg')}}" style="border:1px solid;margin-top:15px;max-height:75px;">
  </td>
  </tr>

  <tr>
    <td>
          <label for="name">{{ trans('common.description') }}</label>
        </td>
        <td>
  {!! Form::text('description',null,array("class"=>"form-control","id"=>"description")) !!}
  </td>
  </tr>

<tr>
    <td>
          <label for="order">{{ trans('common.order') }}</label>
        </td>
        <td>
  {!! Form::text('order',$order+1,array("class"=>"form-control","id"=>"order", "required"=>"true" )) !!}
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


<!-- laravel-filemanager -->
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
