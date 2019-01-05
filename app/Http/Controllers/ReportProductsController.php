<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use DB;
class ReportProductsController extends Controller
{
    public function index(Request $request){

        $categories = Categories::all();
        $sel_category = $request->sel_category;
        if($request->button == 'SEARCH' or $request->button == 'PRINT'){
            //$products = Product::with(['name' => $request->searchtext ])->get();
            if($request->code != ''){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.code', '=',  $request->code)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext != '' and $request->sel_category == '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext != '' and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')
                    ->where('products.category_id', '=', $request->sel_category)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext == null and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('category_id', '=', $request->sel_category)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }else{
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }
        }else{
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id',
                    'products.code',
                    'categories.name as cat_name',
                    'products.name',
                    'products.price',
                    'products.amount',
                    'products.created_at',
                    'products.updated_at',
                    'products.photo')
                ->orderBy('categories.name','ASC')
                ->orderBy('products.id','DESC')
                ->get();
        }
        $code = $request->code;
        $searchtext = $request->searchtext;
        if($request->button == 'SEARCH' or $request->button == null){
            return view('reports.products.index', compact('products', 'categories', 'sel_category', 'code', 'searchtext'));
        }elseif($request->button == 'PRINT'){
            return view('reports.products.print', compact('products', 'sel_category', 'code', 'searchtext'));
        }
    }

    public function printpreview(Request $request){
        //return $request->all();
        if($request->button == 'SEARCH' or $request->button == 'PRINT'){
            //$products = Product::with(['name' => $request->searchtext ])->get();
            if($request->code != ''){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.code', '=',  $request->code)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext != '' and $request->sel_category == '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext != '' and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')
                    ->where('products.category_id', '=', $request->sel_category)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }elseif($request->searchtext == null and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->where('category_id', '=', $request->sel_category)
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }else{
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.amount',
                        'products.created_at',
                        'products.updated_at',
                        'products.photo')
                    ->orderBy('categories.name','ASC')
                    ->orderBy('products.id','DESC')
                    ->get();
            }
        }else{
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id',
                    'products.code',
                    'categories.name as cat_name',
                    'products.name',
                    'products.price',
                    'products.amount',
                    'products.created_at',
                    'products.updated_at',
                    'products.photo')
                ->orderBy('categories.name','ASC')
                ->orderBy('products.id','DESC')
                ->get();
        }

        $code = ''; $product_name = ''; $cat_name = '';
        if($request->code != ''){
            $code = $request->code;
        }
        if($request->searchtext != ''){
            $product_name = $request->searchtext;
        }
        if($request->sel_category != '*'){
            $sel_category = $request->sel_category;
            $cat = Categories::find($sel_category);
            $cat_name = $cat['name'];
        }

        return view('reports.products.printpreview', compact('products', 'code', 'product_name', 'cat_name'));
    }
}
