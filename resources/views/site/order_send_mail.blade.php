<html>
<head>
  <title></title>
    <link id="callCss" rel="stylesheet" href="{{url('')}}/public/assets/themes/cerulean/bootstrap.min.css" media="screen"/>
    <link href="{{url('')}}/public/assets/themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>  
    <link href="{{url('')}}/public/assets/themes/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('')}}/public/assets/themes/css/custom.css" rel="stylesheet"/>
</head>
<body>

</body>
</html>

<style>
table td {
    border-top: none !important;
}
</style>
<div class="container">

<div id="print_invoice">
   <div class="row">
      <div class="col-xs-12">
   <div class="col-xs-2">
     <img style="max-height:120px" src="{{url('public/uploads/images/logo.jpg')}}">
   </div>

    <div class="col-xs-8 text-center">
      <h2 style="font-family: khmer os muol; margin-bottom: 0px; text-align:center">អឹម​ អាយ អេស ធីម</h2>
    <h3 style="margin-top: 0px; font-family: khmer os muol; margin-bottom: 0px; text-align:center"> ​មានបោះដុំ និង លក់រាយ​</h3>
    <h3 style="margin-top: 0px; font-family: khmer os muol; margin-bottom: 0px; text-align:center">​កុំព្យូទ័រ កាមេរ៉ាសុវត្តិភាព​ គ្រប់ប្រភេទ</h3>
   </div>

     <div class="col-xs-2" >
       <img style="max-height:120px; float:right;" src="{{url('public/uploads/images/computer.jpg')}}">
   </div>
   </div>
  </div>

  <div class="row">

  <div class="col-xs-12">
   <div class="col-xs-5 text-left" style="font-size:16px;">
     <p>ផ្ទះលេខ​ ១៨៨ ផ្លូវ ២៧១​ </p>
     <p>សង្កាត់បឹងទំពុន ខណ្ឌមានជ័យ</p>
   </div>

    <div class="col-xs-2 text-center"> 
    <h3 style="margin-top: 0px; margin-bottom:0px;text-align:center;">​វិក័យប័ត្រ</h3>
    <h3 style="margin-top: 0px; margin-bottom:0px;text-align:center;">​INVOICE</h3>
   </div>

    <div class="col-xs-5 text-right" style="font-size:16px; text-align:right">
    Tel : 012 69 19 58<br>
    016 64 76 01<br>
    015 92 87 82<br>

   </div>
  </div>
  </div>
@foreach ($orders as $order)
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
                    <th width="25%">Barcode</th>
                    <th width="30%">Name</th>
                    <th width="10%">Price</th>
                    <th width="10%">QTY</th>
                    <th width="10%">Discount</th>
                    <th width="10%">Tax</th>
                    <th width="15%">Amount</th>
                </tr>

               @foreach($order->cart->items as $item)
                <tr>
                    <td>{{ $item['item']['barcode']}}</td>
                    <td>{{ $item['item']['name']}}</td>
                    <td>$ {{ $item['item']['price']}}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['item']['discount']}} %</td>
                     <td>{{ $item['item']['tax']}} %</td>
                    <td style="white-space:nowrap;">$ {{$item['price']}}</td>
                </tr>
          @endforeach
      </table>

      <table class="table table-bordered">
          <tr>
        <td style="font-size:16px; width:35%" rowspan="6"> 
         
           Date : {{ date("d-M-Y", strtotime($order['created_at'])) }}<br />

           @if($order->customer != '')
           Customer : @if($order->customer->firstname == '' AND $order->customer->lastname == '')
                       {{$order->customer->email}} <br />
                      @else
                       {{ $order->customer->firstname.' '.$order->customer->lastname }}<br />
                      @endif
           @endif
           
           Order ID : {{$order->payment_id}}<br />
           @if($order->employee_id != '')
           Employee : {{$order->user->name}}<br />
           @endif
           Exchange Rate : $ {{$exchange->dollar }} = ៛​​​ {{$exchange->riel}}
      
        </td>
                    <td  style="font-size:16px; width:30%" rowspan="6">
                    @if($order->description != '')
                    Description : <br>
                    {{$order->description}}
                    @endif
                    </td>

                           
                   <td style="font-size:12px; font-weight: 800;text-align: right;">Total : </td>
                    <td>$ {{$order['total_amount']}}</td>
           </tr>
           <tr>
                 
                   <td style="font-size:12px; font-weight: 800;text-align: right;"> Total Riel : </td>
                    <td>៛ {{$order['total_amount']*$exchange->riel}}</td>
           </tr>
           <tr>
               
                      <td style="font-size:12px; font-weight: 800;text-align: right;"> Amount Paid : </td>
                      <td style="white-space:nowrap;">$ {{ $order['total_amount'] }}</td>
           </tr>
     
          
          <tr>
                   
         </tr>
       </table>

          </div>

        </div>
    </div>

@endforeach

   </div>

</div>
