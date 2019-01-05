<?php

namespace App\Http\Controllers;

use App\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Mockery\Exception;

class CategoriesController extends Controller
{
    public function validator(array $data){
        return Validator::make($data, [
            'code' => 'required|string|min:3|max:10'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Categories::orderBy('id', 'DESC')->paginate(5);
        return view('categories.index', compact('categories'))->with('i', ($request->input('page', 1) -1 ) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'cat_name' => 'required',
        ]);
        //return $request->all();
        DB::table('categories')->insert(['code' => $request->code, 'name' => $request->cat_name, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        return redirect()->route('categories.index')->with('success', 'ໝວດສິນຄ້າຖືກສ້າງສຳເລັດແລ້ວ');
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
        $category = Categories::find($id);
        return view('categories.edit',compact('category'));
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
        $this->validate($request, [
            'code' => 'required',
            'cat_name' => 'required',
        ]);
        $category = Categories::find($id);
        $category->code = $request->code;
        $category->name = $request->cat_name;
        $category->save();
        return redirect()->route('categories.index')->with('success','ແກ້ໄຂໝວດສິນຄ້າສຳເລັດ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::find($id)->delete();
        return redirect()->route('categories.index')->with('success','ລຶບໝວດສິນຄ້າແລ້ວ');
    }
}
