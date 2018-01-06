@extends('admin.layout.master')

@section('content')

<div class="col-xs-8 col-xs-offset-2">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/customer') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.customer') }} </h3>
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

 {!! Form::model($customer, array('route' => array('customer.update', $customer->id),'method'=>'PUT','files'=>true)) !!}

                        {{ csrf_field() }}

                      <div class="row" style="margin: 0px">
                        <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('firstname','First Name: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('firstname',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('lastname','Last Name : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('lastname',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('gender','Gender : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {{ Form::select('gender', ['' => 'Select Gender','Male' => 'Male', 'Female' => 'Female'],null, ['class' => 'form-control']) }}
                        </div>
                        </div>
                        </div>


                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('dob','Date of Birth: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('dob',null,array('class'=>'form-control',"id"=>"dob")) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('email','Email: ') !!}
                        </div>
                         <div class="input-group from-group col-xs-12">                        
                        {!! Form::text('email',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('phone','Phone: ') !!}
                        </div>
                         <div class="input-group from-group col-xs-12">                        
                        {!! Form::text('phone',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>                     
                        </div>
                       
                        <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('address','Address: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('address',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('description','Description: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('description',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>


                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('account_number','Account Number : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('account_number',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>
                       
                        <div class="col-xs-6">
                           <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('image','image: ') !!}
                        </div>
                                <div class="input-group from-group col-xs-12"> 
                       <div class="input-group">
          <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          {{ Form::text('image',null,['class'=>'form-control','id'=>'thumbnail','readonly'=>true]) }}
        </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
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

<script>
 var route_prefix = "{{ url(config('lfm.prefix')) }}";
 </script>
<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});    
  </script>
  
<script type="text/javascript">
  $('#dob').datepicker({format:"dd/mm/yyyy"});
</script>
@endsection

