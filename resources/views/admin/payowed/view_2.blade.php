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
      <div class="col-xs-12">
   <div class="col-xs-2">
     <img style="max-height:120px" src="{{url('public/uploads/images/logo.jpg')}}">
   </div>

    <div class="col-xs-8 text-center">
      <h2 style="font-family: khmer os muol; margin-bottom: 0px;">អឹម​ អាយ អេស ធីម</h2><br>
    <h3 style="margin-top: 0px; font-family: khmer os muol; margin-bottom: 0px;"> ​មានបោះដុំ និង លក់រាយ​</h3><br>
    <h3 style="margin-top: 0px; font-family: khmer os muol; margin-bottom: 0px;">​កុំព្យូទ័រ កាមេរ៉ាសុវត្តិភាព​ គ្រប់ប្រភេទ</h3><br>
   </div>

     <div class="col-xs-2" >
       <img style="max-height:120px; float:right;" src="{{url('public/uploads/images/computer.jpg')}}">
   </div>
   </div>
  </div>

  <div class="row">

  <div class="col-xs-12">
   <div class="col-xs-5 text-left" style="font-size:16px;">
     ផ្ទះលេខ​ ១៨៨ ផ្លូវ ២៧១​ <br>
     សង្កាត់បឹងទំពុន ខណ្ឌមានជ័យ
   </div>

    <div class="col-xs-2 text-center"> 
    <h4 style="margin-top: 0px; margin-bottom:0px;">​<u>វិក័យប័ត្រ​បង់រំលស់</u></h4><br>
    <h4 style="margin-top: 0px; margin-bottom:0px;"><u>Invoice Pay Deposite</u></h4><br>
   </div>

    <div class="col-xs-5 text-right" style="font-size:16px;">
    Tel : 012 69 19 58<br>
    016 64 76 01<br>
    015 92 87 82<br>

   </div>
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
                    <th width="6%">Status</th>
                </tr>
                <?php $i=1; ?>
                @foreach($payoweddetail as $value)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ date("d-M-Y", strtotime($value->payment_date))}}</td>
                    <td>$ {{$value->payment_term}}</td>
                    <td>{{ $value->paid_date==''?'---':date("d-M-Y", strtotime($value->paid_date))}}</td>
                    <td>{{$value->status==1?'Unpaid':'Paid'}}</td>                
                </tr>
                @endforeach
      </table>

    
        </div>

        </div>
    </div>
   
   </div>

    <hr class="hidden-print"/>
    <div class="row">
        <div class="col-xs-12">
            <button style="margin-left:5px;" type="button" onclick="printInvoice()" class="btn btn-info pull-right hidden-print">Print</button> 
            <a href="{{ url('admin/pay-deposite') }}"  type="button" class="btn btn-default pull-right hidden-print">Back</a>
        </div>
    </div>

</div>
<script>
function printInvoice() {

var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
   disp_setting+="scrollbars=yes,width=1123, height=794, left=100, top=25"; 
var content_vlue = document.getElementById("print_invoice").innerHTML; 

var docprint=window.open("","",disp_setting); 
docprint.document.open(); 
docprint.document.write('<html><head><title>MIS</title>'); 
docprint.document.write('</head><body onLoad="self.print()" style=" margin:0px; font-family:Verdana,Khmer Os Battambang; font-size:13px;"><center>');          
docprint.document.write('<style>@import "{{url('public/assets/css/bootstrap.min.css')}}";</style>');
docprint.document.write('<style>@import "{{url('public/assets/css/non-responsive.css')}}";</style>');
docprint.document.write(content_vlue);          
docprint.document.write('</center></body></html>'); 
docprint.document.close(); 
docprint.focus(); 
}

</script>


@endsection

