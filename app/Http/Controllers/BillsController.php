<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Categories;
use App\Madeorder;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rate;
use Illuminate\Support\Facades\Auth;
use App\Customer;
class BillsController extends Controller
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
        //$request->session()->forget('order.items');
        //return session('order.items');
        $rs = DB::table('products')
            ->select('id')->where('category_id', '=', 4)->get();
        $wn_product = array();
        foreach ($rs as $item){
            array_push($wn_product, $item->id);
        }

        if($request->product_id != '' and $request->amount != ''){
            $request->session()->push('order.items',
                ['product_id' => $request->product_id,
                'product_name' => $request->product_name ,
                'product_price' => $request->product_price,
                'amount' => $request->amount]);
        }

        if(isset($request->searchproduct) and $request->searchproduct != ''){
            $products = DB::table('products')
                ->where('name', 'like', '%'. $request->searchproduct . '%')
                ->paginate(50);
        }else{
            $products = Product::   paginate(5);
        }

         $customer =  Customer::find($request->customer_id);
         if($request->has('customer_id')){
             session(['customerName' => $customer->name]);
             session(['customerMobile1' => $customer->mobile1]);
             session(['customerMobile2' => $customer->mobile2]);
             session(['customerId' => $customer->id]);
         }

         //Remove items from session
        if(isset($request->del_item) and $request->del_item != ''){
            $orders = session('order.items');
            foreach($orders as $key => $val){
                if($key == $request->del_item){
                    unset($orders[$key]);
                }
            }
            session(['order.items' => $orders]);
        }elseif($request->clear_cart == 'yes'){
            $request->session()->forget('order.items');
        }
        $sel_cat = '';
        if(isset($request->sel_category) and $request->sel_category != '*'){
             $sel_cat = $request->sel_category;
            $products = DB::table('products')
                ->where('category_id', '=', $request->sel_category)
                ->paginate(50);
        }

        //categories for dropdown list
        $categories = Categories::all();
        $rate = Rate::first();
        return view('bills.create', compact('rate', 'products', 'categories', 'sel_cat', 'wn_product'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Rate
        $rate = 1;
        if($request->curency == 'bath'){
            $rate = DB::table('rates')->first()->bath;
        }elseif($request->curency == 'dolar'){
            $rate = DB::table('rates')->first()->dolar;
        }elseif($request->curency == 'erro'){
            $rate = DB::table('rates')->first()->erro;
        }
        //User id
        $user_id = Auth::id();
        $rate_id = 1;
        /*DB::table('bills')->insert([
            'bill_rate' => $rate,
            'customer_id' => $request->customer_id,
            'user_id' => $user_id,
            'rate_id' => $rate_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);
        $last_bill_id = DB::table('bills')->latest('id');
        */
        return view('orders.create', compact('last_bill_id'));
    }

    public function madeBill(Request $request){
//        return $request->all();
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

        DB::transaction(function () use ($request, $rate, $next_queue, $tax, $deposit){
            $bill = new Bill();
            $bill->bill_rate = $rate;
            $bill->user_id = Auth::user()->id;
            $bill->customer_id = $request->cus_id;
            $bill->rate_id = 1;
            $bill->status_id = 1;
            $bill->queue = $next_queue;
            $bill->deposit = $deposit;
            $bill->tax = $tax;
            $bill->ship_place = $request->ship_place;
            $bill->warranty = $request->warranty;
            $bill->ship_date = $request->ship_date;
            $bill->pay_date = $request->pay_date;
            $bill->manual = $request->bill_type;
            $bill->created_at = Carbon::now();
            $bill->updated_at = Carbon::now();
            $bill->save();

            if(count($request->product) > 0){
                foreach($request->product as $key => $val){
                    $madeorder = new Madeorder();
                    $madeorder->product = $val;
                    $madeorder->amount = $request->quantity[$key];
                    $madeorder->unit = $request->unit[$key];
                    $madeorder->price = $request->amount[$key];
                    $madeorder->status = 0;
                    $madeorder->bill_id = $bill->id;
                    $madeorder->created_at = Carbon::now();
                    $madeorder->updated_at = Carbon::now();
                    $madeorder->save();
                }
            }
        });

        $customer = Customer::findOrFail($request->cus_id);
        $bill = DB::table('bills')->select('*')->orderBy('id', 'DESC')->first();
        $bill_id = $bill->id;
        $date = $bill->created_at;
        $rate = $bill->bill_rate;
        $rates = Rate::findOrFail(1);
        $sales = Madeorder::where('bill_id', $bill_id)->get();
        return view('customers.viewbill', compact('customer', 'bill_id', 'date', 'sales', 'rate', 'bill', 'rates'));
    }

    public function madeorderPrintpreview($bill_id, $cus_id){
        $customer = Customer::findOrFail($cus_id);
        $bill = DB::table('bills')->select('*')->orderBy('id', 'DESC')->first();
        $date = $bill->created_at;
        $rate = $bill->bill_rate;
        $rates = Rate::findOrFail(1);
        $sales = Madeorder::where('bill_id', $bill_id)->get();

        return view('customers.printpreview', compact('customer', 'bill_id', 'date', 'sales', 'rate', 'bill', 'rates'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    public function deleteMadeorder($id){
        $madeorder = Madeorder::where('bill_id', $id)->delete();
            $bill = Bill::findOrFail($id);
            $bill->delete();
        return redirect('customersale');
    }

}
