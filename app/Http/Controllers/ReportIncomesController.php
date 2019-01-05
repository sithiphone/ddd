<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bill_status;

class ReportIncomesController extends Controller
{
    public function index(Request $request){
        //return $request->all();
        if($request->from_date !== null or $request->to_date !== null){
            $incomes = DB::table('bill_statuses')
                ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                ->select(
                    'bills.id as bill_id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    DB::raw("SUM(orders.order_price) as total"),
                    'bill_statuses.status'
                )->where('bills.created_at', '>=', $request->from_date)
                ->where('bills.created_at', '<=', $request->to_date)
                ->whereNotNull('orders.order_price')
                ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            $madebills =  DB::table('bill_statuses')
                ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                ->select(
                    'bills.id as bill_id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    DB::raw("SUM(madeorders.price) as total"),
                    'bill_statuses.status'
                )->where('bills.created_at', '>=', $request->from_date)
                ->where('bills.created_at', '<=', $request->to_date)
                ->whereNotNull('madeorders.price')
                ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
        }else{
            if($request->on == 1){  //income today
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereDate('bills.created_at', DB::raw('CURDATE()'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereDate('bills.created_at', DB::raw('CURDATE()'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }elseif($request->on == 2){ // income this month
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereMonth('bills.created_at', date('m'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereMonth('bills.created_at', date('m'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }elseif($request->on == 3){ // income this year
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereYear('bills.created_at', date('Y'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereYear('bills.created_at', date('Y'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

            }elseif($request->sel_status != '*'){ // select bill status
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->where('bills.status_id', '=', $request->sel_status)
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

                $madebills =  DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->where('bills.status_id', '=', $request->sel_status)
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }else{
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->groupBy('bills.id')
                    ->whereNotNull('orders.order_price')->orderBy('bills.id', 'DESC')->get();

                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->groupBy('bills.id')
                    ->whereNotNull('madeorders.price')->orderBy('bills.id', 'DESC')->get();
            }
        }

        $sel_on = $request->on;

        $from_date = '';
        $to_date = '';
        if($request->from_date !== null){
            $from_date = $request->from_date;
        }
        if($request->to_date !== null){
            $to_date = $request->to_date;
        }
        $sel_status = $request->sel_status;
        $billstatus = Bill_status::all();
        //return $incomes;
        if($request->button == 'FILTER' or $request->button == null){
            return view('reports.incomes.index', compact('incomes', 'madebills', 'sel_on', 'from_date', 'to_date', 'billstatus', 'sel_status'));
        }elseif($request->button == 'PRINT'){
            return view('reports.incomes.print', compact('incomes', 'madebills', 'sel_on', 'from_date', 'to_date', 'billstatus', 'sel_status'));
        }

    }

    public function printpreview(Request $request){
        //return $request->all();
        if($request->from_date !== null or $request->to_date !== null){
            $incomes = DB::table('bill_statuses')
                ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                ->select(
                    'bills.id as bill_id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    DB::raw("SUM(orders.order_price) as total"),
                    'bill_statuses.status'
                )->where('bills.created_at', '>=', $request->from_date)
                ->where('bills.created_at', '<=', $request->to_date)
                ->whereNotNull('orders.order_price')
                ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            $madebills =  DB::table('bill_statuses')
                ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                ->select(
                    'bills.id as bill_id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    DB::raw("SUM(madeorders.price) as total"),
                    'bill_statuses.status'
                )->where('bills.created_at', '>=', $request->from_date)
                ->where('bills.created_at', '<=', $request->to_date)
                ->whereNotNull('madeorders.price')
                ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
        }else{
            if($request->on == 1){  //income today
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereDate('bills.created_at', DB::raw('CURDATE()'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereDate('bills.created_at', DB::raw('CURDATE()'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }elseif($request->on == 2){ // income this month
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereMonth('bills.created_at', date('m'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereMonth('bills.created_at', date('m'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }elseif($request->on == 3){ // income this year
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->whereYear('bills.created_at', date('Y'))
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->whereYear('bills.created_at', date('Y'))
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

            }elseif($request->sel_status != '*'){ // select bill status
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->where('bills.status_id', '=', $request->sel_status)
                    ->whereNotNull('orders.order_price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();

                $madebills =  DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->where('bills.status_id', '=', $request->sel_status)
                    ->whereNotNull('madeorders.price')
                    ->groupBy('bills.id')->orderBy('bills.id', 'DESC')->get();
            }else{
                $incomes = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('orders', 'orders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(orders.order_price) as total"),
                        'bill_statuses.status'
                    )->groupBy('bills.id')
                    ->whereNotNull('orders.order_price')->orderBy('bills.id', 'DESC')->get();

                $madebills = DB::table('bill_statuses')
                    ->rightjoin('bills', 'bills.status_id', '=', 'bill_statuses.id')
                    ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                    ->leftjoin('madeorders', 'madeorders.bill_id', '=', 'bills.id')
                    ->select(
                        'bills.id as bill_id',
                        'bills.created_at',
                        'customers.name as customer_name',
                        DB::raw("SUM(madeorders.price) as total"),
                        'bill_statuses.status'
                    )->groupBy('bills.id')
                    ->whereNotNull('madeorders.price')->orderBy('bills.id', 'DESC')->get();
            }
        }

        $sel_on = $request->on;

        $from_date = '';
        $to_date = '';
        if($request->from_date !== null){
            $from_date = $request->from_date;
        }
        if($request->to_date !== null){
            $to_date = $request->to_date;
        }
        //return $incomes;
        return view('reports.incomes.printpreview', compact('incomes', 'madebills', 'sel_on', 'from_date', 'to_date'));
    }
}
