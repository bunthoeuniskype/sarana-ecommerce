@extends('admin.layout.master')

@section('content')

      <div class="col-xs-6 col-xs-offset-3">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/expense_income') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.expense_income') }} </h3>
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


 {!! Form::open(array('url'=>'admin/expense_income','id'=>'expense_income')) !!}
 
 {{ csrf_field() }}



 <table style="border: 1px solid #9f9f9f;" cellspacing="10" class="table">
 

  <tr>
    <td>
          <label for="total_income">{{ trans('common.total_income') }}</label>
        </td>
        <td>
  {!! Form::text('total_income',null,array("class"=>"form-control","id"=>"total_income", "required"=>"true" )) !!}
  </td>
  </tr>

  <tr>
    <td>
          <label for="total_expense">{{ trans('common.total_expense') }}</label>
        </td>
        <td>
  {!! Form::text('total_expense',null,array("class"=>"form-control","id"=>"total_expense", "required"=>"true" )) !!}
  </td>
  </tr>

    <tr>
    <td>
          <label for="date">{{ trans('common.date') }}</label>
        </td>
        <td>
  {!! Form::text('date',null,array("class"=>"form-control","id"=>"date", "required"=>"true" )) !!}
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

<script type="text/javascript">
  $('#date').datepicker({format:"yyyy-mm-dd"});

</script>
@endsection
