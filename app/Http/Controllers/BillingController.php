<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Bill_status;
use App\Customer;
use App\Madeorder;
use App\Rate;
use Illuminate\Http\Request;
use DB;

class BillingController extends Controller
{
    //
    public function index(Request $request){
        $billstatus = Bill_status::all();
        //Change bill status
        if(isset($request->bill_id) and $request->bill_id != '' and $request->value != '' and $request->cmd == 'CHANGE_STATUS'){
            $bill = Bill::find($request->bill_id);
            $bill->status_id = $request->value;
            $bill->save();
        }
        $sel_status = $request->sel_status;
        if(isset($sel_status) and $sel_status != '*'){
            $bills = DB::table('bills')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.id', 'customers.name', 'bills.status_id as status', 'bills.deposit')
                ->where('bills.status_id', '=', $sel_status)
                ->orderBy('id', 'DESC')->paginate(20);
        }else{
            $bills = DB::table('bills')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.id', 'customers.name', 'bills.status_id as status', 'bills.deposit')
                ->orderBy('id', 'DESC')->paginate(20);
        }

        return view('billing.index', compact('billstatus', 'sel_status', 'bills'));
    }

    public function viewBill(Request $request){

        //return $request->all();

        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id',
                'customers.name as customer_name',
                'customers.mobile1', 'customers.mobile2',
                'bills.created_at',
                'bills.bill_rate',
                'bills.deposit',
                'bills.tax',
                'bills.ship_place',
                'bills.warranty',
                'bills.ship_date',
                'bills.customer_id',
                'pay_date',
                'manual')
            ->where('bills.id', '=', $request->bill_id)->get();
        $bill = $bill[0];
        //order detail
        $rate = $bill->bill_rate;

        if($bill->manual == 0){ //select product bill
            $sales = DB::table('orders')
                ->leftjoin('products', 'products.id', '=', 'orders.product_id')
                ->leftjoin('units', 'products.unit_id', '=', 'units.id')
                ->select('products.id as product_id',
                    'products.name as product_name',
                    'orders.amount',
                    'orders.order_price',
                    'units.unit_lao',
                    'units.unit_eng')
                ->where('orders.bill_id', '=', $bill->id)->get();
        } else {//made order bill
            $sales = DB::table('madeorders')
                ->select('id as product_id',
                    'product as product_name',
                    'amount',
                    'price as order_price',
                    'unit as unit_lao',
                    'unit as unit_eng')
                ->where('bill_id', '=', $bill->id)->get();
        }

        //product_id in Wide new category
        $rs = DB::table('products')
            ->select('id')->where('category_id', '=', 1)->get();
        $products = array();
        foreach ($rs as $item){
            array_push($products, $item->id);
        }
        $rates = DB::table('rates')->first();
//        return $bill->manual;
        if($bill->manual == 0) { //select product bill

            return view('billing.print', compact('bill', 'sales', 'rate', 'rates', 'products'));
        }else { //made order bill
            return view('billing.madeorder_print', compact('bill', 'sales', 'rate', 'rates', 'products'));
        }

    }
    public function madeorderPrintpreview($bill_id, $cus_id){
        $customer = Customer::findOrFail($cus_id);
        $bill = DB::table('bills')->select('*')->orderBy('id', 'DESC')->first();
        $date = $bill->created_at;
        $rate = $bill->bill_rate;
        $rates = Rate::findOrFail(1);
        $sales = Madeorder::where('bill_id', $bill_id)->get();

        return view('billing.madeorder_printpreview', compact('customer', 'bill_id', 'date', 'sales', 'rate', 'bill', 'rates'));
    }

    public function viewShipping(Request $request){

        //return $request->all();

        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id',
                'customers.name as customer_name',
                'customers.mobile1', 'customers.mobile2',
                'bills.created_at',
                'bills.bill_rate',
                'bills.deposit',
                'bills.tax',
                'bills.ship_place',
                'bills.warranty',
                'bills.ship_date',
                'pay_date')
            ->where('bills.id', '=', $request->bill_id)->get();
        $bill = $bill[0];
        //order detail
        $rate = $bill->bill_rate;

        $sales = DB::table('orders')
            ->leftjoin('products', 'products.id', '=', 'orders.product_id')
            ->leftjoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.id as product_id',
                'products.name as product_name',
                'orders.amount',
                'orders.order_price',
                'units.unit_lao',
                'units.unit_eng')
            ->where('orders.bill_id', '=', $bill->id)->get();
        //product_id in Wide new category
        $rs = DB::table('products')
            ->select('id')->where('category_id', '=', 4)->get();
        $products = array();
        foreach ($rs as $item){
            array_push($products, $item->id);
        }
        $rates = DB::table('rates')->first();
        return view('billing.printshipping', compact('bill', 'sales', 'rate', 'rates', 'products'));
    }

    public function printpreview(Request $request){
        //return $request->all();

        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id',
                'customers.name as customer_name',
                'customers.mobile1', 'customers.mobile2',
                'bills.created_at',
                'bills.bill_rate',
                'bills.deposit',
                'bills.tax',
                'bills.ship_place',
                'bills.warranty',
                'bills.ship_date',
                'pay_date')
            ->where('bills.id', '=', $request->bill_id)->get();
        $bill = $bill[0];
        //order detail
        $rate = $bill->bill_rate;

        $sales = DB::table('orders')
            ->leftjoin('products', 'products.id', '=', 'orders.product_id')
            ->leftjoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.id as product_id',
                'products.name as product_name',
                'orders.amount',
                'orders.order_price',
                'units.unit_lao',
                'units.unit_eng')
            ->where('orders.bill_id', '=', $bill->id)->get();
        //product_id in Wide new category
        $rs = DB::table('products')
            ->select('id')->where('category_id', '=', 1)->get();
        $products = array();
        foreach ($rs as $item){
            array_push($products, $item->id);
        }
        $rates = DB::table('rates')->first();
        return view('billing.printpreview', compact('bill', 'sales', 'rate', 'rates', 'products'));
    }
}
