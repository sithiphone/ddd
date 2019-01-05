<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //return $request->all();
        //return $request->session()->all();
        //product_id in Wide new category
        $rs = DB::table('products')
            ->select('id')->where('category_id', '=', 1)->get();
        $products = array();
        foreach ($rs as $item){
            array_push($products, $item->id);
        }


        $rate = 1;
        if($request->curency == 'bath'){
            $rs = DB::table('rates')->select('bath')->first();
            $rate = $rs->bath;
        }elseif ($request->curency == 'dolar'){
            $rs = DB::table('rates')->select('dolar')->first();
            $rate = $rs->dolar;
        }elseif ($request->curency == 'erro'){
            $rs = DB::table('rates')->select('erro')->first();
            $rate = $rs->erro;
        }

        $rates = DB::table('rates')->first();
        //return response()->json($rates);
        $cus_orders = Session::get('order.items');
        //return $cus_orders;
        $bill = DB::table('bills')->select('id')->orderBy('id', 'DESC')->first();
        $last_bill = $bill->id + 1;

        session(['curency' => $request->curency]);

        //Create next queue
        $queues = DB::table('bills')
            ->leftjoin('bill_statuses', 'bill_statuses.id', '=', 'bills.status_id')
            ->select('bills.queue')
            ->where('bill_statuses.id', '=', '1')
            ->orderBy('bills.queue','DESC')
            ->first();
        $next_queue = $queues->queue + 1;
        if($request->tax == 1){
            $tax = $request->tax;
        }else{
            $tax = 0;
        }
        if($request->deposit == null ){
            $deposit = 0;
        }else{
            $deposit = $request->deposit;
        }
        DB::transaction(function () use ($request, $rate, $next_queue, $last_bill, $tax, $deposit){
            DB::table('bills')->insert([
                'id' => $last_bill,
                'bill_rate' => $rate,
                'user_id' => Auth::user()->id,
                'customer_id' => session('customerId'),
                'rate_id' => 1,
                'status_id' => 1,
                'queue' => $next_queue,
                'deposit' => $deposit,
                'tax' => $tax,
                'ship_place' => $request->ship_place,
                'warranty' => $request->warranty,
                'ship_date' => $request->ship_date,
                'pay_date' => $request->pay_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach(session('order.items') as $item){
                DB::table('orders')->insert([
                    'id' => null,
                    'amount' => $item['amount'],
                    'order_price' => $item['product_price'],
                    'product_id' => $item['product_id'],
                    'bill_id' => $last_bill,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        });

        //clear session data
        $request->session()->forget('order.items');
        $request->session()->forget('customerName');
        $request->session()->forget('customerMobile1');
        $request->session()->forget('customerMobile2');
        $request->session()->forget('customerId');
        $request->session()->forget('curency');

        return redirect(route('view.billing', ['bill_id'=> $last_bill]));
        //return view('orders.create', compact('last_bill', 'rate', 'rates', 'products'));
    }

public function printPreview(Request $request){
    $rate = 1;
    session(['curency' => $request->curency]);

    if($request->curency == 'bath'){
        $rs = DB::table('rates')->select('bath')->first();
        $rate = $rs->bath;
    }elseif ($request->curency == 'dolar'){
        $rs = DB::table('rates')->select('dolar')->first();
        $rate = $rs->dolar;
    }elseif ($request->curency == 'erro'){
        $rs = DB::table('rates')->select('erro')->first();
        $rate = $rs->erro;
    }
    $rates = DB::table('rates')->first();
    //return response()->json($rates);
    $cus_orders = Session::get('order.items');
    //return $cus_orders;
    $bill = DB::table('bills')->select('id')->orderBy('id', 'DESC')->first();
    $last_bill = $bill->id + 1;

    //product_id in Wide new category
    $rs = DB::table('products')
        ->select('id')->where('category_id', '=', 1)->get();
    $products = array();
    foreach ($rs as $item){
        array_push($products, $item->id);
    }
    return view('orders.printpreview', compact('last_bill', 'rate', 'rates', 'products'));
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
