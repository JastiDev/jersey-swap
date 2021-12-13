<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class BannedController extends Controller
{
    public function banned(Request $request){
        if(session('error','null')=="null"){
            return redirect('/');
        }
        return view('frontend.banned');
    }
}
