@extends('admin.layout.master')

@section('content')

 <div class="col-xs-8 col-xs-offset-2">
<div class="panel panel-defualt" style="margin-top:-20px;">
                        <div class="panel panel-heading clearfix" style="padding-top: 5px;">
                          <a href="{{ url('admin/product') }}"> <button class="btn btn-primary pull-right"><i class="fa fa-reply" aria-hidden="true"></i> {{ trans('common.back') }} </button></a>
                        <h3 style="margin-top: 5px;"> {{ trans('common.add') }} {{ trans('common.product') }} </h3>
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

 {!! Form::model($product, array('route' => array('product.update', $product->id),'method'=>'PUT','files'=>true)) !!}        

                             {{ csrf_field() }}

                      <div class="row" style="margin: 0px">

                      <div class="col-xs-12">                         
                        <div class="from-group">
                      <button type="submit" class="btn btn-primary pull-right" id="btnsave"><i class="fa fa-save fa-fw" aria-hidden="true"></i> {{ trans('common.save') }}</button>

                         <button type="reset" class="btn btn-default pull-right" style="margin-left: 5px;"> <i class="fa fa-refresh" aria-hidden="true"></i> {{ trans('common.reset') }}</button>      
          
                        </div>
                        </div>


                        <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('category_id',trans('common.category')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::select('category_id',$categories,null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('subcategory_id',trans('common.sub_category')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::select('subcategory_id',$subcategories,null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                         <div class="form-group">
                        <div class="form-label col-xs-12">
                            {!! Form::label('barcode',trans('common.barcode')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('barcode',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                         <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('name',trans('common.name')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {{ Form::text('name',null, ['class' => 'form-control']) }}
                        </div>
                        </div>
                        </div>

                        <div class="col-xs-6">
                        <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('cost',trans('common.cost')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('cost',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>

                        <div class="col-xs-6">
                         <div class="form-group">
                         <div class="form-label col-xs-12">
                            {!! Form::label('price',trans('common.price')) !!}
                        </div>
                         <div class="input-group from-group col-xs-12">                        
                        {!! Form::text('price',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>
                       
                        <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('qty',trans('common.qty')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('qty',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>  

                        <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('qty_alert',trans('common.qty_alert')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('qty_alert',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>  

                      <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('discount',trans('common.discount')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('discount',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>      

                           <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('tax',trans('common.tax')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('tax',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div>       
                       
                         <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('color',trans('common.color')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('color',null,array('class'=>'form-control','id'=>'color')) !!}
                        </div>
                        </div>
                        </div>  

                        <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('unit',trans('common.unit')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('unit',null,array('class'=>'form-control','id'=>'unit')) !!}
                        </div>
                        </div>
                        </div>  

                         <div class="col-xs-6">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('detail',trans('common.detail')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                        {!! Form::text('detail',null,array('class'=>'form-control')) !!}
                        </div>
                        </div>
                        </div> 

                        <div class="col-xs-6">
                           <div class="form-group">
                         <div class="form-label col-xs-12">
                           {!! Form::label('image',trans('common.image')) !!}
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

           
    
              <div class="col-xs-6">
                           <div class="form-group">
                         <div class="form-label col-xs-12">
                          {!! Form::label('file',trans('common.file')) !!}
                        </div>
                                <div class="input-group from-group col-xs-12"> 
                             <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                {{ Form::text('file',null,['class'=>'form-control','id'=>'thumbnail1','readonly'=>true]) }}
                     </div>
                  <img id="holder1" style="margin-top:15px;max-height:100px;">
                        </div>
                        </div>
                        </div>
  

          
                     <div class="col-xs-12">
                        <div class="form-group">
                        <div class="form-label col-xs-12">
                         {!! Form::label('description',trans('common.description')) !!}
                        </div>
                       <div class="input-group from-group col-xs-12">                       
                          <textarea name="description" class="form-control"></textarea>
                        </div>
                        </div>
                        </div>  
  

  </div>  
          
            {!! Form::close() !!}

 </div>
</div>
</div>

<script type="text/javascript" src="{{asset('public/assets/js/jquery-ui.min.js')}}"></script>

<script>
 var route_prefix = "{{ url(config('lfm.prefix')) }}";
 </script>
<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
     $('#lfm1').filemanager('file', {prefix: route_prefix});
  </script>
  
<!-- CKEditor init 
  <script src="{{ url('public/assets/ckeditor/ckeditor.js') }}"></script>   -->
     <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script> 
  <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
  <script>
    $('textarea[name=description]').ckeditor({
      height: 100,
      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: route_prefix + '?type=Files',
      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
  </script>


 

    <script>
  $( function() {
   
    $( "#unit" ).autocomplete({
      minLength: 0, 
      source: "{{route('select_product_unit')}}?_token={{csrf_token()}}", 
  focus: function(event, ui) { 
    $("#unit").val(ui.item.label); 
    return false; 
  }, 
  select: function(event, ui) { 
    $("#unit").val(ui.item.label); 
    return false; 
  } 
    });


    $("#color" ).autocomplete({
      minLength: 0, 
      source: "{{route('select_product_color')}}?_token={{csrf_token()}}", 
  focus: function(event, ui) { 
    $("#color").val(ui.item.label); 
    return false; 
  }, 
  select: function(event, ui) { 
    $("#color").val(ui.item.label); 
    return false; 
  } 
    });

  } );
  </script>


@endsection

