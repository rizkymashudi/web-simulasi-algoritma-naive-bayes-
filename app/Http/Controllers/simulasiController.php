<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\NaiveBayes;

class simulasiController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function simulate(Request $request){
        
        //call class NaiveBayes
        $obj = new NaiveBayes();

        //declare function from class NaiveBayes
        $jumTrue = $obj->sumTrue();
        $jumFalse= $obj->sumFalse();
        $jumData = $obj->sumData();

    }
}
