<?php

namespace App\Http\Controllers;

use App\Models\SessionLog;
use Illuminate\Http\Request;

class SessionLogController extends Controller
{
    public function show(){
        $session_logs = SessionLog::orderBy('created_at', 'desc')->get();
        return view('admin-views.admin-logs.admin_loan_logs', compact('session_logs'));
    }
}
