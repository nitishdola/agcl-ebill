@extends('layouts.user')
@section('pageCss')
<style>
.align-center {
	text-align: center;
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
</style>
@stop
@section('content')
<div class="container">
    <div class="col-md-12">
        <!-- <h4>Hello {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }} !</h4>
        <h6> Current Bill </h6> -->
        @if($consumer_info == null || $meter_reading_data == null || $bill_details == null)

        <div class="alert alert-warning">
		  <strong>Oops !</strong> No Bills Found .
		</div>
		@else
		<div class="row">
			<div class="col-md-6 col-md-offset-3 align-center">
				<strong>ASSAM GAS COMPANY LTD</strong>
				<br><strong>P.O. DULIAJAN</strong>
				<br><strong>DIST DIBRUGARH, ASSAM-786602</strong>
				<br><strong>RETAIL INVOICE</strong> FOR {{ $consumer_info->consumer_type['TYPE_OF_CUSTOMER'] }} CONSUMER OF {{ $grid_info->GRID_NAME}}
			</div>
		</div>

		<div class="bill-info" style="font-size: 13px; line-height: 18px;">
			<div class="row" style="margin-top:20px;">
				<div class="col-md-6">
					<div class="col-md-5"> Consumer Account No. </div>
					<div class="col-md-7">: {{ $consumer_info->CONSUMER_NO }}</div>

					<div class="col-md-5"> Consumer Name </div>
					<div class="col-md-7">: {{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }}</div>

					<div class="col-md-5"> Address </div>
					<div class="col-md-7">: {{ $consumer_info->ADDRESS1 }} {{ $consumer_info->ADDRESS2 }} {{ $consumer_info->ADDRESS3 }}</div>

				</div>

				<div class="col-md-6">
					<div class="col-md-5"> Bill No. </div>
					<div class="col-md-7">: {{ $bill_no }}</div>

					<div class="col-md-5"> Invoice Date </div>
					<div class="col-md-7">: {{ date('d-M-y', strtotime($bill_details->Bill_Date)) }}</div>

					<div class="col-md-5"> Bill Period </div>
					<div class="col-md-7">: {{ date('d-M-y', strtotime($bill_details->From_Dt)) }} to {{ date('d-M-y', strtotime($bill_details->To_Dt)) }}</div>

					<div class="col-md-5"> Payment Due On </div>
					<div class="col-md-7">: {{ date('d-M-y', strtotime($bill_details->payByDate)) }}</div>
					<div style="margin-top:10px;">&nbsp;</div>
					<div class="col-md-5"> Next Reading Due On </div>
					<div class="col-md-7">: {{ date('d-M-y', strtotime("+2 months", strtotime($bill_details->From_Dt))) }}</div>
				</div>
			</div>

			<div class="row" style="margin-top:20px;">
				<div class="col-md-6">
					<div class="col-md-5"> Phone Number</div>
					<div class="col-md-7">: {{ $grid_info->PHONE }}</div>

					<div class="col-md-5"> Consumer Category </div>
					<div class="col-md-7">: <strong> Metered {{ $consumer_info->consumer_type['TYPE_OF_CUSTOMER'] }} {{ date('M\'y', strtotime($bill_details->From_Dt)) }} </strong></div>

				</div>
			</div>

			<div class="row" style="margin-top:20px;">
				<table class="table">
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

			<div class="row" style="margin-top:20px;">
				<p> Average consumption of last six months (In case of domestic consumers) </p>
				<strong>Minimum Monthly Consumption : {{ $meter_reading_data->MIN_QTY }} SCUM</strong>
			</div>

			<div class="row" style="margin-top:20px;">
				<table class="table tax-table">
					<tr>
						<td>Gas Price @&#8377; {{ $montly_billing->GAS_PRICE }}</td>
						<td> {{ $bill_details->Demand_GS }}</td>
					</tr>
					<tr>
						<td>Roaylity @ {{ $montly_billing->ROYALTY }}</td>
						<td> {{ $bill_details->Demand_Royalty }}
					</tr>
					<tr>
						<td>Marketing Margin @&#8377; {{ $montly_billing->MM }} </td>
						<td> {{ $bill_details->Demand_MM }}
					</tr>
					<tr>
						<td>Handling Charges @&#8377; {{ $montly_billing->HC }} </td>
						<td> {{ $bill_details->Demand_HC }}
					</tr>
					<tr>
						<td>VAT @ {{ $montly_billing->VAT }}</td>
						<td> {{ $bill_details->Demand_Tax }}
					</tr>

					<tr>
						<th> Total Gas Sales</th>
						<th> {{ $bill_details->Demand_GS+$bill_details->Demand_Royalty+$bill_details->Demand_MM+$bill_details->Demand_HC+$bill_details->Demand_Tax}} </th>
					</tr>

					<tr>
						<td>TC @ {{ $montly_billing->TC }}</td>
						<td> {{ $bill_details->Demand_TC }}
					</tr>

					<tr>
						<td>Service Tax @ {{ $montly_billing->ST }}</td>
						<td> {{ $bill_details->Demand_Service_Tax }}</td>
					</tr>

					<tr>
						<th>Total TC</th>
						<th> {{ $bill_details->Demand_TC + $bill_details->Demand_Service_Tax }} </th>
					</tr>
				</table>
			</div>
		</div>
		@endif
    </div>
</div>

@stop