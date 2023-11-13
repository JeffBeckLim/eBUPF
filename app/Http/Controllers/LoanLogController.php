<?php

namespace App\Http\Controllers;

use App\Models\LoanLog;
use Illuminate\Http\Request;

class LoanLogController extends Controller
{
    public function show(){

        $loan_logs = LoanLog::orderBy('created_at', 'desc')->get();

        return view('admin-views.admin-logs.admin_loan_logs', compact('loan_logs'));
    }
}
