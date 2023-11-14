<?php

namespace App\Http\Controllers;

use App\Models\LoanLog;
use App\Models\Amortization;
use Illuminate\Http\Request;
use App\Models\AdjustmentLog;
use App\Models\AmortizationLog;

class LoanLogController extends Controller
{
    public function show(){

        $loan_logs = LoanLog::orderBy('created_at', 'desc')->get();
        return view('admin-views.admin-logs.admin_loan_logs', compact('loan_logs'));
    }

    public function showAdjustments(){
        $loan_logs = AdjustmentLog::orderBy('created_at', 'desc')->get();
        return view('admin-views.admin-logs.admin_loan_logs', compact('loan_logs'));
    }

    public function showAmortization(){
        $loan_logs = AmortizationLog::orderBy('created_at', 'desc')->get();
        return view('admin-views.admin-logs.admin_loan_logs', compact('loan_logs'));
    }

}
