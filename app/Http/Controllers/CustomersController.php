<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CustomerRequest;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->searchtext != ''){
            $customers = DB::table('customers')->where('name', 'like' ,'%' . $request->searchtext . '%')->orderBy('id', 'DESC')->paginate(10);
        }else{
            $customers = Customer::orderBy('id', 'DESC')->paginate(10);
        }
        $customer_name = $request->searchtext;
        return view('customers.index', compact('customers', 'customer_name'));
    }

    public function sale(Request $request)
    {
        //clear session data
        $request->session()->forget('order.items');
        $request->session()->forget('customerName');
        $request->session()->forget('customerMobile1');
        $request->session()->forget('customerMobile2');
        $request->session()->forget('customerId');
        $request->session()->forget('curency');

        //return $request->all();
        if($request->button == 'SEARCH' and $request->searchtext != ''){
            $customers = DB::table('customers')
                ->where('name', 'like' ,'%' . $request->searchtext . '%')
                ->orderBy('id', 'DESC')->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->mobile != ''){
            $customers = DB::table('customers')
                ->where('mobile1', 'like' ,'%' . $request->mobile . '%')
                ->orWhere('mobile2', 'like', '%' . $request->mobile . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }elseif($request->button == 'SEARCH' and $request->email != ''){
            $customers = DB::table('customers')
                ->where('email', 'like' ,'%' . $request->email . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }else{
            $customers = Customer::orderBy('id', 'DESC')->paginate(10);
        }

        $searchtext = $request->searchtext;
        $mobile = $request->mobile;
        $email = $request->email;

        return view('customers.sale', compact('customers', 'searchtext', 'mobile', 'email'));
    }

    public function writebill($cus_id){
        $customer = Customer::findOrFail($cus_id);
//        return $customer;
        return view('customers.madebill', compact('customer'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = DB::table('customers')->latest('id')->first();
        $new_code = $customer->id + 1;
        $new_code = "C" . $new_code;

        return view('customers.create', compact('new_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        DB::table('customers')->insertGetId(
            ['code' => $request->code,
                'name' => $request->name,
                'mobile1' => $request->mobile1,
                'mobile2' => $request->mobile2,
                'email' => $request->email
            ]);
        return redirect('/customers');
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
        $customer = Customer::find($id);
        return view('customers.update', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->mobile1 = $request->mobile1;
        $customer->mobile2 = $request->mobile2;
        $customer->email = $request->email;
        $customer->save();

        return redirect('/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('customers.index');
    }
}
