<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Order;
use Illuminate\Http\Request;
use DB;

class QueuesController extends Controller
{
    public function index(Request $request){
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

        $total_queue = count($queues);
        return view('queues.index', compact('queues', 'total_queue'));
    }

    public function finish(Request $request){
        $finishs = DB::table('users')
            ->rightjoin('bills', 'bills.user_id', '=', 'users.id')
            ->leftjoin('customers', 'bills.customer_id', '=', 'customers.id')
            ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
            ->select('bills.created_at', 'bills.id as bill_id', 'customers.name as customer_name',
                'bills.queue', 'users.name as user_name', 'bill_statuses.status as status')
            ->where('bill_statuses.id', '=', '3')
            ->orderBy('bills.id','DESC')
            ->orderBy('bills.created_at')
            ->paginate(20);
        return view('queues.finish', compact('finishs'));
    }
    public function complete(Request $request){
        //return $bill->all();
        DB::transaction(function () use ($request){
            //set current complete
            $bill = Bill::find($request->bill_id);
            $bill->queue = 0;
            $bill->status_id = 3;
            $bill->save();

            $rs = DB::table('bills')
            ->select('queue')
            ->where('status_id', '=', 1)
            ->orderBy('queue', 'DESC')->first();
            $last_queue = $rs->queue;
            $start = $request->queue + 1;
            // update queue for other lower
            for($i = $start; $i <= $last_queue; $i++){
                DB::table('bills')->where('queue', $i)->update(['queue'=> ($i - 1)]);
            }
        });
        return redirect(route('queues.index'));
    }
    public function up(Request $request){
        DB::transaction(function () use($request){
            $current_bill_id = $request->bill_id;
            $current_queue = $request->queue;
            $uper_queue = $current_queue - 1;
            $rs = DB::table('bills')->select('id as bill_id', 'queue')->where('queue', '=', $uper_queue)->get();
            $uper_bill_id = $rs[0]->bill_id;
            //swap queue
            DB::table('bills')->where('id', '=', $current_bill_id)->update(['queue' => $uper_queue]);
            DB::table('bills')->where('id', '=', $uper_bill_id)->update(['queue' => $current_queue]);
        });
        return redirect(route('queues.index'));
    }

    public function down(Request $request){
        DB::transaction(function () use($request){
            $current_bill_id = $request->bill_id;
            $current_queue = $request->queue;
            $lower_queue = $current_queue + 1;
            $rs = DB::table('bills')->select('id as bill_id', 'queue')->where('queue', '=', $lower_queue)->get();
            $lower_bill_id = $rs[0]->bill_id;
            //swap queue
            DB::table('bills')->where('id', '=', $current_bill_id)->update(['queue' => $lower_queue]);
            DB::table('bills')->where('id', '=', $lower_bill_id)->update(['queue' => $current_queue]);
        });

        return redirect(route('queues.index'));
    }

    public function showProductDesc(Request $request){
        //return $request->all();
        $orders = DB::table('orders')
            ->leftjoin('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.id', 'orders.amount', 'products.name', 'orders.bill_id', 'orders.status')
            ->where('orders.bill_id', '=', $request->bill_id)->get();
        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        return view('queues.productdesc', compact('bill', 'orders'));
    }

    public function showProductDescFinish(Request $request){
        //return $request->all();
        $orders = DB::table('orders')
            ->leftjoin('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.id', 'orders.amount', 'products.name', 'orders.bill_id', 'orders.finishstatus')
            ->where('orders.bill_id', '=', $request->bill_id)->get();
        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        return view('queues.productdescfinish', compact('bill', 'orders'));
    }
}
