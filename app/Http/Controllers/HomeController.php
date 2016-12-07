<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consumer, App\MeterReading, App\BillChild, App\Grid, App\MonthlyBilling;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $consumer_info = $this->consumer_info();
        return view('home', compact('consumer_info'));
    }



    public function view_bill(Request $request)
    {   
        $ym = $request->ym;
        $consumer_info = $this->consumer_info();

        //get the grid id
        $grid_arr = explode('-', $consumer_info->CONSUMER_NO);

        $grid_info          = $this->grid_info($grid_arr[0]);
        $bill_no            = $consumer_info->CONSUMER_NO.'/'.$ym;//date('ym');
        $meter_reading_data = $this->meter_reading($bill_no);
        $bill_details       = $this->bill_details($bill_no);
        $montly_billing     = $this->montly_billing('1101', $consumer_info->consumer_type['TYPE_OF_CUSTOMER']);
        return view('bills.view_bill', compact('consumer_info', 'meter_reading_data', 'bill_details', 'bill_no', 'grid_info', 'montly_billing'));
    }

    private function meter_reading( $bill_number = '') {
        //$bill_number = '025-002-01245/1101';
        if($bill_number != '') {
            return MeterReading::where('Bill_No', $bill_number)->select('PREV_READ', 'CURR_READ', 'PREV_READ_DT', 'CURR_READ_DT', 'CORRFACTOR', 'DIFF_READ', 'MIN_QTY')->first();
        }
        return false;
    }

    private function bill_details( $bill_number = '') {
        //$bill_number = '025-002-01245/1101';
        if($bill_number != '') {
            return BillChild::where('Bill_No', $bill_number)->select('Demand_GS', 'Demand_Royalty', 'Demand_MM', 'Demand_HC', 'Demand_Tax', 'Demand_Service_Tax', 'OUTSTANDING', 'LATE_FINE', 'ADJUSTMENTS', 'Bill_Date', 'From_Dt', 'To_Dt', 'payByDate', 'Demand_TC', 'LMC_DEMAND', 'SPECIAL_READING_DEMAND', 'METER_TEST_DEMAND', 'DAMAGE_METER_DEMAND')->first();
        }
        return false;
    }

    private function consumer_info() {
       return Consumer::where('CONSUMER_NO', Auth::guard('user')->user()->consumer_number)->select('FIRST_NAME', 'LAST_NAME', 'ADDRESS1', 'ADDRESS2', 'ADDRESS3', 'CONSUMER_NO', 'BALANCE', 'CONSTYPEID', 'METERNO')->with('consumer_type')->first();
    }

    private function grid_info($grid_id = null) {
        return Grid::where('GRID_ID', $grid_id)->select('GRID_NAME', 'ADDRESSLINE', 'ADDRESSLINE2', 'DISTRICT', 'PHONE', 'TIMING', 'BANK')->first();
    }

    private function montly_billing($mmyy = null, $type_of_customer = null) {
        return MonthlyBilling::where(['MMB_YYMM' => $mmyy, 'TYPE_OF_CUSTOMER' => $type_of_customer])->select('GAS_PRICE', 'ROYALTY', 'MM', 'HC', 'VAT', 'TC', 'ST')->first();
    }
}
