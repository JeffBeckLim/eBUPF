<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoanApplicationController extends Controller
{
    public function showMplApplications(){
        return view('admin-views.admin-loan-applications.admin-mpl-applications');
    }

    public function showHslApplications(){
        return view('admin-views.admin-loan-applications.admin-hsl-applications');
    }
}
