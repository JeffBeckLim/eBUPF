<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceivablesController extends Controller
{
    public function show(){

        return view('admin-views.admin-receivables.admin-receivables');
    }
}
