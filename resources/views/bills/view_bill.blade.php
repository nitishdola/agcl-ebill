@extends('layouts.user')
@section('pageCss')
<style>
.align-center {
	text-align: center;
}
.table {
	font-size: 13px !important;
}
.table td {
	text-align: center;
}
.tax-table td {
	text-align: left;
}
.tax-table th {
	font-weight: 400 !important;
}
.bill-collection-info td {
	text-align: left;
}
.bank {
	padding:4px;
}
.uppercase {
	text-transform: uppercase;
}
.weighted {
	font-weight: bold;
}
.bill-info {
	 font-size: 13px; line-height: 18px;
}
.gap { margin-top: 20px; }
@media print
{
  	body {font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif !important; font-size: 9px;}
	.table { font-size: 9px !important; border: none !important; }
	.bill-info {
	 font-size: 9px; line-height: 12px;
	}
	.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
	    padding: 0px !important;
	}
	.gap { margin-top: 0; }
	.gap2 { margin-top: 10px; }
}
</style>
@stop
@section('content')
<div class="container">
    <div class="col-xs-12">
        <!-- <h4>Hello {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }} !</h4>
        <h6> Current Bill </h6> -->
        <p><a href="{{ route('user.home') }}" class="btn btn-info"> Back to Home </a></p>
        @if($consumer_info == null || $meter_reading_data == null || $bill_details == null)

        <div class="alert alert-warning">
		  <strong>Oops !</strong> No Bills Found .
		</div>
		@else
		<div id="printableArea">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 align-center">
					<strong>ASSAM GAS COMPANY LTD</strong>
					<br><strong>P.O. DULIAJAN</strong>
					<br><strong>DIST DIBRUGARH, ASSAM-786602</strong>
					<br><strong>RETAIL INVOICE</strong> FOR {{ $consumer_info->consumer_type['TYPE_OF_CUSTOMER'] }} CONSUMER OF {{ $grid_info->GRID_NAME}}
				</div>
			</div>

			<div class="bill-info">
				<div class="row gap">
					<div class="col-xs-6">
						<div class="col-xs-5"> Consumer Account No. </div>
						<div class="col-xs-7">: {{ $consumer_info->CONSUMER_NO }}</div>

						<div class="col-xs-5"> Consumer Name </div>
						<div class="col-xs-7">: {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }}</div>

						<div class="col-xs-5"> Address </div>
						<div class="col-xs-7">: {{ $consumer_info->ADDRESS1 }} {{ $consumer_info->ADDRESS2 }} {{ $consumer_info->ADDRESS3 }}</div>

					</div>

					<div class="col-xs-6">
						<div class="col-xs-5"> Bill No. </div>
						<div class="col-xs-7">: {{ $bill_no }}</div>

						<div class="col-xs-5"> Invoice Date </div>
						<div class="col-xs-7">: {{ date('d-M-y', strtotime($bill_details->Bill_Date)) }}</div>

						<div class="col-xs-5"> Bill Period </div>
						<div class="col-xs-7">: {{ date('d-M-y', strtotime($bill_details->From_Dt)) }} to {{ date('d-M-y', strtotime($bill_details->To_Dt)) }}</div>

						<div class="col-xs-5"> Payment Due On </div>
						<div class="col-xs-7">: {{ date('d-M-y', strtotime($bill_details->payByDate)) }}</div>
						<div style="margin-top:10px;">&nbsp;</div>
						<div class="col-xs-5"> Next Reading Due On </div>
						<div class="col-xs-7">: {{ date('d-M-y', strtotime("+2 months", strtotime($bill_details->From_Dt))) }}</div>
					</div>
				</div>

				<div class="row gap">
					<div class="col-xs-6">
						<div class="col-xs-5"> Phone Number</div>
						<div class="col-xs-7">: {{ $grid_info->PHONE }}</div>

						<div class="col-xs-5"> Consumer Category </div>
						<div class="col-xs-7">: <strong> Metered {{ $consumer_info->consumer_type['TYPE_OF_CUSTOMER'] }} {{ date('M\'y', strtotime($bill_details->From_Dt)) }} </strong></div>

					</div>
				</div>

				<div class="row gap">
					<div class="col-xs-12">
						<table class="table table-condensed">
							<tr>
								<td>Meter No</td>
								<td>Prev. Reading</td>
								<td>Prev. Reading Date</td>
								<td>Curr Reading</td>
								<td>Curr Reading Date</td>
								<td>Corr. Fac</td>
								<td>Consumption</td>
							</tr>

							<tr>
								<td>{{ $consumer_info->METERNO }}</td>
								<td>{{ $meter_reading_data->PREV_READ }}</td>
								<td>{{ date('d-M-Y', strtotime($meter_reading_data->PREV_READ_DT)) }}</td>
								<td>{{ $meter_reading_data->CURR_READ }}</td>
								<td>{{ date('d-M-Y', strtotime($meter_reading_data->CURR_READ_DT)) }}</td>
								<td>{{ $meter_reading_data->CORRFACTOR }}</td>
								<td>{{ $meter_reading_data->DIFF_READ }}</td>
							</tr>

							
						</table>
					</div>

				</div>

				<div class="row gap">
					<div class="col-xs-12">
						<p> Average consumption of last six months (In case of domestic consumers) </p>
						<strong>Minimum Monthly Consumption : {{ $meter_reading_data->MIN_QTY }} SCUM</strong>
					</div>
				</div>

				<div class="row gap">
					<div class="col-xs-12">
						<table class="table table-condensed tax-table">
							<tr>
								<td>Gas Price @&#8377; {{ $montly_billing->GAS_PRICE }}</td>
								<td> {{ $bill_details->Demand_GS }}</td>
							</tr>
							<tr>
								<td>Roaylity @ {{ $montly_billing->ROYALTY }}</td>
								<td> {{ $bill_details->Demand_Royalty }}</td>
							</tr>
							<tr>
								<td>Marketing Margin @&#8377; {{ $montly_billing->MM }} </td>
								<td> {{ $bill_details->Demand_MM }}</td>
							</tr>
							<tr>
								<td>Handling Charges @&#8377; {{ $montly_billing->HC }} </td>
								<td> {{ $bill_details->Demand_HC }}</td>
							</tr>
							<tr>
								<td>VAT @ {{ $montly_billing->VAT }}</td>
								<td> {{ $bill_details->Demand_Tax }}</td>
							</tr>

							<tr>
								<td class="weighted"> Total Gas Sales</td>
								<td class="weighted"> {{ $bill_details->Demand_GS+$bill_details->Demand_Royalty+$bill_details->Demand_MM+$bill_details->Demand_HC+$bill_details->Demand_Tax}} </td>
							</tr>

							<tr>
								<td>TC @ {{ $montly_billing->TC }}</td>
								<td> {{ $bill_details->Demand_TC }}</td>
							</tr>

							<tr>
								<td>Service Tax @ {{ $montly_billing->ST }}</td>
								<td> {{ $bill_details->Demand_Service_Tax }}</td>
							</tr>

							<tr>
								<td class="weighted">Total TC</td>
								<td class="weighted"> {{ $bill_details->Demand_TC + $bill_details->Demand_Service_Tax }} </td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row gap">
					<div class="col-xs-12">
						<table class="table table-condensed tax-table" style="width: 75%">
							<tr>
								<td>Last Mile Connectivity</td>
								<td>&nbsp;</td>
								<td> {{ $bill_details->LMC_DEMAND }}</td>
							</tr>

							<tr>
								<td>Other Charges </td>
								<td>a) Extra charge for special reading beyond work hours</td>
								<td> {{ $bill_details->SPECIAL_READING_DEMAND }}</td>
							</tr>

							<tr>
								<td>&nbsp;</td>
								<td>b) Extra charge for meter testing</td>
								<td> {{ $bill_details->METER_TEST_DEMAND }}</td>
							</tr>

							<tr>
								<td>&nbsp;</td>
								<td>c) Extra charge for burnt/damage/tempered meter</td>
								<td> {{ $bill_details->DAMAGE_METER_DEMAND }}</td>
							</tr>
						</table>
					</div>
				</div>

				<?php

					$totalBill = $bill_details->Demand_TC + $bill_details->Demand_Service_Tax + $bill_details->Demand_GS + $bill_details->Demand_Royalty + $bill_details->Demand_MM + $bill_details->Demand_HC + $bill_details->Demand_Tax+$bill_details->LMC_DEMAND + $bill_details->SPECIAL_READING_DEMAND+$bill_details->SPECIAL_READING_DEMAND + $bill_details->DAMAGE_METER_DEMAND;
					$totalRoundedBill = number_format((float)round($totalBill), 2, '.', '');
				?>

				<div class="row gap">
					<div class="col-xs-12">
						<table class="table table-condensed tax-table">
							<tr>
								<td class="weighted">TOTAL CHARGES</td>
								<t class="weighted" style="text-align: center;"> {{ $totalRoundedBill }} </td>
							</tr>
						</table>


						<table class="table table-condensed tax-table">
							<tr>
								<td width="30%">ADJUSTMENTS</td>
								<td width="48%">Previous Balance</td>
								<td style="text-align: left;"> {{ $consumer_info->BALANCE + $bill_details->ADJUSTMENTS}}</td>
							</tr>

							<tr>
								<td width="30%">&nbsp;</td>
								<td width="45%">Current Dues</td>
								<td style="text-align: left;"> {{ $totalRoundedBill }} </td>
							</tr>

							<tr>
								<td width="30%">&nbsp;</td>
								<td width="45%">Balance</td>
								<td style="text-align: left;"> {{ $consumer_info->BALANCE }}</td>
							</tr>

							<tr>
								<td width="30%">OUTSTANDING</td>
								<td width="48%">&nbsp;</td>
								<td style="text-align: left;"> {{ $bill_details->OUTSTANDING }}</td>
							</tr>

						</table>

						<table class="table table-condensed tax-table">
							<tr>
								<td width="78%"><strong>AMOUNT TO BE PAID WITHIN DUE DATE</strong></td>
								<td><strong>{{ $totalRoundedBill }}</strong></td>
							</tr>

							<tr>
								<td width="78%"><strong>LATE FINE</strong></td>
								<td><strong>{{ $bill_details->LATE_FINE}}</strong></td>
							</tr>

							<tr>
								<td width="78%"><strong>AMOUNT TO BE PAID AFTER DUE DATE</strong></td>
								<td><strong>
								{{ number_format((float)round($totalRoundedBill+$bill_details->LATE_FINE), 2, '.', '') }}
								</strong></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row gap">
					<div class="col-xs-6" style="border-top: 1px solid #666; border-bottom: 1px solid #666">
						<table class="table table-condensed bill-collection-info">
							<tr>
								<td>Bill Collection Center</td>
								<td> : {{ $grid_info->GRID_NAME}} </td>
							</tr>
							<tr>
								<td>Address</td>
								<td> : {{ $grid_info->ADDRESSLINE }} {{ $grid_info->ADDRESSLINE2 }} </td>
							</tr>

							<tr>
								<td>Phone No</td>
								<td> : {{ $grid_info->PHONE }}</td>
							</tr>

							<tr>
								<td>Office Timing</td>
								<td> : {{ $grid_info->TIMING }}</td>
							</tr>
						</table>
					</div>

					<div class="col-xs-6" style="border-top: 1px solid #666; border-bottom: 1px solid #666">
						<table class="table table-condensed table bill-collection-info">
							<tr>
								<td>Complain Receiving Cell</td>
								<td></td>
							</tr>
							<tr>
								<td>In-Charge</td>
								<td></td>
							</tr>

							<tr>
								<td>Nodal Officer</td>
								<td></td>
							</tr>

							<tr>
								<td>Appellate Authority</td>
								<td></td>
							</tr>
						</table>
					</div>

				</div>

				<div class="row gap gap2">
					<div class="col-xs-12">
						<div style="width:49%; float:left;  border: 1px solid #666">
							<div class="col-xs-12 bank"><strong>BANK COPY</strong> {{ $grid_info->BANK }}</div>
							<div class="col-xs-6 bank">
								Consumer Account Number
							</div>

							<div class="col-xs-4 bank">
								: {{ $consumer_info->CONSUMER_NO }}
							</div>

							<div class="col-xs-2 bank">
								<strong>{{ date('M-y', strtotime($bill_details->From_Dt)) }} </strong>
							</div>

							<div class="col-xs-6 bank">
								Consumer Name
							</div>

							<div class="col-xs-6 bank">
								: {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }}
							</div>

							<div class="col-xs-6 bank">
								Bill No
							</div>

							<div class="col-xs-6 bank">
								: {{ $bill_no }}
							</div>

							<div class="col-xs-6 bank">
								<strong>Payment Due On</strong>
							</div>

							<div class="col-xs-6 bank">
								<strong> {{ date('d-M-y', strtotime($bill_details->payByDate)) }} </strong>
							</div>

							<div class="col-xs-6 bank uppercase weighted">
								Amount to be paid within due date
							</div>

							<div class="col-xs-6 bank weighted">
								{{ $totalRoundedBill }}
							</div>

							<div class="col-xs-6 bank uppercase weighted">
								Amount to be paid after due date
							</div>

							<div class="col-xs-6 bank weighted">
								{{ number_format((float)round($totalRoundedBill+$bill_details->LATE_FINE), 2, '.', '') }}
							</div>
						</div>

						<div style="width:49%; float:left; border: 1px solid #666; margin-left:10px">
							<div class="col-xs-12 bank"><strong>AGCL COPY</strong> {{ $grid_info->BANK }}</div>
							<div class="col-xs-6 bank">
								Consumer Account Number
							</div>

							<div class="col-xs-4 bank">
								: {{ $consumer_info->CONSUMER_NO }}
							</div>

							<div class="col-xs-2 bank">
								<strong>{{ date('M-y', strtotime($bill_details->From_Dt)) }} </strong>
							</div>

							<div class="col-xs-6 bank">
								Consumer Name
							</div>

							<div class="col-xs-6 bank">
								: {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }}
							</div>

							<div class="col-xs-6 bank">
								Bill No
							</div>

							<div class="col-xs-6 bank">
								: {{ $bill_no }}
							</div>

							<div class="col-xs-6 bank">
								<strong>Payment Due On</strong>
							</div>

							<div class="col-xs-6 bank">
								<strong> {{ date('d-M-y', strtotime($bill_details->payByDate)) }} </strong>
							</div>

							<div class="col-xs-6 bank uppercase weighted">
								Amount to be paid within due date
							</div>

							<div class="col-xs-6 bank weighted">
								{{ $totalRoundedBill }}
							</div>

							<div class="col-xs-6 bank uppercase weighted">
								Amount to be paid after due date
							</div>

							<div class="col-xs-6 bank weighted">
								{{ number_format((float)round($totalRoundedBill+$bill_details->LATE_FINE), 2, '.', '') }}
							</div>

						</div>
					</div>
					<div style="clear: both;"></div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 40px;">
			<div class="col-md-2"><input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="PRINT" /></div>
		</div>
		@endif
    </div>
</div>

@stop

@section('pageScript')
<script>
function printDiv(printpage)
{
	var headstr = "<html><head><title></title></head><body>";
	var footstr = "</body>";
	var newstr = document.all.item(printpage).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
}
</script>
@stop