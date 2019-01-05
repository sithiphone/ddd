<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Request $request){
        $msg = $request->msg;
        return view('unauthorized', compact('msg'));
    }
}
