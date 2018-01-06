@extends('admin.main.main')

@section('content')

<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Product
                           <small>Alert Products</small>
                           </h1>
                            
                  

                        
                        <div class="panel-body">
                        <!-- show error input-->
                         @include('admin/common/errors')

                        {!! Form::model($products, array('route' => array('product.update', $products->id),'method'=>'PUT','files'=>true)) !!}
                   {{ csrf_field() }}
                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('barcode','Barcode: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('barcode',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>
                          <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('sku','Sku: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('sku',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>
                           <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('name','Name: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('name',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>

                         <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('subcategory_id','Category : ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {{ Form::select('subcategory_id',$categories,null, ['class' => 'form-control','readonly'=>'true']) }}
                        </div>
                        </div>

                        <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('measure_id','Measure : ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {{ Form::select('measure_id',$measures,null, ['class' => 'form-control','readonly'=>'true']) }}
                        </div>
                        </div>

                         <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('currency_id','Currency : ') !!}
                        </div>                        
                       <div class="input-group from-group col-sm-9">                       
                        {{ Form::select('currency_id',$currencies,null, ['class' => 'form-control','readonly'=>'true']) }}
                        </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('cost','Cost: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('cost',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('price','Price: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('price',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>

                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('qty','Quantity: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('qty',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="form-label col-sm-2">
                            {!! Form::label('qty_alert','Quantity Alert: ') !!}
                        </div>

                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::text('qty_alert',null,array('class'=>'form-control','readonly'=>'true')) !!}
                        </div>
                        </div>                       
                          <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('image','Image: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::file('image',null,array('id'=>'image')) !!}
                        </div>
                        </div>
                        {{ Html::script('public/assets/nicEditor/nicEdit.js') }}                    
                        <script type="text/javascript">
                            bkLib.onDomLoaded(function() { nicEditors.allTextAreas('description') });
                        </script>
                         <div class="form-group">
                         <div class="form-label col-sm-2">
                            {!! Form::label('description','Description: ') !!}
                        </div>
                       <div class="input-group from-group col-sm-9">                       
                        {!! Form::textarea('description',null,array('class'=>'form-control','readonly'=>'true',3>4)) !!}
                        </div>
                        </div>
                         
                        
                        {!! Form::close() !!}
                    </div>
                         </div>
                </div>
                <!-- /.row -->
@endsection