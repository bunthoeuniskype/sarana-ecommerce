<html>
<head>
  <title></title>
    <link id="callCss" rel="stylesheet" href="{{url('')}}/public/assets/themes/cerulean/bootstrap.min.css" media="screen"/>
    <link href="{{url('')}}/public/assets/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>  
    <link href="{{url('')}}/public/assets/themes/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/public/assets/themes/css/custom.css" rel="stylesheet"/>
</head>
<body>

</body>
</html>

<style>
table td {
    border-top: none !important;
}
</style>
<div class="container">
  <div class="row">    
   <div class="col-xs-2">
     <img style="max-height:120px" src="{{url('public/uploads/images/logo.jpg')}}">
   </div> 
  </div>
  <div class="row">
    <div class="col-xs-2" >
       {{$messages}}
   </div>
    <div class="col-xs-2" >
       <a href="{{$url}}">click here verify your email address</a>
   </div>
  </div>
</div>