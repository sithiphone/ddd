<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
class ReportSaleController extends Controller
{
    public function index(Request $request){
        $bill_no = $request->bill_no;
        $customer_name = $request->customer_name;
        $user_id = $request->user;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $users = User::all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->bill_no != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('bills.id', '=', $request->bill_no)
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->customer_name != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('customers.name', 'like', '%'. $request->customer_name . '%')
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user != '*'){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('users.id', '=', $request->user)
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->start_date != '' and $request->end_date != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('bills.created_at', '>=', $request->start_date)
                ->where('bills.created_at', '<=', $request->end_date)
                ->orderBy('bills.id', 'DESC')->get();
        }else{

            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->orderBy('bills.id', 'DESC')->get();
        }

        if($request->button == 'FILTER' or $request->button == null){
            return view('reports.sales.index', compact('sales', 'users', 'bill_no', 'customer_name', 'user_id', 'start_date', 'end_date'));
        }elseif($request->button == 'PRINT'){
            if($user_id != ''){
                $user = User::find($user_id);
                $user_name = $user['name'];
            }
            return view('reports.sales.print', compact('sales', 'users', 'bill_no', 'customer_name', 'user_id','user_name', 'start_date', 'end_date'));
        }
    }

    public function printpreview(Request $request){
        $bill_no = $request->bill_no;
        $customer_name = $request->customer_name;
        $user_id = $request->user;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $users = User::all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->bill_no != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('bills.id', '=', $request->bill_no)
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->customer_name != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('customers.name', 'like', '%'. $request->customer_name . '%')
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user != '*'){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('users.id', '=', $request->user)
                ->orderBy('bills.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->start_date != '' and $request->end_date != ''){
            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->where('bills.created_at', '>=', $request->start_date)
                ->where('bills.created_at', '<=', $request->end_date)
                ->orderBy('bills.id', 'DESC')->get();
        }else{

            $sales = DB::table('products')
                ->rightjoin('orders', 'orders.product_id', '=', 'products.id')
                ->leftjoin('bills', 'bills.id', '=', 'orders.bill_id')
                ->leftjoin('rates', 'bills.rate_id', '=', 'rates.id')
                ->leftjoin('users', 'users.id', '=', 'bills.user_id')
                ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
                ->select('bills.id as id',
                    'bills.created_at',
                    'customers.name as customer_name',
                    'customers.mobile1 as mobile1',
                    'customers.mobile2 as mobile2',
                    'products.name as product_name',
                    'users.name as user_name',
                    'rates.bath as rate_bath',
                    'rates.dolar as rate_dolar',
                    'rates.erro as rate_erro',
                    'bills.bill_rate as bill_rate',
                    'orders.amount',
                    'orders.order_price as price')
                ->orderBy('bills.id', 'DESC')->get();
        }
            $user_name = '';
            if($user_id != ''){
                $user = User::find($user_id);
                $user_name = $user['name'];
            }
            return view('reports.sales.printpreview', compact('sales', 'users', 'bill_no', 'customer_name', 'user_id', 'user_name', 'start_date', 'end_date'));
    }
}
