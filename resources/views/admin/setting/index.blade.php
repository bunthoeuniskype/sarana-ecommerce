@extends('admin.layout.master_side')

@section('content')

<?php
 use App\Http\Controllers\SettingController;
 $setting = new SettingController();
 ?>

<div class="row">
  <div class="col-xs-8 col-xs-offset-2"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                        
                        <h3 style="margin-top: 5px;"> {{ trans('common.setting') }} </h3>
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

 {!! Form::open(array('url'=>'admin/setting','files'=>true)) !!}
      
      {{ csrf_field() }}

     <div class="row">
              
         <div class="col-xs-6">
            <div class="form-group">
               <div class="form-label col-xs-12">
                            {!! Form::label('company_logo','Company Logo: ') !!}
             </div> 
             <div class="input-group from-group col-xs-12"> 
                       <div class="input-group">
          <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
          {{ Form::text('company_logo',$setting->get('company_logo'),['class'=>'form-control','id'=>'thumbnail','readonly'=>true]) }}
        </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('company_name','Company Name : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                      
                  {!! Form::text('company_name',$setting->get('company_name'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>
           </div>

          <div class="row">
                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('phone','Phone ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('phone',$setting->get('phone'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('email','Email: ') !!}
                        </div>
                         <div class="input-group from-group col-xs-12">                        
                        {!! Form::text('email',$setting->get('email'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>
                                         
                        <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('address','Address: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('address',$setting->get('address'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('description','Description: ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('description',$setting->get('description'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>


                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('show_per_page', 'Show Per Page : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('show_per_page',$setting->get('show_per_page'),array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('map', 'Map : ') !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('map',$setting->get('map'),array('class'=>'form-control')) !!}
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


