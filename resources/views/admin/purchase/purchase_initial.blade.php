<form action="{{url('admin/purchase')}}" method="post" id="purchase_form">
{{csrf_field()}}

<div class="col-xs-10" style="padding: 0px; padding-right: 10px;">

<div class="row"> 
<div class="col-xs-6">
 <input type="text" onkeydown="if (event.keyCode == 13) return false;" placeholder="Scan Barcode ...................... " id='scan_barcode' class='form-control' style="border: 1px solid; height: 35px;">
</div>
<div class="col-xs-1 text-right" style="font-size: 16px;padding-right: 0px;">Mode : </div>
<div class="col-xs-2">
  <select name="mode" id="mode" class="form-control">
    <option value="Receive">Receive</option>
    <option value="Return" {{ $data['mode'] == 'Return'?'selected':'' }}>Return</option>
  </select>

</div>
<div class="col-xs-3" style="font-size: 16px">Exchange Rate : $ {{$exchange->dollar}} = ៛ {{$exchange->riel}}</div>
</div>

<table class="table table-bordered table-hover" id="PurchaseTable">
<thead>
<tr>
<th width="5%">Image</th>
<th width="15%">Barcode</th>
<th width="20%">Item Name</th>
<th width="7%">Stock</th>
<th width="10%">Cost</th>
<th width="10%">Quantity</th>
<th width="10%">Discount %</th>
<th width="10%">Amount </th>
<th width="5%">Remove</th>
</tr>
</thead>
<tbody>

<?php use App\CartPurchase; ?>


@if(Session::has('cart_purchase'))
<?php 
$oldCart = Session::get('cart_purchase');
$cart=new CartPurchase($oldCart);
 ?>

@foreach($cart->items as $key => $product)
<tr>
<td>​
<input type="hidden" id="productID_{{$key}}"value="{{$product['item']['id']}}" class="changesNo">
<img src="{{ asset('public/'.$product['item']['image']) }}" style="height: 35px;"></td>
<td>​{{ $product['item']['barcode'] }} </td>
<td>​{{ $product['item']['name'] }} </td>
<td>​{{ $product['item']['qty'] }} </td>
<td style="white-space: nowrap;">​ <input type="number" id="cost_{{$key}}" value="{{ $product['cost'] }}" class="form-control changesNo"></td>
<td style="white-space: nowrap;">​ <input type="number" id="qty_{{$key}}" value="{{ $product['qty'] }}" class="form-control changesNo"> </td>
<td style="white-space: nowrap;">​ <input type="number" id="discount_{{$key}}" value="{{ $product['discount'] }}" class="form-control changesNo"> </td>
<td>​ $ {{ $product['amount'] }} </td>
<td style="white-space: nowrap;">​ <a href="{{url('admin/purchase/remove/'.$product['item']['id'])}}">
    <button type="button" class="btn btn-xs btn-danger">
     <span class="glyphicon glyphicon-remove"></span>
    </button></a>
</td>
</tr>

@endforeach

@else
<tr>
<td colspan="9" align="center">​ No Item in Cart </td>
</tr>
@endif 

</tbody>
</table>

<textarea class="form-control" rows='3' cols="10" name="description" id="notes" onkeydown="if (event.keyCode == 13) return false;" placeholder="Your Notes"></textarea>

    </div>

<div class="col-xs-2" style="padding: 0px">

<div class="form-group">
{{ Form::label('Supplier :')}}
<select class="form-control" name="supplier_id">
    <option value="">Select Supplier .....</option>
    @foreach ($suppliers as $key => $value)
        <option value="{{ $key }}">{{$value}}</option>
    @endforeach
</select>
</div>

<div class="form-group">
{{ Form::label('Shipper :')}}
<select class="form-control" name="shipper_id">
    <option value="">Select Shipper .....</option>
    @foreach ($shippers as $key => $value)
        <option value="{{ $key }}">{{$value}}</option>
    @endforeach
</select>
</div>

<div class="form-group">
<label>Subtotal: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="sub_total" id="subTotal" placeholder="Sub total" value="{{$data['totalCost']}}">
</div>
</div>
<div class="form-group">
<label>Discount Amount: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="text" value="0" class="form-control" pattern="[0-9.]*" name="discount_amount" id="DiscountAmount" placeholder="Discount Amount"  required="true" ondrop="return false;" onpaste="return false;" onkeydown="if (event.keyCode == 13) return false;">
</div>
</div>

