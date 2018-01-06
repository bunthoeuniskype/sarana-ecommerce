@extends('admin.layout.master')

@section('content')

<div class="row">
  <div class="col-xs-12" style="padding-left: 15px; padding-right:15px;"> 

   <div id="panel panel-default" style="margin-top: -20px;">
                  
     
   <div id="panel panel-default" style="margin-top: -20px;">
                  
                  <div class="panel panel-heading clearfix" style="margin-bottom: -15px;">
                         <a href="{{ url('admin/product/create') }}"><button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i>  {{ trans('common.add') }} {{ trans('common.new') }}</button></a>
                        <h3 style="margin-top: 5px;">{{ trans('common.list') }} {{ trans('common.product') }} </h3>
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


    <table class="table table-striped table-bordered nowrap table-over" id="product-table">   

        <thead>
               <tr>
             <th width="2%">#</th>  
             <th width="8%">{{ trans('common.image') }}</th> 
            <th width="10%">{{ trans('common.barcode') }}</th> 
            <th width="10%">{{ trans('common.category') }}</th>                 
            <th width="25%">{{ trans('common.name') }}</th> 
            <th width="5%">{{ trans('common.cost') }}</th>
             <th width="5%">{{ trans('common.price') }}</th>
             <th width="5%">{{ trans('common.qty') }}</th>
              <th width="5%">{{ trans('common.discount') }}</th>
               <th width="5%">{{ trans('common.color') }}</th>
             <th width="5%">{{ trans('common.action') }}</th> 
                  
            </tr>
        </thead>
        <body>
        <?php $i=1; ?>
        @foreach($product as $value)
          <tr>
            <td>{{ $i++ }}</td>           
             <td>@if($value->image == '')
             <img style="height: 30px" src="{{ asset('public/uploads/images/none.jpg') }}">
             @else
             <img style="height: 30px" src="{{ asset('public/'.$value->image) }}">
             @endif
             </td>
             <td>{{ $value->barcode }}</td>
            <td>{{ $value->category_id==0?'': $value->category->name }}</td>
             <td>{{ $value->name }}</td>       
             <td>{{ $value->cost }}</td>
             <td>{{ $value->price }}</td>
             <td>{{ $value->qty }}</td>
             <td>{{ $value->discount }}</td>
             <td>{{ $value->color }}</td>
            <td>
            <a href="{{ url('admin/product/'.$value->id.'/delete') }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash-o"></i> {{ trans('common.delete') }}</a>
            <a href="{{ url('admin/product/'.$value->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> {{ trans('common.edit') }}</a>
             <a href="{{ url('admin/gallery/'.$value->id) }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-plus"></i> {{ trans('common.add') }} {{ trans('common.gallery') }}</a>
            </td>
              
          </tr>
          @endforeach
        </body>
    </table>
    </div>
</div>

      <script>
$(function() {
    $('#product-table').DataTable({ });
     $.fn.dataTable.ext.errMode = 'throw';
});
</script>


  </div>

</div>


@endsection


