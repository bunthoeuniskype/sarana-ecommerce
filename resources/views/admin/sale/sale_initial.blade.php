<form action="{{url('admin/sale')}}" method="post" id="sale_form">
{{csrf_field()}}

<div class="col-xs-10" style="padding: 0px; padding-right: 10px;">

<div class="row"> 
<div class="col-xs-6">
 <input type="text" onkeydown="if (event.keyCode == 13) return false;" placeholder="Scan Barcode ...................... " id='scan_barcode' class='form-control' style="border: 1px solid; height: 35px;">
</div>
<div class="col-xs-1 text-right" style="font-size: 16px;padding-right: 0px;">{{trans('common.mode')}} : </div>
<div class="col-xs-2">
  <select name="mode" id="mode" class="form-control">
    <option value="Sale">Sale</option>
    <option value="Return" {{ $data['mode'] == 'Return'?'selected':'' }}>Return</option>
  </select>

</div>
<div class="col-xs-3" style="font-size: 16px">{{trans('common.exchange_rate')}} : $ {{$exchange->dollar}} = ៛ {{$exchange->riel}}</div>
</div>

<table class="table table-bordered table-hover" id="saleTable">
<thead>
<tr>
<th width="5%">{{trans('common.image')}}</th>
<th width="15%">{{trans('common.barcode')}}</th>
<th width="20%">{{trans('common.name')}}</th>
<th width="7%">{{trans('common.stock')}}</th>
<th width="10%">{{trans('common.price')}}</th>
<th width="10%">{{trans('common.qty')}}</th>
<th width="10%">{{trans('common.discount')}} %</th>
<th width="10%">{{trans('common.tax')}} %</th>
<th width="10%">{{trans('common.amount')}} </th>
<th width="5%">{{trans('common.remove')}}</th>
</tr>
</thead>
<tbody>

<?php use App\Cartsale; ?>


@if(Session::has('cart_sale'))
<?php 
$oldCart = Session::get('cart_sale');
$cart=new Cartsale($oldCart);
 ?>

@foreach($cart->items as $key => $product)
<tr>
<td>​
<input type="hidden" id="productID_{{$key}}"value="{{$product['item']['id']}}" class="changesNo">
<img src="{{ asset('public/'.$product['item']['image']) }}" style="height: 35px;"></td>
<td>​{{ $product['item']['barcode'] }} </td>
<td>​{{ $product['item']['name'] }} </td>
<td>​{{ $product['item']['qty'] }} </td>
<td style="white-space: nowrap;">​ <input type="number" id="price_{{$key}}" value="{{ $product['price'] }}" class="form-control changesNo"></td>
<td style="white-space: nowrap;">​ <input type="number" id="qty_{{$key}}" value="{{ $product['qty'] }}" class="form-control changesNo"> </td>
<td style="white-space: nowrap;">​ <input type="number" id="discount_{{$key}}" value="{{ $product['discount'] }}" class="form-control changesNo"> </td>
<td style="white-space: nowrap;">​ <input type="number" id="tax_{{$key}}" value="{{ $product['tax'] }}" class="form-control changesNo"> </td>
<td>​ $ {{ $product['amount'] }} </td>
<td style="white-space: nowrap;">​ <a href="{{url('admin/sale/remove/'.$product['item']['id'])}}">
    <button type="button" class="btn btn-xs btn-danger">
     <span class="glyphicon glyphicon-remove"></span>
    </button></a>
</td>
</tr>

@endforeach

@else
<tr>
<td colspan="10" align="center" style="font-size:18px">​ No Item in Cart </td>
</tr>
@endif 

</tbody>
</table>



<textarea class="form-control" rows='3' cols="10" name="description" id="notes" onkeydown="if (event.keyCode == 13) return false;" placeholder="Your Notes"></textarea>

    </div>

<div class="col-xs-2" style="padding: 0px">

<div class="form-group">
{{ Form::label(trans('common.customer').' :')}}
<select class="form-control" name="customer_id">
    <option value="">Select Customer .....</option>
    @foreach ($customers as $key => $value)
        <option value="{{ $key }}">{{$value}}</option>
    @endforeach
</select>
</div>

<div class="form-group">
<label>{{trans('common.total')}}: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="total" id="totalAfterDiscount" placeholder="Total" value="{{$data['totalPrice']}}">
</div>
</div>

<div class="form-group">
<label>{{trans('common.total_riel')}}: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">៛</div>
<input type="number" class="form-control" readonly="true" name="total_riel" id="totalAfterDiscount_riel" placeholder="Total Riel"​ value="{{$data['totalPrice']*$exchange->riel}}">
</div>
</div>


