<?php

use App\Http\Controllers\AdjustmentsController;
use App\Http\Controllers\AdminAmortizationController;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoanApplicationController;
use App\Http\Controllers\AdminLoanApplicationControlller;
use App\Http\Controllers\AdminRemittanceController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CoBorrowerController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MembershipApplicationController;
use App\Http\Controllers\ReceivablesController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//🛠️TESTING ===================================================================================================
    Route::get('/testRoute/{id}', [UserController::class, 'testRoute']);

    Route::get('member/loan/your-loans', [LoanController::class, 'show'])->name('member.loans');


    Route::get('member/loan/loan-applications', [LoanApplicationController::class, 'showLoanApplications'])->name('loan.applications');

    Route::get('member/loan/loan-applications/evaluated', [LoanApplicationController::class, 'showLoanApplicationsEvaluated'])->name('loan.applications.evaluated');

    Route::get('member/loan/loan-applications/all', [LoanApplicationController::class, 'showLoanApplicationsAll'])->name('loan.applications.all');



    Route::get('member/loan/loan-applications/status/{id}', [LoanApplicationController::class, 'showLoanStatus'])->name('loan.application.status');

    Route::get('admin/loan-application/status/delete/{id}', [AdminLoanApplicationController::class, 'deleteLoanStatus'])->name('delete.status');


    Route::get('/member/transactions', [TransactionController::class, 'show'])->name('member.transactions');
    Route::get('/member/calculator', [CalculatorController::class, 'show'])->name('calculator');
    Route::post('/member/calculate', [CalculatorController::class, 'calculate'])->name('calculate');


    Route::post('/admin/additional-loans/allow/{id},' , [AdminController::class, 'allowAdditional'])->name('allow.additional.loan');

    Route::post('/admin/check/update/{id}' , [CheckController::class, 'updateCheck'])->name('loan.check.update');




    Route::get('/admin/receivables' , [ReceivablesController::class, 'show'])->name('admin.receivables');
    Route::get('/admin/ledgers' , [LedgerController::class, 'show'])->name('admin.ledgers');
    Route::get('/admin/ledgers/member/{loan_type}/{id}' , [LedgerController::class, 'showMemberLedgers'])->name('admin.members.ledgers');



//TESTING ===================================================================================================


// 💸======================== ** LOAN APPLICATION MPL and HSL **  ==================================
    //show mpl application
    Route::get('/member/mpl-application-form/', [LoanApplicationController::class, 'show'])->middleware('auth')->name('mpl.application');//add middleware for verified members only


    //create MPL and HSL application and Co-Borrower request
    Route::post('/member/loan-application/{loanTypeId}', [LoanApplicationController::class, 'storeRequest']);

    //Show hsl form
    Route::get('/member/hsl-application-form/', [LoanApplicationController::class, 'showHsl'])->middleware('auth')->name('hsl.application');//add middleware for verified members only

    //show loan application details
    Route::get('/member/view/loan-details/{id}', [LoanController::class, 'displayLoanDetails'])->name('loan.details');
// ======================== ** LOAN APPLICATION MPL and HSL **  ==================================
//
//
//
// 📬======================== ** LOAN APPLICATION REQUESTS **  ====================================
    //show requests for co-borrower
    Route::get('/member/coBorrower/requests/', [CoBorrowerController::class, 'show'])->name('incoming.request');
     //Show auth users request
    Route::get('/member/Your/coBorrower/requests/', [CoBorrowerController::class, 'showYourRequest'])->name('outgoing.request');
    // -----------------------------------------------------------------------------------
    // show loan application details of the principal borrower
    Route::get('/member/loan-application-details/{id}', [CoBorrowerController::class, 'showLoan']);
    //update accept request co-borrower
    Route::get('/member/coBorrower/accept/{id}', [CoBorrowerController::class, 'requestAccept']);
    //update decline request co-borrower
    Route::get('/member/coBorrower/decline/{id}', [CoBorrowerController::class, 'requestDecline']);

    // Verify email
    Route::get('/verify/email', function(){
        return view('auth.verify');
    });
