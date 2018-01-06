@extends('admin.layout.master')

@section('content')

<div class="col-xs-12">
 <button class="btn btn-primary pull-right" onclick="printReciept()"><i class="fa fa-print"></i> Print</button>
<button class="btn btn-default pull-right" onclick="preView()" style="margin-right:5px"><i class="fa fa-search"></i> Print Preview</button>
</div>


<div id="print_report" style="min-height:600px">

<table id="title_bar" width="100%">
	<tr>
		<td id="title" align="center">
		<div style="width:300px">
		<img style="height:90px;float:left;" src="{{ url('public/uploads/images/logo.jpg') }}">
		<h2 id="h2" style="margin-bottom: -10px;
    padding-bottom: 0px;"> អឹម​ អាយ អេស ធីម </h2>
		<h3>{{ trans('common.report') }} - {{ $title}}</h3>
		<small>{{ $subtitle }}</small>
		</div>
		</td>
	</tr>
	
</table>
<br />
<table id="contents" class="table table-reponsive">
	<tr>
		<td id="item_table">
			<div id="table_holder" style="width:100%;">
				<table class="report table table-reponsive table-bordered">
					<thead>
						<tr>
							<?php foreach ($headers as $header) { ?>
							<th align="<?php echo $header['align'];?>"><?php echo $header['data']; ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $row) { ?>
						<tr>
							<?php foreach ($row as $cell) { ?>
							<td align="<?php echo $cell['align'];?>"><?php echo $cell['data']; ?></td>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>	
			<div id="report_summary" class="tablesorter report" style="margin-right: 10px;">
			<?php foreach($summary_data as $name=>$value) { ?>
				<div class="summary_row" style="font-size: 17px;
    text-align: right;"><?php echo "<strong>".trans('common.'.$name). ' </strong>: '.$value ?></div>
			<?php }?>
			</div>
		</td>
	</tr>
</table>

</div>


<script type="text/javascript">
$(window).load(function()
{
	//window.print();
});
function preView(){

	//window.print('');
	 var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
     disp_setting+="scrollbars=yes,width=1123, height=794, left=100, top=25"; 
 var content_vlue = document.getElementById("print_report").innerHTML; 
 
 var docprint=window.open("","",disp_setting); 
  docprint.document.open(); 
  docprint.document.write('<html><head><title>Stock inventory System</title>'); 
  docprint.document.write('</head><body style=" margin:0px; font-family :Verdana, Khmer Os Battambang; font-size:13px;"><center>');          
  docprint.document.write('<style type="text/css">#h2{margin-bottom: -5px;padding-bottom: 0px;}#report_summary{text-align:right;font-size:14px;}#contents{width:100%} .report{width:100%;border-collapse:collapse;} .report tr>th, .report tr>td{ white-space:nowrap;font-size:12px; border-collapse:collapse;border:1px solid;padding-left:3px;padding-right:3px;} h5{padding-left: 3px; text-align:center;} h4{padding-left: 3px; text-align:center;}body{ margin:0px;');
  docprint.document.write('font-family:Helvetica Neue",Helvetica,Arial,sans-serif, khmer os battambang; font-size:14px;border-spacing: 0; border-collapse: collapse;padding-left: 3px; padding-right: 3px;padding-top:3px;padding-bottom:3px; }');
  docprint.document.write('a{color:#000;text-decoration:none;} p{display: inline;}</style>');
  docprint.document.write(content_vlue);          
  docprint.document.write('</center></body></html>'); 
  docprint.document.close(); 
  docprint.focus(); 
}

function printReciept(){
	//window.print('');
var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
   disp_setting+="scrollbars=yes,width=1123, height=794, left=100, top=25"; 
var content_vlue = document.getElementById("print_report").innerHTML; 

var docprint=window.open("","",disp_setting); 
docprint.document.open(); 
docprint.document.write('<html><head><title>Stock inventory System</title>'); 
docprint.document.write('</head><body onLoad="self.print()" style=" margin:0px; font-family:Verdana,Khmer Os Battambang; font-size:13px;"><center>');          
docprint.document.write('<style type="text/css">#h2{margin-bottom: -5px;padding-bottom: 0px;}#report_summary{text-align:right;font-size:15px;} #contents{width:100%} .report{width:100%;border-collapse:collapse;} .report tr>th, .report tr>td{font-size:12px; white-space:nowrap;border-collapse:collapse;border:1px solid;padding-left:3px;padding-right:3px;padding-top:3px;padding-bottom:3px;} h5{padding-left: 3px; text-align:center;} h4{padding-left: 3px; text-align:center;}body{ margin:0px;');
docprint.document.write('font-family:Helvetica Neue",Helvetica,Arial,sans-serif, khmer os battambang; font-size:14px;border-spacing: 0; border-collapse: collapse;padding-left: 3px; padding-right: 3px; }');
docprint.document.write('a{color:#000;text-decoration:none;} p{display: inline;}</style>');
//window.print();
docprint.document.write(content_vlue);          
docprint.document.write('</center></body></html>'); 
docprint.document.close(); 
docprint.focus(); 
}
</script>




@endsection