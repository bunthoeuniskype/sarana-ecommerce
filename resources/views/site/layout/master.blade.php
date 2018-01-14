<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>All IN MIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
  <link rel="stylesheet/less" type="text/css" href="{{url('')}}/public/assets/themes/less/simplex.less">
  <link rel="stylesheet/less" type="text/css" href="{{url('')}}/public/assets/themes/less/classified.less">
  <link rel="stylesheet/less" type="text/css" href="{{url('')}}/public/assets/themes/less/amelia.less">  MOVE DOWN TO activate
  -->
  <!--<link rel="stylesheet/less" type="text/css" href="{{url('')}}/public/assets/themes/less/bootshop.less">
  <script src="{{url('')}}/public/assets/themes/js/less.js" type="text/javascript"></script> -->
  
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="{{url('')}}/public/assets/themes/cerulean/bootstrap.min.css" media="screen"/>
    <link href="{{url('')}}/public/assets/themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive --> 
  <link href="{{url('')}}/public/assets/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/> 
  <link href="{{url('')}}/public/assets/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
   <link href="{{url('')}}/public/assets/themes/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify --> 
  <link href="{{url('')}}/public/assets/themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
  <link href="{{url('')}}/public/assets/themes/css/custom.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{url('')}}/public/uploads/images/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('')}}/public/uploads/images/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('')}}/public/uploads/images/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('')}}/public/uploads/images/logo.png">
    <link rel="apple-touch-icon-precomposed" href="{{url('')}}/ppublic/uploads/images/logo.pngg">
  <style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
  <div class="span6">
 <!-- Authentication Links -->
              <a class="btn btn-mini btn-primary" href="{{url('admin')}}">Login Administrator</a> |
             @if (!Auth::guard('customer')->check())
                   <a class="btn btn-mini btn-primary" href="{{url('customerlogin')}}">Login</a> | <a class="btn btn-mini btn-success"  href="customersignup">Register</a>
          
              @else
                    Welcome!<strong>  {{ Auth::guard('customer')->user()->name }} </strong>
                     | <a href="{{ url('customerprofile') }}"><i class="fa fa-btn fa-user"></i> Profile</a>
                     | <a href="{{ url('customerlogout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
             @endif
   </div>  
  
  <div class="span6">
  <div class="pull-right">
   {{trans('common.language')}} : <a href="{{url('locale?locale=kh')}}">{{trans('common.khmer')}}</a> |
   <a href="{{url('locale?locale=en')}}">{{trans('common.english')}}</a>

    <span class="btn btn-mini">$ {{ Session::has('cart') ? Session::get('cart')->totalPrice : '0' }}</span>    
    <a href="{{route('shopping.getcart')}}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }} ] Itemes in your cart </span> </a> 
  </div>
  </div>
</div>

@include('site.layout.menu_head')

</div>
</div>
<!-- Header End====================================================================== -->

@yield('slide')


<div id="mainBody">
  <div class="container">
  <div class="row">
<!-- Sidebar ================================================== -->
  <div id="sidebar" class="span3">
    @include('site.layout.side_bar_left')
  </div>
<!-- Sidebar end=============================================== -->
    <div class="span9">   
         
      @yield('content')
      
    
    </div>
    </div>
  </div>
</div>

<!-- Footer ================================================================== -->
  <div  id="footerSection">
  <div class="container">
    <div class="row">  
    <p class="pull-right">&copy; Develop By Bunthoeun</p>
  </div><!-- Container End -->
  </div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
  <script src="{{url('')}}/public/assets/themes/js/jquery.js" type="text/javascript"></script>
  <script src="{{url('')}}/public/assets/themes/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="{{url('')}}/public/assets/themes/js/google-code-prettify/prettify.js"></script>
  
  <script src="{{url('')}}/public/assets/themes/js/bootshop.js"></script>
    <script src="{{url('')}}/public/assets/themes/js/jquery.lightbox-0.5.js"></script>
 
</body>
</html>