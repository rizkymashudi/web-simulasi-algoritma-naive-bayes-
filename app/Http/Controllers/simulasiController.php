<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class simulasiController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function simulate(Request $request){
        
    }
}
