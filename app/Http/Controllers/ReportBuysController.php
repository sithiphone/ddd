<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportBuysController extends Controller
{
    public function index(Request $request){
        //return $request->all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->code != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('buys.code', '=', $request->code)
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->supplier_name != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('suppliers.name', 'like', '%' . $request->supplier_name . '%')
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user_name != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('users.name', 'like', '%' . $request->user_name . '%')
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->status != '*'){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('buys.status', '=', $request->status)
                ->orderBy('buys.id', 'DESC')->get();
        }else{
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->orderBy('buys.id', 'DESC')->get();
        }
        $code = ''; $supplier_name = ''; $user_name = ''; $status = '';
        if($request->code != ''){
            $code = $request->code;
        }
        if($request->supplier_name != ''){
            $supplier_name = $request->supplier_name;
        }
        if($request->user_name != ''){
            $user_name = $request->user_name;
        }
        if($request->status != '*'){
            $status = $request->status;
        }

        //return $incomes;
        if($request->button == 'FILTER' or $request->button == null){
            return view('reports.buys.index', compact('buys', 'code', 'supplier_name', 'user_name', 'status'));
        }elseif($request->button == 'PRINT'){
            return view('reports.buys.print', compact('buys', 'code', 'supplier_name', 'user_name', 'status'));
        }
    }

    public function printpreview(Request $request){
        //return $request->all();
        if(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->code != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('buys.code', '=', $request->code)
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->supplier_name != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('suppliers.name', 'like', '%' . $request->supplier_name . '%')
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->user_name != ''){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('users.name', 'like', '%' . $request->user_name . '%')
                ->orderBy('buys.id', 'DESC')->get();
        }elseif(($request->button == 'FILTER' or $request->button == 'PRINT') and $request->status != '*'){
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->where('buys.status', '=', $request->status)
                ->orderBy('buys.id', 'DESC')->get();
        }else{
            $buys = DB::table('users')
                ->rightjoin('buys', 'buys.user_id', '=', 'users.id')
                ->leftjoin('suppliers', 'buys.supplier_id', '=', 'suppliers.id')
                ->select('buys.id', 'buys.code', 'users.name', 'suppliers.name as supplier_name', 'buys.status', 'buys.created_at')
                ->orderBy('buys.id', 'DESC')->get();
        }
        $code = ''; $supplier_name = ''; $user_name = ''; $status = '';
        if($request->code != ''){
            $code = $request->code;
        }
        if($request->supplier_name != ''){
            $supplier_name = $request->supplier_name;
        }
        if($request->user_name != ''){
            $user_name = $request->user_name;
        }
        if($request->status != '*'){
            $status = $request->status;
        }

        return view('reports.buys.printpreview', compact('buys', 'code', 'supplier_name', 'user_name', 'status'));
    }

    public function autocompleteSupplierName(Request $request) {
        $data = DB::table('suppliers')->select('name')->where('name', 'like', '%' . $request->name . '%')->get();
        return response()->json($data);
    }

    public function autocompleteUserName(Request $request) {
        $data = DB::table('users')->select('name')->where('name', 'like', '%' . $request->name . '%')->get();
        return response()->json($data);
    }

}
