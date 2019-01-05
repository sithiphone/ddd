<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Buydetail;
use App\Rate;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buys = DB::table('users')
            ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
            ->orderBy('buys.id', 'DESC')->paginate(10);
        return view('buys.index', compact('buys'));
    }

    public function ordersupplier(Request $request){
        if($request->searchtext != ''){
            $suppliers = DB::table('suppliers')->where('name', 'like', '%' . $request->searchtext . '%')->paginate(30);
        }else{
            $suppliers = Supplier::orderBy('id', 'DESC')->paginate(10);
        }
        return view('buys.ordersupplier', compact('suppliers'))->with('i', ($request->input('page', 1) -1 ) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if(isset($request->form_submited) and $request->form_submited == 'yes' and $request->name != '' and $request->amount != ''){
            $request->session()->push('buydetails',['item'=> $request->name, 'amount' => $request->amount]);
        }
        if(isset($request->del_item) and $request->del_item != ''){
            $buys = session('buydetails');
            foreach($buys as $key => $val){
                if($key == $request->del_item){
                    unset($buys[$key]);
                }
            }
            session(['buydetails' => $buys]);
        }
        return view('buys.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->button) and $request->button == 'save' or $request->button == 'saveprint'){
            DB::transaction(function (){
                $rs = DB::table('buys')->select('id')->orderBy('id', 'DESC')->first();
                $buy_id = $rs->id + 1;
                $buy_code = 'ORDER' . $buy_id;
                DB::table('buys')->insert(
                    ['code' => $buy_code,
                    'user_id' => session('user_id'),
                    'supplier_id' => session('supplier_id'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'status' => 0]
                );
                $buys = session('buydetails');
                foreach ($buys as $val){
                    DB::table('buydetails')->insert(
                        ['name' => $val['item'],
                        'amount' => $val['amount'],
                        'buy_id' => $buy_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()]
                    );
                }
            });
        }
        $request->session()->forget('supplier_id');
        $request->session()->forget('supplierName');
        $request->session()->forget('buydetails');
        if($request->button == 'save'){
            return redirect()->route('buys.index');
        }elseif($request->button == 'saveprint'){
            $rs = DB::table('buys')->select('id')->orderBy('id', 'DESC')->first();
            $buy_id = $rs->id;
            $buy = DB::table('users')
            ->rightjoin('buys', 'users.id', '=', 'buys.user_id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id', 'buys.code', 'users.name as user_name', 'suppliers.name as supplier_name', 'suppliers.mobile1', 'suppliers.mobile2')
            ->where('buys.id', '=', $buy_id)->get();
            $buydetails = Buydetail::all()->where('buy_id','=', $buy_id);
            return view('buys.print', compact('buy', 'buydetails', 'buy_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buy_id = $id;
        $buy = DB::table('users')
            ->rightjoin('buys', 'users.id', '=', 'buys.user_id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id',
                'buys.created_at',
                'buys.code',
                'users.name as user_name',
                'suppliers.name as supplier_name',
                'suppliers.mobile1',
                'suppliers.mobile2')
            ->where('buys.id', '=', $id)->get();
        $buydetails = Buydetail::all()->where('buy_id','=', $id);
        return view('buys.print', compact('buy', 'buydetails', 'buy_id'));
    }

    public function updatePrice($id){
        $buy_id = $id;
        $buy = DB::table('users')
            ->rightjoin('buys', 'users.id', '=', 'buys.user_id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id',
                'buys.created_at',
                'buys.status',
                'buys.code',
                'users.name as user_name',
                'suppliers.name as supplier_name',
                'suppliers.mobile1',
                'suppliers.mobile2')
            ->where('buys.id', '=', $id)->get();
        $buydetails = Buydetail::all()->where('buy_id','=', $id);
        return view('buys.updateprice', compact('buy', 'buydetails', 'buy_id'));
    }

    public function editPrice(Request $request){
        $amounts = $request->amount;
        $prices = $request->price;
        //return $request->all();
        $buydetails = Buydetail::all()->where('buy_id','=', $request->id);
        //return $buydetails;
        $i = 0;
        foreach($buydetails as $buy){
            $buydetail = Buydetail::find($buy->id);
            $buydetail->amount = $amounts[$i];
            $buydetail->price = $prices[$i];
            $buydetail->save();
            $i++;
        }
        if($request->status == 1){
            $buy = Buy::find($request->id);
            $buy->status = 1;
            $buy->save();
        }elseif($request->status == 0){
            $buy = Buy::find($request->id);
            $buy->status = 0;
            $buy->save();
        }
        $buys = DB::table('users')
            ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
            ->orderBy('buys.id', 'DESC')->paginate(10);
        return view('buys.index', compact('buys'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        session(['user_id'=> Auth::user()->id,
            'firstname' => Auth::user()->name,
            'supplier_id'=>  $id,
            'supplierName'=> $supplier->name]);
        return view('buys.edit');
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

    public function autocomplete(Request $request) {
        $data = DB::table('products')->select('name')->where('name', 'like', '%' . $request->name . '%')->get();
        return response()->json($data);
    }

    public function printpreview(Request $request){
        $buy = DB::table('users')
            ->rightjoin('buys', 'users.id', '=', 'buys.user_id')
            ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
            ->select('buys.id',
                'buys.created_at',
                'buys.code',
                'users.name as user_name',
                'suppliers.name as supplier_name',
                'suppliers.mobile1',
                'suppliers.mobile2')
            ->where('buys.id', '=', $request->buy_id)->get();
        $buydetails = Buydetail::all()->where('buy_id','=', $request->buy_id);
        return view('buys.printpreview', compact('buy', 'buydetails'));
    }
}
