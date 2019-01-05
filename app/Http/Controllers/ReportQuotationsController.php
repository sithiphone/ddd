<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;

class ReportQuotationsController extends Controller
{
    public function index(Request $request){
        if($request->button == 'SEARCH' and $request->code != '' and $request->customer_name == null and $request->from_date == null and $request->to_date == null){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('quotations.code', '=', $request->code)
                ->orderBy('id', 'DESC')
                ->get();
        }elseif($request->button == 'SEARCH' and $request->customer_name != '' and $request->from_date == null and $request->to_date == null){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('customers.name', 'like', '%' . $request->customer_name . '%')
                ->orderBy('id', 'DESC')
                ->get();
        }elseif($request->button == 'SEARCH' and $request->from_date != '' and $request->to_date != ''){
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->where('quotations.created_at', '>=', $request->from_date)
                ->where('quotations.created_at', '<=', $request->to_date)
                ->orderBy('id', 'DESC')
                ->get();
        }else{
            $quotations = DB::table('quotations')
                ->join('customers', 'quotations.customer_id', '=', 'customers.id')
                ->select('quotations.id', 'quotations.code', 'customers.name', 'quotations.created_at', 'quotations.updated_at')
                ->orderBy('id', 'DESC')
                ->get();
        }

        $totals = Quotation::all()->count();
        return view('reports.quotations.index', compact('quotations', 'totals'));
    }
}