// ======================== ** LOAN APPLICATION REQUESTS **  ====================================
//
//
//
//🔴ADMIN ==================================================================================================

    // UNDER TESTING UNDER TESTING UNDER TESTING ---------------------------------------------------------
    Route::get('/admin/loan-applications', [AdminLoanApplicationController::class, 'showLoanApplications'])->name('admin.loan.applications');

    Route::post('/admin/loan-applications/amortization/{id}', [AdminAmortizationController::class, 'createAmortization'])->name('create.amortization');

    Route::post('/admin/loan-applications/update-loan/{id}', [AdminLoanApplicationController::class, 'updateLoan'])->name('update.loan');


    // UNDER TESTING UNDER TESTING UNDER TESTING ---------------------------------------------------------


    // Show MPL or HSL Applications
    Route::get('/admin/loan-applications/tracking/{loan_type}', [AdminLoanApplicationController::class, 'showLoanApplicationsTracking'])->name('admin.loan.applications.tracking');

    // add status in regards to the application process
    Route::post('admin/loan-application/status/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationStatus'])->name('create.status');

    // add a state to a loan of active closed or null
    Route::post('admin/loan-application/state/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationState'])->name('create.state');

    // add category to the loan NEW ADD RENEW
    Route::post('admin/loan-application/category/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationCategory'])->name('create.category');

    // update principal amount by admin
    Route::post('admin/loan-application/adjust/{loan_id}', [AdminLoanApplicationController::class, 'updateLoanApplicationAmount'])->name('update.principalAmount');

    // create / update adjustments
    Route::post('admin/loan-application/adjustments/{loan_id}', [AdjustmentsController::class, 'updateLoanAdjustments'])->name('update.adjustments');

    // Show Admin Dashboard
    Route::get('/admin/dashboard/', [AdminController::class, 'index'])->name('admin-dashboard'); //->middleware('auth','admin.access');

    //Show All Accounts View
    Route::get('/admin/all-users', [AdminController::class, 'allUsers']); //->middleware('auth','admin.access');
    //Show all members
    Route::get('/admin/members', [AdminController::class, 'showMembers']);
    //Show membership Applications
    Route::get('/admin/membership-applications', [MembershipApplicationController::class, 'show']);

    //Accept membership application
    Route::get('/admin/membership/accept/{id}', [MembershipApplicationController::class, 'acceptMembership'])->name('membership.accept');
    //Reject membership application
    Route::get('/admin/membership/reject/{id}', [MembershipApplicationController::class, 'rejectMembership'])->name('membership.reject');

    // Show Admin Ledger
    Route::get('/ledger', [AdminController::class, 'memberLedger']); //->middleware('auth','admin.access');

    Route::put('/admin/update-role/{user}', [UserController::class, 'updateUserRole'])->name('users.updateRole');

    Route::get('/admin/remittance/view', [AdminRemittanceController::class, 'showRemittance'])->name('admin.remittance');
    // ->middleware('auth','admin.access')

    Route::post('/admin/remittance/view/payment/add', [AdminRemittanceController::class, 'addPaymentRemittance'])/* ->middleware('auth','admin.access') */->name('add.payment.remittance');

    Route::put('/admin/remittance/view/payment/update/{id}', [AdminRemittanceController::class, 'updatePaymentRemittance'])/* ->middleware('auth','admin.access') */->name('update.payment.remittance');
//ADMIN ======================================================================================================

//🟩MEMBER =================================================================================================
    //Show Member Profile
    // Route::get('/member/profile/{id}', [MemberController::class, 'viewProfile'])->middleware('auth','member.access');

    //create membership create form
    Route::put('/member/application/{member}', [MemberController::class,'createMembership']);

    // Show Member Profile
    Route::get('/member/profile', [MemberController::class, 'viewProfile'])->middleware('auth','member.access')->name('member.profile');

    // Update Profile
    Route::post('/member/profile/update/{id}', [MemberController::class, 'profileUpdate'])->middleware('auth','member.access')->name('member.profile.update');

    //Show Membership Form
    Route::get('/member/membership-form', [MemberController::class,'membershipForm']);

    //Show Membership Download or Edit
    Route::get('/member/membership-form/edit-download', [MemberController::class,'membershipFormEditDownload']);

    //Show Membership Form for Editing
    Route::get('/member/membership-form/edit', [MemberController::class,'membershipFormEdit']);

    //Update Membership Form
    Route::put('/member/application/edit/{member}', [MemberController::class, 'updateMembership']);

    //Check Membership Application
    Route::get('/member/membership-application/check/{member_id}', [MemberController::class,'checkMembershipApplication']);

    //Generate Membership Application Form
    Route::get('/generateMembershipForm/{id}',[PDFController::class,'generateMembershipForm'])->middleware('auth')->name('generateMembershipForm');

    //Generate MPL Application Form
    Route::get('/member/generateMulti-PurposeLoanApplicationForm/{id}',[PDFController::class,'generateMPL'])->middleware('auth')->name('generateMulti-PurposeLoanApplicationForm');

    //Generate HSL Application Form
    Route::get('/member/generateHousingLoanApplicationForm/{id}',[PDFController::class,'generateHSL'])->middleware('auth')->name('generateHousingLoanApplicationForm');

    //Generate Insurance Form
    Route::get('/member/this/generateInsuranceForm',[PDFController::class,'generateInsuranceForm'])->middleware('auth')->name('generateInsuranceForm');
//MEMBER ======================================================================================================


// Show Home or Landing Page
Route::get('/', function () {
    return view('home');
})->middleware('verified.access');

// show view for member
Route::get('/member', [MemberController::class, 'showMemberDash'])->middleware('auth','member.access')->name('member-dashboard');
// ->middleware('auth')

//auth logout flush
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Auth::routes(['verify' => true]);

// Show Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified.access')->name('home');

