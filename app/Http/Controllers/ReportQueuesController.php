<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportQueuesController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request){
        //return $request->all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->bill_no != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('bills.id', '=', $request->bill_no)
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->customer_name != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('customers.name', 'like', '%' . $request->customer_name . '%')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user_name != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('users.name', 'like', '%' . $request->user_name . '%')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }else{
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }

        $bill_no = ''; $customer_name = ''; $user_name = '';
        if($request->bill_no != ''){
            $bill_no = $request->bill_no;
        }
        if($request->customer_name != ''){
            $customer_name = $request->customer_name;
        }
        if($request->user_name != ''){
            $user_name = $request->user_name;
        }

        //return $incomes;
        if($request->button == 'FILTER' or $request->button == null){
            return view('reports.queues.index', compact('queues', 'bill_no', 'customer_name', 'user_name'));
        }elseif($request->button == 'PRINT'){
            return view('reports.queues.print', compact('queues', 'bill_no', 'customer_name', 'user_name'));
        }
    }

    public function printpreview(Request $request){
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->bill_no != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('bills.id', '=', $request->bill_no)
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->customer_name != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('customers.name', 'like', '%' . $request->customer_name . '%')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user_name != ''){
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->where('users.name', 'like', '%' . $request->user_name . '%')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }else{
            $queues = DB::table('users')
                ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
                ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
                ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
                ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                    'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
                ->where('bill_statuses.id', '=', '1')
                ->orderBy('bills.queue','ASC')
                ->orderBy('bills.created_at')
                ->get();
        }

        $bill_no = ''; $customer_name = ''; $user_name = '';
        if($request->bill_no != ''){
            $bill_no = $request->bill_no;
        }
        if($request->customer_name != ''){
            $customer_name = $request->customer_name;
        }
        if($request->user_name != ''){
            $user_name = $request->user_name;
        }

        //return $incomes;

        return view('reports.queues.printpreview', compact('queues', 'bill_no', 'customer_name', 'user_name'));

    }
}
