@extends('admin.layout.master')

@section('content')

<style>
table td {
    border-top: none !important;
}
</style>
<div class="container-fluid">

<div id="print_invoice">

 <div class="row">
 <div class="col-xs-6"> 
  <h3> <i class="fa fa-dollar"></i> Payment Pay Deposite</h3> 
 </div>
        <div class="col-xs-6">                  
            <a href="{{ url('admin/pay-deposite') }}"  type="button" class="btn btn-primary pull-right hidden-print"><i class="fa fa-reply"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">

              <table class="table table-bordered">
          <tr>
        <td style="font-size:16px; width:35%" rowspan="6"> 
         
           Payowed Date : {{ date("d-M-Y", strtotime($payowed->created_at)) }}<br /> 
           Total Amount : {{ $payowed->total_amount }}<br /> 
           Paid : {{ $payowed->total_paid }}<br /> 
           Balance : {{ $payowed->total_amount - $payowed->total_paid }}<br />         
      
        </td>
         <td  style="font-size:16px; width:30%">
           Customer : {{ $payowed->customer->firstname.' '.$payowed->customer->lastname }}<br />
           Phone : {{ $payowed->customer->phone }}<br />  
           Email : {{ $payowed->customer->email }}<br />  
           Address : {{ $payowed->customer->address }}<br /> 
         </td>
             <td  style="font-size:16px; width:30%">
                    Invoice ID : P-{{$payowed->id}} <br>
                    Description : <br>
                    {{$payowed->description}}
                    
          </td>
                
         </tr>             
            </table>

           <table class="table table-bordered">
                <tr>
                    <th width="5%">#</th>                  
                    <th width="10%">Payment Date</th>
                    <th width="10%">Per Term</th>
                    <th width="10%">Paid Date</th>
                    <th width="8%">Status</th>
                    <th width="7%">Payment</th>
                </tr>
                <?php $i=1; ?>
                @foreach($payoweddetail as $value)
                <tr style="{{ $value->status==1?'':'background: blanchedalmond' }}">
                    <td>{{$i++}}</td>
                    <td>{{ date("d-M-Y", strtotime($value->payment_date))}}</td>
                    <td>$ {{$value->payment_term}}</td>
                    <td>{{ $value->paid_date==''?'---':date("d-M-Y", strtotime($value->paid))}}</td>
                    <td>{{$value->status==1?'Unpaid':'Paid'}}</td> 
                    <td>{!! $value->status==1?'<a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-dollar"></i> Payment</a>':'Clear' !!}</td>                
                </tr>
                @endforeach
      </table>

    
        </div>

        </div>
    </div>
   
   </div>
   
   

</div>

<!-- show dialog -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ url('admin/pay-deposite/'.$payowed->id.'/payment') }}" method="post">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{csrf_field()}}
     
       <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3"> Invoice ID </div>
       <div class="col-xs-9"> <input type="text" class="form-control" value="Payowed-{{ $payowed->id }}" readonly="true"></div>
       </div>      

       <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3"> Customer </div>
       <div class="col-xs-9"> <input type="text" class="form-control" value="{{ $payowed->customer->firstname.' '.$payowed->customer->lastname }}" readonly="true"></div>
       </div>

       <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3"> Total Amount </div>
       <div class="col-xs-9"> <input type="text" class="form-control" value="{{ $payowed->total_amount }}" readonly="true"></div>
       </div>

        <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3"> Amount Paid </div>
       <div class="col-xs-9"> <input type="text" class="form-control" value="{{ $payowed->total_paid }}" readonly="true"></div>
       </div>

     
       <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3">Pay Amount</div>
       <div class="col-xs-9"> <input type="text" id="payment_term" name="payment_term" readonly="true" class="form-control" value="{{ $payowed->payment_term }}"></div>
       </div>

      <div class="row" style="margin-top:5px"> 
       <div class="col-xs-3">Payment Date </div>
       <div class="col-xs-9"> <input type="text" id="payment_date" required="true" name="payment_date" class="form-control" ></div>
       </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

       </form>
       
    </div>
  </div>
</div>

<script type="text/javascript">
   $('#payment_date').datepicker({format:"dd-M-yyyy"});
</script>

@endsection

