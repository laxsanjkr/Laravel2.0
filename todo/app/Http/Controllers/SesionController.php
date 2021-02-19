<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function getSession(Request $request){
        
        if($request->session()->has($request['key']))
        {
            echo $request->session()->get($request['key']);
        }
        else
        {
            echo "nodata";
        }
    }


    public function setSession(Request $request){
        $request->session()->put('key',$request['key']);   
    }

    public function delSession(Request $request){
        $request->session()->forget('name');
    }
    
}
