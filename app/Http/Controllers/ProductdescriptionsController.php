<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class ProductdescriptionsController extends Controller
{
    public function index(Request $request){
        $rs = DB::table('productdescriptions')->select('id', 'description', 'photo')
            ->where('order_id', '=', $request->order_id)->get();
        $desc = $rs[0];

        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        $rs = DB::table('orders')
        ->leftjoin('products', 'products.id', '=', 'orders.product_id')
        ->select('products.name')->where('orders.id', '=', $request->order_id)->get();
        $name = $rs[0]->name;
        $order_id = $request->order_id;
        return view('queues.productspec', compact('desc','order_id', 'bill', 'name'));
    }

    public function finish(Request $request){
        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        $rs = DB::table('orders')
            ->leftjoin('products', 'products.id', '=', 'orders.product_id')
            ->select('products.name', 'orders.finishphoto')->where('orders.id', '=', $request->order_id)->get();
        $order = $rs[0];
        $order_id = $request->order_id;
        return view('queues.productfinish', compact('order_id', 'bill', 'order'));
    }
    public function showForm(Request $request){
        $order_id = $request->id;
        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        $name = $request->name;
        return view('queues.formproductdescript', compact('order_id', 'bill', 'name'));
    }
    public function showFormFinish(Request $request){
        $order_id = $request->id;
        $bill = DB::table('bills')
            ->leftjoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->select('bills.id as bill_id', 'bills.created_at', 'customers.name as customer_name')
            ->where('bills.id', '=', $request->bill_id)
            ->get();
        $name = $request->name;
        return view('queues.formproductdescriptfinish', compact('order_id', 'bill', 'name'));
    }

    public function store(Request $request)
    {
        //return $request->all();
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            if ($request->file->storeAs('public/photos/specs', $filename)) {
                //add product description
                if (DB::table('productdescriptions')
                    ->insert([
                        'id' => null,
                        'description' => $request->product_desc,
                        'photo' => $filename,
                        'order_id' => $request->order_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ])) {
                    //update bill status
                    DB::table('orders')
                        ->where('id', '=', $request->order_id)
                        ->update([
                        'status' => 1,
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }else{ // if no photo upload
            if (DB::table('productdescriptions')
                ->insert([
                    'id' => null,
                    'description' => $request->product_desc,
                    'order_id' => $request->order_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])) {
                //update bill status
                DB::table('orders')
                    ->where('id', '=', $request->order_id)
                    ->update([
                        'status' => 1,
                        'updated_at' => Carbon::now(),
                    ]);
            }
        }
        return redirect(route('show.product.desc', ['order_id' => $request->order_id, 'bill_id'=>$request->bill_id]));
    }
    public function storefinishphoto(Request $request)
    {
        //return $request->all();
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            if ($request->file->storeAs('public/photos/finishphotos', $filename)) {
                //update bill status
                DB::table('orders')
                    ->where('id', '=', $request->order_id)
                    ->update([
                        'finishstatus' => 1,
                        'finishphoto' => $filename,
                        'updated_at' => Carbon::now(),
                    ]);
            }
        }
        return redirect(route('show.product.desc.finish', ['order_id' => $request->order_id, 'bill_id'=>$request->bill_id]));
    }

    public function edit(Request $request){
        //return $request->all();
        $rs = DB::table('productdescriptions')
            ->select('id', 'description', 'photo')
            ->where('id', '=', $request->desc_id)->get();
        $desc = $rs[0];
        $bill_id = $request->bill_id;
        $customer_name = $request->customer_name;
        $product_name = $request->product_name;
        $order_id = $request->order_id;
        return view('queues.formeditdesc', compact('desc', 'order_id', 'bill_id', 'customer_name', 'product_name'));
    }

    public function editfinishphoto(Request $request){
        //return $request->all();
        $rs = DB::table('orders')
            ->select('id', 'finishphoto')
            ->where('id', '=', $request->order_id)->get();
        $order = $rs[0];
        $bill_id = $request->bill_id;
        $customer_name = $request->customer_name;
        $product_name = $request->product_name;
        $order_id = $request->order_id;
        return view('queues.formeditfinishphoto', compact('order', 'order_id', 'bill_id', 'customer_name', 'product_name'));
    }
    public function update(Request $request){
        //return $request->all();
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            if ($request->file->storeAs('public/photos/specs', $filename)) {
                DB::table('productdescriptions')
                    ->where('id', '=', $request->desc_id)
                    ->update([
                        'description' => $request->product_desc,
                        'photo' => $filename
                    ]);
            }
        }else{
            DB::table('productdescriptions')
                ->where('id', '=', $request->desc_id)
                ->update([
                    'description' => $request->product_desc
                ]);
        }
        $bill_id = $request->bill_id;
        $order_id = $request->order_id;
            return redirect(route('show.product.desc', ['bill_id'=>$bill_id, 'order_id'=>$order_id]));
    }

    public function updatefinishphoto(Request $request){
        //return $request->all();
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            if ($request->file->storeAs('public/photos/finishphotos', $filename)) {
                DB::table('orders')
                    ->where('id', '=', $request->order_id)
                    ->update([
                        'finishphoto' => $filename
                    ]);
            }
        }
        $bill_id = $request->bill_id;
        $order_id = $request->order_id;
        return redirect(route('show.product.desc.finish', ['bill_id'=>$bill_id, 'order_id'=>$order_id]));
    }
}
