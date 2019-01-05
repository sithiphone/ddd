<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        //return $request->all();
        $categories = Categories::all();
        $sel_category = $request->sel_category;

        if($request->button == 'SEARCH'){
            //$products = Product::with(['name' => $request->searchtext ])->paginate(10);
            if($request->searchtext != '' and $request->sel_category == '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')->orderBy('products.id', 'DESC')->paginate(30);
            }elseif($request->searchtext != '' and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')
                    ->where('products.name', 'like', '%' . $request->searchtext . '%')
                    ->where('products.category_id', '=', $request->sel_category)->orderBy('products.id', 'DESC')
                    ->paginate(30);
            }elseif($request->searchtext == null and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')
                    ->where('category_id', '=', $request->sel_category)->orderBy('products.id', 'DESC')
                    ->paginate(30);
            }else{
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')->orderBy('products.id', 'DESC')->paginate(10);
            }
        }else{
            if($request->sel_category != null and $request->sel_category != '*'){
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')
                    ->where('category_id', '=', $request->sel_category)->orderBy('products.id', 'DESC')
                    ->paginate(30);
            }else{
                $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id',
                        'products.code',
                        'categories.name as cat_name',
                        'products.name',
                        'products.price',
                        'products.photo')->orderBy('products.id', 'DESC')->paginate(10);

            }
        }
        $search_text = $request->searchtext;
        return view('products.index', compact('products', 'categories', 'sel_category', 'search_text'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->select('id','name')->get();
        $units = DB::table('units')->select('id', 'unit_lao')->get();
        return view('products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if($request->hasFile('photo')){
            $filename = $request->photo->getClientOriginalName();
            $request->photo->storeAs('public/photos/products', $filename);
        }else{
            $filename = 'no_photo.jpg';
        }
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->photo = $filename;
        $product->category_id = $request->categories_id;
        $product->unit_id = $request->unit_id;
        $product->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $from = $request->from;
        //$product = Product::find($id);
        $product = DB::table('products')
            ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->select(
                'products.id', 'products.code', 'products.name', 'products.photo', 'products.price','categories.name as category_name'
            )->where('products.id', '=', $id)->get();
        $product = $product[0];
        return view('products.product', compact('product', 'from'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = DB::table('categories')->select('id', 'name')->get();
        $units = DB::table('units')->select('id', 'unit_lao')->get();
        return view('products.update', compact('product', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        if($request->hasFile('photo')){
            $filename = $request->photo->getClientOriginalName();
            $request->photo->storeAs('public/photos/products', $filename);
        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->categories_id;
        $product->updated_at = Carbon::now();
        if($request->hasFile('photo')){
            $product->photo = $filename;
        }
        $product->save();
       // DB::table('products')->where('id', $id)->update(['name' => $request->name, 'price' => $request->price, 'photo' => $filename]);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }

}
