@extends('admin.layout.master_side')

@section('content')

      <div class="col-xs-6 col-xs-offset-3">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/subcategory') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.category') }} </h3>
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


 {!! Form::open(array('url'=>'admin/subcategory','id'=>'subcategory')) !!}
 
 {{ csrf_field() }}


 <table style="border: 1px solid #9f9f9f;" cellspacing="10" class="table">

 <tr>
    <td>
          <label for="category">{{ trans('common.category') }} </label>
        </td>
        <td>
  {!! Form::select('category_group_id',$category,null,array("class"=>"form-control","id"=>"category", "required"=>"true" )) !!}
  </td>
  </tr>

  @foreach($language as $v)
  <tr>
    <td>
          <label for="name">{{ trans('common.name') }} {{$v->name}}</label>
        </td>
        <td>
  {!! Form::text('name[]',null,array("class"=>"form-control","id"=>"name_".$v->code, "required"=>"true" )) !!}
  </td>
  </tr>
@endforeach
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


@endsection
