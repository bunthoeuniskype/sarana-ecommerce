@extends('admin.layout.master')

@section('content')

 <div class="col-xs-8 col-xs-offset-2">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/pay-deposite') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.pay_deposite') }} </h3>
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

 {!! Form::open(array('url'=>'admin/pay-deposite','id'=>'payowed_form')) !!}
                        {{ csrf_field() }}

                      <div class="row" style="margin: 0px">
                     
                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('customer','Customer : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {{ Form::select('customer_id',$customers,null, ['class' => 'form-control','required'=>true]) }}
                        </div>
                        </div>
                        </div>

                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('total_amount','Amount : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('total_amount',null,array('class'=>'form-control',"id"=>"total_amount",'required'=>true)) !!}
                        </div>
                        </div>
                        </div>

                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('month_to_pay','Month to Pay : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('month_to_pay',null,array('class'=>'form-control',"id"=>"month_to_pay",'required'=>true)) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('start_date_payment','Start Payment Date : ') !!}
                        </div>
                         <div class="input-group from-group col-xs-12">                        
                        {!! Form::text('start_date_payment',null,array('class'=>'form-control','required'=>true)) !!}
                        </div>
                        </div>
                        </div>                        

                         <div class="col-xs-12">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('description','Description: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::textarea('description',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-12">                         
                        <div class="from-group">
                      <button type="submit" class="btn btn-primary pull-right" id="btnsave"><i class="fa fa-save fa-fw" aria-hidden="true"></i> {{ trans('common.save') }}</button>

                         <button type="reset" class="btn btn-default pull-right" style="margin-left: 5px;"> <i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('common.reset') }}</button>      
          
                        </div>
                        </div>

              </div>  
          
            {!! Form::close() !!}

 </div>
</div>
</div>


<script type="text/javascript">
  $('#start_date_payment').datepicker({format:"dd-M-yyyy"});

  $("#payowed_form").validate({    
    rules: {
        total_amount : {
            number : true,
            required : true
        },
        customer_id : 'required',
        month_to_pay : {
            required : true,
            digits: true
        },
        start_date_payment:{
            required : true,
            date : true
        }

    }

});
</script>
@endsection

