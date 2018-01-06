@extends('admin.layout.master_side')

@section('content')

      <div class="col-xs-6 col-xs-offset-3">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/user') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.user') }} </h3>
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


 {!! Form::open(array('url'=>'admin/user','id'=>'user')) !!}
 
 {{ csrf_field() }}


 <table style="border: 1px solid #9f9f9f;" cellspacing="10" class="table">

 <tr>
    <td>
          <label for="employee">{{ trans('common.employee') }} </label>
        </td>
        <td>
  {!! Form::select('employee_id',$employees,null,array("class"=>"form-control","id"=>"employee", "required"=>"true" )) !!}
  </td>
  </tr>
 
<tr>
    <td>
          <label for="name">{{ trans('common.name') }}</label>
        </td>
        <td>
    {{ Form::text('name',null,array('class'=>'form-control')) }}
  </td>
  </tr>

  <tr>
    <td>
          <label for="email">{{ trans('common.email') }}</label>
        </td>
        <td>
    {{ Form::email('email',null,array('class'=>'form-control',"required"=>"true")) }}
  </td>
  </tr>

  <tr>
    <td>
          <label for="password">{{ trans('common.password') }}</label>
        </td>
        <td>
    {{ Form::password('password',array('class'=>'form-control',"required"=>"true")) }}
  </td>
  </tr>

    <tr>
    <td>
          <label for="confirm_password">{{ trans('common.confirm_password') }}</label>
        </td>
        <td>
    {{ Form::password('confirm_password',array('class'=>'form-control',"required"=>"true")) }}
  </td>
  </tr>

 <tr>
    <td>
          <label for="role">{{ trans('common.role') }} </label>
        </td>
        <td>
  {!! Form::select('role',$roles,null,array("class"=>"form-control","id"=>"role", "required"=>"true" )) !!}
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