<div class="form-group">
<label>Total: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="total" id="totalAfterDiscount" placeholder="Total" value="{{$data['totalCost']}}">
</div>
</div>

<div class="form-group">
<label>Total Reil: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">៛</div>
<input type="number" class="form-control" readonly="true" name="total_riel" id="totalAfterDiscount_riel" placeholder="Total Riel"​ value="{{$data['totalCost']*$exchange->riel}}">
</div>
</div>


<div class="form-group">
<label>Amount Paid: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="text" value="0" class="form-control" pattern="[0-9.]*" name="amount_paid" id="amount_paid" placeholder="Amount Paid" ondrop="return false;" onpaste="return false;" onkeydown="if (event.keyCode == 13) return false;" required="true">
</div>
</div>
<div class="form-group">
<label>Amount Due: &nbsp;</label>
<div class="input-group">
<div class="input-group-addon">$</div>
<input type="number" class="form-control" readonly="true" name="amount_due" value="{{$data['totalCost']}}" id="amount_due" placeholder="Amount Due">
</div>
</div>

<button data-loading-text="Saving Purchase ..." type="submit" name="invoice_btn" onclick="valid_total()" class="btn btn-success submit_btn form-control"> <i class="fa fa-floppy-o"></i> Save & Print</button>

 </div>
 
<form>

<div id="ajaxBusy"></div>

<script type="text/javascript">

function valid_total(){
 
  $('#purchase_form').submit(function(){
    var total = $('#subTotal').val();
    if(total == 0)
      return false;
      return true;
    });
}

$(document).ready(function(){

$("#scan_barcode" ).focus();
//cost change
$(document).on('keydown','.changesNo',function(event) {
  
     var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13' || keycode == '9') {   
      event.stopPropagation();
      $('#ajaxBusy').show();
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    product_id = $('#productID_'+id[1]).val();
    quantity = $('#qty_'+id[1]).val();
    cost = $('#cost_'+id[1]).val();
    discount = $('#discount_'+id[1]).val();
  $.get("{{route('purchase.updatecart')}}?_token={{csrf_token()}}", {id: product_id,qty:quantity,cost:cost,discount:discount } )
  .done(function( data ) {
     $('#ajaxBusy').hide();
    if(data.status == true){
     $('#load_initail').load('{{route('load_initial.purchase')}}');
    }
  });

}
   // alert("Product ID => "+product_id+" cost => "+cost + " qty => " + quantity+" discount => "+discount);    
});

$('#mode').on('change',function () {
  change_mode = $('#mode').val();  
 $.get("{{route('mode.purchase')}}?_token={{csrf_token()}}", {mode: change_mode } )
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
        $('#ajaxBusy').show();
    
        $.ajax({
        type : 'GET',
        url : '{{url('admin/purchase/addcart')}}/'+barcode,
        dataType:'json',
        success:function(data){
           $('#ajaxBusy').hide();
             if(data.status==true){
           $('#load_initail').load('{{route('load_initial.purchase')}}');
           }else if(data.status==false){
            alert('Product Item Not Found!');
           }
            $('#scan_barcode').val('');
         }
         })
        }
        else
        {
            barcode=barcode+String.fromCharCode(code);
        }  

      }})

$(document).on('change keyup blur','#DiscountAmount',function(){
    calculateTotal();
});

//total cost calculation 
function calculateTotal(){
       
    subTotal = $('#subTotal').val();    
    Discount = $('#DiscountAmount').val();

    if(Discount != '' && typeof(Discount) != "undefined" ){       
        total = subTotal - Discount;
    }else{
        total = subTotal;
    }
    $('#totalAfterDiscount').val( total.toFixed(2) );
    //calculateAmountDue();
}

$(document).on('change keyup blur','#amount_paid',function(){
    calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
    amountPaid = $('#amount_paid').val();
    total = $('#totalAfterDiscount').val();
    if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
        amountDue = parseFloat(total) - parseFloat( amountPaid );
        $('#amount_due').val( amountDue.toFixed(2) );
    }else{
        total = parseFloat(total).toFixed(2);
        $('#amount_due').val( total);
    }
}


if(typeof errorFlag !== 'undefined'){
        $('.message_div').delay(5000).slideUp();
    }

});

 $("#purchase_form").validate({    
    rules: {
        amount_paid : {
            number : true,
            required : true
        },
        discount_amount : {
            number : true,
            required : true
        }

    }
   });
   
</script>