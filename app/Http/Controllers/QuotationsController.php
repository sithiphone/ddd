<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotation;
use App\Quotation;
use App\Quotationdetail;
use App\Rate;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->button == 'SEARCH' and $request->code != '' and $request->customer_name == null and $request->from_date == null and $request->to_date == null){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('quotations.code', '=', $request->code)
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->customer_name != '' and $request->from_date == null and $request->to_date == null){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('customers.name', 'like', '%' . $request->customer_name . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->from_date != '' and $request->to_date != ''){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('quotations.created_at', '>=', $request->from_date)
                ->where('quotations.created_at', '<=', $request->to_date)
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }else{
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        $totals = Quotation::all()->count();
        return view('quotations.index', compact('quotations', 'totals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customer_name = $request->cus_name;
        $customer_id = $request->cus_id;
        $units = DB::table('units')->select('id', 'unit_lao', 'unit_eng')->get();
        session(['customer_name' => $customer_name]);
        session(['customer_id' => $customer_id]);

        return view('quotations.create', compact('units'));
    }

    public function selectCustomer(Request $request){
        //return $request->all();
        if($request->button == 'SEARCH' and $request->customer_mobile != ''){
            $customers = DB::table('customers')
                ->select('id', 'name', 'mobile1', 'mobile2', 'email')
                ->where('mobile1', '=', $request->customer_mobile)
                ->orWhere('mobile2', '=', $request->customer_mobile)
            ->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->customer_name != ''){
            $customers = DB::table('customers')
                ->select('id', 'name', 'mobile1', 'mobile2', 'email')
                ->where('name', 'like', '%' . $request->customer_name . '%')
                ->paginate(10);
        }else{
            $customers = DB::table('customers')
                ->select('id', 'name', 'mobile1', 'mobile2', 'email')->paginate(10);
        }

        return view('quotations.selectCustomer', compact('customers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        if($request->button == 'SEARCH' and $request->product != '' and $request->amount != '' and $request->price != ''){
            $request->session()->push('quotations.list', [
                'product' => $request->product,
                'descript' => $request->descript,
                'amount' => $request->amount,
                'price' => $request->price,
                'unit' => $request->unit,
            ]);
        }
        if(isset($request->del_item) and $request->del_item != ''){
            $quotations = session('quotations.list');
            foreach($quotations as $key => $val){
                if($key == $request->del_item){
                    unset($quotations[$key]);
                }
            }
            session(['quotations.list' => $quotations]);
        }
        $units = DB::table('units')->select('id', 'unit_lao', 'unit_eng')->get();
        return view('quotations.create', compact('units'));
    }

    public function save(Request $request){
        //return $request->all();
        //check if not yet select customer
        if(null === session('customer_id')){
            return redirect(route('quotations.customer'));
        }

        if(isset($request->button) and $request->button == 'save'){
            DB::transaction(function () use ($request){
                $rs = DB::table('quotations')->select('id')->orderBy('id', 'DESC')->first();
                $quotation_id = $rs->id + 1;
                $quotation_code = 'Q' . $quotation_id;
                if($request->tax == 1){
                    $tax = $request->tax;
                }else{
                    $tax = 0;
                }
                DB::table('quotations')->insert(
                    ['code' => $quotation_code,
                        'customer_id' => session('customer_id'),
                        'user_id' => Auth::user()->id,
                        'tax' => $tax,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()]
                );
                $quotations = session('quotations.list');
                foreach ($quotations as $val){
                    if($val['descript'] == ''){
                        $val['descript'] = null;
                    }
                    DB::table('quotationdetails')->insert(
                        ['item' => $val['product'],
                            'amount' => $val['amount'],
                            'descript' => $val['descript'],
                            'price' => $val['price'],
                            'unit' => $val['unit'],
                            'quotation_id' => $quotation_id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()]
                    );
                }
            });
        }
        $request->session()->forget('customer_id');
        $request->session()->forget('customer_name');
        $request->session()->forget('quotations.list');
        return redirect()->route('quotations.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation = DB::table('customers')
        ->rightjoin('quotations', 'quotations.customer_id', '=', 'customers.id')
        ->leftjoin('users', 'quotations.user_id', '=', 'users.id')
        ->select('quotations.id', 'quotations.code as quo_code', 'quotations.customer_id', 'customers.name as customer_name',
            'customers.mobile1', 'customers.mobile2', 'customers.email',
            'quotations.user_id', 'users.name as username', 'quotations.created_at', 'quotations.updated_at', 'quotations.tax')
        ->where('quotations.id', '=', $id)->get();
        //return $quotation;
        $quotations = Quotationdetail::where('quotation_id', $id)->get();
        $rates = Rate::first();
        return view('quotations.quotationview', compact('quotation', 'quotations', 'rates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = DB::table('quotations')
            ->leftjoin('customers', 'customers.id', '=', 'quotations.customer_id')
            ->select(
                'quotations.id', 'quotations.code', 'quotations.created_at', 'customers.name as customer_name', 'quotations.tax',
                'customers.mobile1', 'customers.mobile2'
            )
            ->where('quotations.id', '=', $id)->get();
        $quotation = $quotation[0];
        $quotations = DB::table('quotationdetails')
            ->select('*')
            ->where('quotation_id', '=', $id)
            ->get();
        $rates = Rate::first();
        $units = DB::table('units')->select('id', 'unit_lao', 'unit_eng')->get();
        return view('quotations.editquotation', compact('quotation', 'quotations', 'rates', 'units'));
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
        //return $request->all();
        $elements = count($request->item);
        for($i = 0; $i < $elements; $i++){
            DB::table('quotationdetails')
                ->where('id', '=', $request->item_id[$i])
                ->update([
                    'item' => $request->item[$i],
                    'amount' => $request->amount[$i],
                    'descript' => $request->descript[$i],
                    'price' => $request->price[$i],
                    'unit' => $request->unit[$i],
                    'updated_at' => Carbon::now(),
                ]);
        }
        DB::table('quotations')
            ->where('id', '=', $id)
            ->update(['tax' => $request->tax[0]]);
        return redirect(route('quotations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('quotationdetails')
            ->where('quotation_id', '=', $id)
            ->delete();
        DB::table('quotations')
            ->where('id', '=', $id)
            ->delete();
        return redirect(route('quotations.index'));
    }

    public function printPreview(Request $request){
        $id = $request->id;
        $quotation = DB::table('customers')
            ->rightjoin('quotations', 'quotations.customer_id', '=', 'customers.id')
            ->leftjoin('users', 'quotations.user_id', '=', 'users.id')
            ->select('quotations.id', 'quotations.code as quo_code', 'quotations.customer_id', 'customers.name as customer_name',
                'customers.mobile1', 'customers.mobile2', 'customers.email',
                'quotations.user_id', 'users.name as username', 'quotations.created_at', 'quotations.updated_at', 'quotations.tax')
            ->where('quotations.id', '=', $id)->get();
        //return $quotation;
        $quotations = Quotationdetail::where('quotation_id', $id)->get();
        $rates = Rate::first();
        return view('quotations.printpreview', compact('quotation', 'quotations', 'rates'));
    }
}
