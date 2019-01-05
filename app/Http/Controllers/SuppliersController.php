<?php

namespace App\Http\Controllers;

use App\Buy;
use Illuminate\Http\Request;
use App\Supplier;
use Carbon\Carbon;
use DB;
use App\Http\Requests\SupplierRequest;
class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->code != '' and $request->command == 'ROLLBACK_BUY'){
            DB::table('buys')->where('code', '=', $request->code)->delete();
        }

        if($request->searchtext != ''){
            $suppliers = DB::table('suppliers')->where('name', 'like', '%' . $request->searchtext . '%')->paginate(30);
        }else{
            $suppliers = Supplier::orderBy('id', 'DESC')->paginate(10);
        }
        return view('suppliers.index', compact('suppliers'))->with('i', ($request->input('page', 1) -1 ) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile1' => 'required',
        ]);
        //return $request->all();
        DB::table('suppliers')->insert(['name' => $request->name,
            'mobile1' => $request->mobile1,
            'mobile2' => $request->mobile2,
            'email' => $request->email,
            'address' => $request->address,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]);
        return redirect()->route('suppliers.index')->with('success', 'ຜູ້ສະໜອງຖືກສ້າງສຳເລັດແລ້ວ');
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
        $supplier = Supplier::find($id);
        return view('suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->mobile1 = $request->mobile1;
        $supplier->mobile2 = $request->mobile2;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();
        return redirect()->route('suppliers.index')->with('success','ແກ້ໄຂຜູ້ສະໜອງສຳເລັດ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return redirect()->route('suppliers.index')->with('success','ລຶບຜູ້ສະໜອງແລ້ວ');
    }
}
