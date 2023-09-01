<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function show(){
        return view('member-views.calculator.calculator');
    }
}
