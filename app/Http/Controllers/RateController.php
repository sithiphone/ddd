<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rate;
use App\Http\Requests\RateRequest;
class RateController extends Controller
{
    public function index(){
        $date = Carbon::now()->format('d/m/Y');
        $rate = Rate::first();
        return view('rate.index',compact('rate', 'date'));
    }

    public function edit($id){
        $rate = Rate::find($id);
        return view('rate.update', compact('rate'));
    }

    public function update(RateRequest $request, $id){
        $rate = Rate::find($id);
        $rate->bath = $request->bath;
        $rate->dolar = $request->dolar;
        $rate->erro = $request->erro;
        $rate->save();

        return redirect('rate');
    }
}
