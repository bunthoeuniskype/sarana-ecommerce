@extends('admin.layout.master')

@section('content')

<!-- Page Heading -->
<div class="panel panel-defualt" style="margin-top:-20px; padding: 0px;">
           <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                        <h3 style="margin-top: 5px;"><i class="fa fa-database"></i> {{ trans('common.sale') }} </h3>
                         </div>
       <div class="panel panel-body" style="padding: 0px;">                    
 
             @if(Session::has('save'))
                        <div class="alert alert-success">
                        <em>{!! Session('sale_create') !!}</em>
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times</span>
                        </button>
                        </div>
                        @endif

                        <!-- show error input-->
            @include('admin/common/errors')

<style type="text/css">
  .table > tbody > tr > td{
    padding: 8px;
    padding-top: 0px;
    padding-bottom: 0px;
    line-height: 1.42857143;
    vertical-align: middle;
    border-top: 1px solid #ebebeb;
  }

  #ajaxBusy {
  display: none;
  margin: 0px 0px 0px -50px; /* left margin is half width of the div, to centre it */
  padding: 30px 10px 10px 10px;
  position: absolute;
  left: 40%;  
  top: 0px;
  width: 300px;
  height: 300px;
  text-align: center;
  background: url({{url('public/uploads/images/lg.dual-ring-loader.gif')}});

}

</style>

<div class="row no-margin" id="load_initail">

@include('admin/sale/sale_initial')

</div> 

 </div>
</div>
      <!-- /.row -->




@endsection

