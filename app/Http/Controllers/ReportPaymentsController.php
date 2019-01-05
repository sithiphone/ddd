<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportPaymentsController extends Controller
{
    public function index(Request $request){
        //return $request->all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->from_date !== null or $request->to_date !== null){
            $payments = DB::table('suppliers')
                ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                ->select(
                    'buys.id as buy_id',
                    'buys.created_at',
                    'users.name as user_name',
                    DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                )->where('buys.created_at', '>=', $request->from_date)
                ->where('buys.created_at', '<=', $request->to_date)
                ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
        }else{
            if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->on == 1){  //payment today
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereDate('buys.created_at', DB::raw('CURDATE()'))
                    ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->on == 2){ // payment this month
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereMonth('buys.created_at', date('m'))
                    ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->on == 3){ // payment this year
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereYear('buys.created_at', date('Y'))->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }else{
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
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
        if($request->button == 'FILTER' or $request->button == null){
            return view('reports.payments.index', compact('payments', 'sel_on', 'from_date', 'to_date'));
        }elseif($request->button == 'PRINT'){
            return view('reports.payments.print', compact('payments', 'sel_on', 'from_date', 'to_date'));
        }
    }

    public function printpreview(Request $request){
        if($request->from_date !== null or $request->to_date !== null){
            $payments = DB::table('suppliers')
                ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                ->select(
                    'buys.id as buy_id',
                    'buys.created_at',
                    'users.name as user_name',
                    DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                )->where('buys.created_at', '>=', $request->from_date)
                ->where('buys.created_at', '<=', $request->to_date)
                ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
        }else{
            if($request->on == 1){  //payment today
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereDate('buys.created_at', DB::raw('CURDATE()'))
                    ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }elseif($request->on == 2){ // payment this month
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereMonth('buys.created_at', date('m'))
                    ->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }elseif($request->on == 3){ // payment this year
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->whereYear('buys.created_at', date('Y'))->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
            }else{
                $payments = DB::table('suppliers')
                    ->rightjoin('buys', 'buys.supplier_id', '=', 'suppliers.id')
                    ->leftjoin('buydetails', 'buydetails.buy_id', '=', 'buys.id')
                    ->leftjoin('users', 'users.id', '=', 'buys.user_id')
                    ->select(
                        'buys.id as buy_id',
                        'buys.created_at',
                        'users.name as user_name',
                        DB::raw('SUM(buydetails.amount * buydetails.price) as payamount')
                    )->orderBy('buys.id', 'DESC')->groupBy('buys.id')->get();
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
        return view('reports.payments.printpreview', compact('payments', 'sel_on', 'from_date', 'to_date'));
    }
}