<div class="form-group">
<label>{{trans('common.amount_paid')}}: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="text" value="0" class="form-control" pattern="[0-9.]*" name="amount_paid" id="amount_paid" placeholder="Amount Paid" ondrop="return false;" onpaste="return false;" onkeydown="if (event.keyCode == 13) return false;">
</div>
</div>
<div class="form-group">
<label>{{trans('common.amount_due')}} : &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="amount_due" value="{{$data['totalPrice']}}" id="amount_due" placeholder="Amount Due" value="0">
</div>
</div>

<div class="form-group">
<label>{{trans('common.change_due')}} : &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="change_due" id="change_due" placeholder="Change Due" value="0">
</div>
</div>

<button data-loading-text="Saving sale ..." type="submit" onclick="valid_total()" name="invoice_btn" class="btn btn-success submit_btn form-control"> <i class="fa fa-floppy-o"></i> Save & Print</button>

 </div>

</form>

<div id="ajaxBusy"></div>

<script type="text/javascript">

function valid_total(){
 
  $('#sale_form').submit(function(){
    var total = $('#totalAfterDiscount').val();
    if(total == 0)
      return false;
      return true;
    });
}

$(document).ready(function(){

$("#scan_barcode" ).focus();
//price change
$(document).on('keydown','.changesNo',function(event) {   
   
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13' || keycode == '9') { 
    event.preventDefault();   
     $('#load_initail :input').attr('disabled', true);
    $('#ajaxBusy').show();
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    product_id = $('#productID_'+id[1]).val();
    quantity = $('#qty_'+id[1]).val();
    price = $('#price_'+id[1]).val();
    discount = $('#discount_'+id[1]).val();
    tax = $('#tax_'+id[1]).val();
  $.get("{{route('sale.updatecart')}}?_token={{csrf_token()}}", {id: product_id,qty:quantity,price:price,discount:discount,tax:tax })
  .done(function( data ) {
     $('#ajaxBusy').hide();
    if(data.status == true){
     $('#load_initail').load('{{route('load_initial.sale')}}');
    }
    $('#load_initail :input').removeAttr('disabled');

  });

}
   // alert("Product ID => "+product_id+" price => "+price + " qty => " + quantity+" discount => "+discount);    
});

$('#mode').on('change',function () {
  change_mode = $('#mode').val();  
 $.get("{{route('mode.sale')}}?_token={{csrf_token()}}", {mode: change_mode } )
  .done(function( data ) {
    console.log('mode changed');
  });
})

$("#scan_barcode" ).autocomplete({
      minLength: 0, 
      source: "{{route('select_product_barcode')}}?_token={{csrf_token()}}", 
  focus: function(event, ui) { 
    $("#scan_barcode").val(ui.item.label); 
    return false; 
  }, 
  select: function(event, ui) { 
    $("#scan_barcode").val(ui.item.id); 
    return false; 
  } 
    });

//Scan Barcode 
$(document).on('keydown','#scan_barcode',function(e){     

        barcode = $('#scan_barcode').val();   
        if(barcode != ''){
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13 || code==9)// Enter key hit
        {   
          e.stopPropagation();           
         $('#load_initail :input').attr('disabled', true);     
        $('#ajaxBusy').show();
    
        $.ajax({
        type : 'GET',
        url : '{{url('admin/sale/addcart')}}/'+barcode,
        dataType:'json',
        success:function(data){          
           $('#ajaxBusy').hide();            
             if(data.status==true){
           $('#load_initail').load('{{route('load_initial.sale')}}');
           }else if(data.status==false){
            alert('Product Item Not Found!');
           } 
           $('#load_initail :input').removeAttr('disabled');        
         }
         })
        return false;  
        }
        else
        {
            barcode=barcode+String.fromCharCode(code);
        }  
    }

})


$(document).on('mouseleave change blur keydown','#amount_paid',function(){
    calculateAmountDue();

});

//due amount calculation
function calculateAmountDue(){

      amountPaid = $('#amount_paid').val();
      total = $('#totalAfterDiscount').val();

      if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
        amountDue = parseFloat(total) - parseFloat(amountPaid);
         exchange = parseFloat(amountPaid) - parseFloat(total);
         $('#change_due').val(exchange);
        $('#amount_due').val(amountDue.toFixed(2));
        
        }else{
            total = parseFloat(total).toFixed(2);
            $('#amount_due').val(total);       
        }

       if(exchange > 0){
        $('#amount_due').val(0);
       }else{
        // amount due > 0
        $('#change_due').val(0);
       }
    }

if(typeof errorFlag !== 'undefined'){
        $('.message_div').delay(5000).slideUp();
    }

});

 $("#sale_form").validate({    
    rules: {
        amount_paid : {
            number : true,
            required : true
        }

    }
  });
</script>

