
<script type="text/javascript">
  $(function () {
    setNavigation();
});

function setNavigation() {
    var path = window.location.href;    
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);
    
    var arr = path.split('/');
   var newlink = path.replace('/'+arr[6], '');

   var arr2 = newlink.split('/');
   var newlink2 = newlink.replace('/'+arr2[6], '');
   
    $("#menu li a").each(function () {      
        var href = $(this).attr('href');        
        if (path === href) {
            //$(this).closest('li').addClass("active_menu");
            $(this).closest('li').css( "background", "#006ecc");
        }else if(newlink == href){
          $(this).closest('li').css( "background", "#006ecc");
        }else if(newlink2 == href){
           $(this).closest('li').css( "background", "#006ecc");
        }
    });
}
</script>

<style type="text/css">
  .active_menu{
    background: #006ecc;
  }
</style>

    <img class="img" src="{{url('public/uploads/images/logo.png')}}" style="    height: 58px; margin-top: 0px; margin-left: 6px;
    float: left; margin-right: 5px;">
<ul id="menu">
<li>
          <a href="{{ url('admin') }}" title="Home" style="border-left: 1px solid #999;">
                 <i class="fa fa-home" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.home')}} </b>
           </a>
</li>

@if(checkPermission(['admin','stock']))

<li>
<a href="{{url('admin/product')}}" title="">
                 <i class="fa fa-database" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.product')}} </b>
           </a>
</li>

@endif

@if(checkPermission(['admin','sale']))
<li>
    <a href="{{url('admin/sale')}}" title="">
                 <i class="fa fa-shopping-cart" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.sale')}} </b>
           </a>
</li>
@endif

@if(checkPermission(['admin','stock']))

<li>
    <a href="{{url('admin/purchase')}}" title="">
                 <i class="fa fa-server" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.receive')}} </b>
           </a>
</li>


<li>
<a href="{{url('admin/supplier')}}" title="">
                 <i class="fa fa-users" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.supplier')}} </b>
           </a>
</li>

<li>
<a href="{{url('admin/shipper')}}" title="">
                 <i class="fa fa-users" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.shipper')}} </b>
           </a>
</li>
@endif

@if(checkPermission(['admin','sale']))
<li>
<a href="{{url('admin/customer')}}" title="">
                 <i class="fa fa-users" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.customer')}} </b>
           </a>
</li>
@endif

@if(checkPermission(['admin','account']))
<li>
<a href="{{url('admin/employee')}}" title="">
                 <i class="fa fa-users" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.employee')}} </b>
           </a>
</li>



<li>
    <a href="{{url('admin/pay-deposite')}}" title="">
                 <i class="fa fa-dollar" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.pay_deposite')}} </b>
           </a>
</li>


<li>
    <a href="{{url('admin/report')}}" title="">
                 <i class="fa fa-book" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.report')}} </b>
           </a>
</li>

<li>
    <a href="{{url('admin/exchange')}}" title="">
                 <i class="fa fa-money" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.exchange_rate')}} </b>
           </a>
</li>


<li>
    <a href="{{url('admin/expense_income')}}" title="">
                 <i class="fa fa-dollar" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.expense_income')}} </b>
           </a>
</li>

<li>
          <a href="{{url('admin/setting')}}" title="">
                 <i class="fa fa-th-large" aria-hidden="true" style="padding-bottom: 3px;"></i>
              <br>
            <b>{{ trans('common.other')}} </b>
           </a>
</li>

@endif

</ul>

 <style type="text/css">
   #control_language{
    width: 100%;
    height: 30px;
    font-size: 12px;
    margin-top: 3px;
   }
 </style>
 
