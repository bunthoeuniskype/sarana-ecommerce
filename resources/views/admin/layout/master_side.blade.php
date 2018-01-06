<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MIS Team</title>

    <!-- Bootstrap Core CSS -->
    {{ Html::style('public/assets/css/bootstrap.min.css') }}
   
    {{ Html::style('public/assets/css/neon-core.css') }} 
     {{ Html::style('public/assets/css/sb-admin.css') }}
    {{ Html::style('public/assets/css/fileinput.min.css') }}
     {{ Html::style('public/assets/css/jquery-ui.min.css') }}
     {{ Html::style('public/assets/css/datepicker.css') }}
    {{ Html::style('public/assets/css/font-awesome.min.css') }}
   {{ Html::style('public/assets/css/non-responsive.css') }}    
    {{ Html::style('public/assets/css/jquery.dataTables.css') }}
    {{ Html::style('public/assets/css/style.css') }}   
    
    {{ Html::script('public/assets/js/jquery.js') }}
     {{ Html::script('public/assets/js/jquery.validate.min.js') }}
    {{ Html::script('public/assets/js/jquery-ui.min.js') }}
    {{ Html::script('public/assets/js/fileinput.min.js') }}    
    {{ Html::script('public/assets/js/bootstrap.min.js') }}
    {{ Html::script('public/assets/js/bootstrap-datepicker.js') }}
    {{ Html::script('public/assets/js/bootbox.min.js') }}
    {{ Html::script('public/assets/js/jquery.dataTables.min.js') }}

<script type="text/javascript">
 var baseurl = window.location.origin;

</script>
  

</head>

<body>

<div class="row" style="margin: 0px;">
 
    <div class="col-xs-12">
       <div style="background-color: #76ad94;min-height: 60px;"> 
       @include('admin.layout.menu_header')
       </div>
     </div>    

     <div  class="col-xs-12" style="clear: both; margin-top: -24px;background: beige; margin-bottom: 20px;">
                <div style="float: right;">
 
        {{ Form::Open(array('url'=>'locale','method'=>'post')) }}
                                {{csrf_field()}}
                              <table><tr><td><label>{{trans('common.language')}} : </label></td> <td>{{ Form::select('locale',['en'=>trans('common.english'),'kh'=>trans('common.khmer')],App::getLocale(),array("class"=>"form-control",'id'=>'control_language','onchange'=>'this.form.submit()'))}}</td>
                              </tr></table>
                              {{ Form::Close() }}   

  </div>
<div  style="float:left">
  <h5 style="color: #000; margin-top: 7px; margin-bottom: 6px; padding-right: 3px;"> {{ trans('common.user') }} : {{ Auth::user()->name }}  <span><a href="{{ Route('user.logout') }}" style="color:#fd1e1e;"><i class="fa fa-sign-out" aria-hidden="true"></i>{{ trans('common.exit') }}</a></span></h5> 
  </div>
 </div>

    <div class="row" style="margin:0px"> 
    <div class="col-xs-3" style="padding-left: 0px; padding-right: 0px;">
         @include('admin.layout.menu_side')
    </div>
    <div class="col-xs-9" style="padding-left: 0px; padding-right: 0px;">
         @yield('content')
    </div>
</div>



</div>

{{ Html::script('public/assets/js/script.js') }}

</body>

</html>
