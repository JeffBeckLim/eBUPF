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
use App\Http\Controllers\AdminCreateMemberController;
use App\Http\Controllers\AdminLoanApplicationController;
use App\Http\Controllers\AdminLoanApplicationControlller;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminRemittanceController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CoBorrowerController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MembershipApplicationController;
use App\Http\Controllers\AdminReceivablesController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminReceivablesPDFController;
use App\Http\Controllers\AdminUpdateMemberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LedgerFilterController;
use App\Http\Controllers\LoanApplicationsFilterController;
use App\Http\Controllers\LoanApplicationTrackingFilterController;
use App\Http\Controllers\LoanLogController;
use App\Models\Penalty;

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
    //Route::get('/testRoute/{id}', [UserController::class, 'testRoute']);

    Route::get('member/loan/your-loans/{loan_status}', [LoanController::class, 'show'])->name('member.loans')->middleware('auth','member.access', 'checkSessionTimeout');

    Route::get('member/loan/loan-applications', [LoanApplicationController::class, 'showLoanApplications'])->name('loan.applications')->middleware('auth','member.access', 'checkSessionTimeout');

    Route::get('member/loan/loan-applications/evaluated', [LoanApplicationController::class, 'showLoanApplicationsEvaluated'])->name('loan.applications.evaluated')->middleware('auth','member.access', 'checkSessionTimeout');

    Route::get('member/loan/loan-applications/all', [LoanApplicationController::class, 'showLoanApplicationsAll'])->name('loan.applications.all')->middleware('auth','member.access', 'checkSessionTimeout');

    Route::get('member/loan/loan-applications/status/{id}', [LoanApplicationController::class, 'showLoanStatus'])->name('loan.application.status')->middleware('auth','member.access', 'checkSessionTimeout');

    // Delete status of loan
    Route::get('admin/loan-application/status/delete/{id}', [AdminLoanApplicationController::class, 'deleteLoanStatus'])->name('delete.status')->middleware('auth','admin.access');

    // Show Transactions
    Route::get('/member/transactions', [TransactionController::class, 'show'])->name('member.transactions')->middleware('auth','member.access', 'checkSessionTimeout');

    // For Calculator
    Route::get('/member/calculator', [CalculatorController::class, 'show'])->name('calculator')->middleware('auth','member.access', 'checkSessionTimeout');
    Route::post('/member/calculate', [CalculatorController::class, 'calculate'])->name('calculate')->middleware('auth','member.access', 'checkSessionTimeout');

    // Toggle Additional Loan
    Route::post('/admin/additional-loans/allow/{id},' , [AdminController::class, 'allowAdditional'])->name('allow.additional.loan')->middleware('auth','admin.access');

    // Update Check details
    Route::post('/admin/check/update/{id}' , [CheckController::class, 'updateCheck'])->name('loan.check.update')->middleware('auth','admin.access');



    // RECEIVABLES
    Route::get('/admin/receivables/{report}/{loan_type}' , [AdminReceivablesController::class, 'show'])->name('admin.receivables')->middleware('auth','admin.access');
    Route::get('/admin/receivables/yearly/summary/{report}/{loan_type}', [AdminReceivablesController::class, 'summary'])->name('admin.receivables.summary')->middleware('auth','admin.access');
    Route::get('/admin/receivables/yearly/remit/{report}/{loan_type}' , [AdminReceivablesController::class, 'remit'])->name('admin.receivables.remit')->middleware('auth','admin.access');

    // For generating PDF in the receivables
    Route::get('/admin/receivables/summary/generated-pdf/{year}/{loan_type}', [AdminReceivablesPDFController::class, 'generateReceivablesSummary'])->name('generate.receivables.summary.report')->middleware('auth','admin.access');

    // LEDGER
    Route::get('/admin/ledgers' , [LedgerController::class, 'show'])->name('admin.ledgers')->middleware('auth','admin.access');
    Route::get('/admin/ledgers/filter' , [LedgerFilterController::class, 'show'])->name('admin.ledgers.filter')->middleware('auth','admin.access');
    Route::get('/admin/ledgers/member/{loanTypeId}/{id}' , [LedgerController::class, 'showMemberLedgers'])->name('admin.members.ledgers')->middleware('auth','admin.access');
    Route::get('/admin/ledgers/personal-ledger/{id}' , [LedgerController::class, 'showPersonalLedger'])->name('admin.personal.ledger')->middleware('auth','admin.access');

    // PENALTY
    Route::post('/admin/ledgers/personal-ledger-penalty/update-create/{id}', [PenaltyController::class, 'updatePenalty'])->name('admin.penalty.updateOrCreate')->middleware('auth','admin.access');
        //penalty payment
        // createPenaltyPayment
    Route::post('/admin/ledgers/personal-ledger-penalty-payment/{penalty_id}', [PenaltyController::class, 'createPenaltyPayment'])->name('admin.penalty.createPayment')->middleware('auth','admin.access');
        // updatePenaltyPayment
    Route::post('/admin/ledgers/personal-ledger-penalty-payment-update/{penaltyPayment_id}', [PenaltyController::class, 'updatePenaltyPayment'])->name('admin.penalty.updatePayment')->middleware('auth','admin.access');



// 💸======================== ** LOAN APPLICATION MPL and HSL **  ==================================
    //show mpl application
    Route::get('/member/mpl-application-form/', [LoanApplicationController::class, 'show'])->name('mpl.application')->middleware('auth','member.access', 'checkSessionTimeout');


    //create MPL and HSL application and Co-Borrower request
    Route::post('/member/loan-application/{loanTypeId}', [LoanApplicationController::class, 'storeRequest'])->middleware('auth','member.access', 'checkSessionTimeout');

    //Show hsl form
    Route::get('/member/hsl-application-form/', [LoanApplicationController::class, 'showHsl'])->name('hsl.application')->middleware('auth','member.access', 'checkSessionTimeout');//add middleware for verified members only

    //show loan application details
    Route::get('/member/view/loan-details/{id}', [LoanController::class, 'displayLoanDetails'])->name('loan.details')->middleware('auth','member.access', 'checkSessionTimeout');
// ======================== ** LOAN APPLICATION MPL and HSL **  ==================================
//
//
//
// 📬======================== ** LOAN APPLICATION REQUESTS **  ====================================
    //show requests for co-borrower
    Route::get('/member/coBorrower/requests/', [CoBorrowerController::class, 'show'])->name('incoming.request')->middleware('auth','member.access', 'checkSessionTimeout');
     //Show auth users request
    Route::get('/member/Your/coBorrower/requests/', [CoBorrowerController::class, 'showYourRequest'])->name('outgoing.request')->middleware('auth','member.access', 'checkSessionTimeout');
    // -----------------------------------------------------------------------------------
    // show loan application details of the principal borrower
    Route::get('/member/loan-application-details/{id}', [CoBorrowerController::class, 'showLoan'])->middleware('auth','member.access', 'checkSessionTimeout');
    //update accept request co-borrower
    Route::get('/member/coBorrower/accept/{id}', [CoBorrowerController::class, 'requestAccept'])->middleware('auth','member.access', 'checkSessionTimeout');
    //update decline request co-borrower
    Route::get('/member/coBorrower/decline/{id}', [CoBorrowerController::class, 'requestDecline'])->middleware('auth','member.access', 'checkSessionTimeout');
    // cancel loan application
    Route::get('/member/coBorrower/cancel-application/{id}', [LoanApplicationController::class, 'cancelApplication'])->name('cancel.application')->middleware('auth','member.access', 'checkSessionTimeout');
    // cancel application that has been accepted by CB
    // Route::get('/member/coBorrower/cancel-application-confirmed/{id}', [LoanApplicationController::class, 'cancelApplicationConfirmed'])->name('cancel.application.confirmed');

    // Verify email
    Route::get('/verify/email', function(){
        return view('auth.verify');
    });

// ======================== ** LOAN APPLICATION REQUESTS **  ====================================
//
//
//
//🔴ADMIN ==================================================================================================

    // Show Admin Profile
    Route::get('admin/my-profile' , [AdminProfileController:: class, 'show'])->name('admin.profile')->middleware('auth','admin.access');
    // Show profile update page
    Route::get('admin/my-profile/update' , [AdminProfileController:: class, 'update'])->name('admin.update.profile')->middleware('auth','admin.access');
    // save profile updates
    Route::post('admin/my-profile/save-updates/{member_id}', [AdminProfileController::class, 'saveUpdate'])->name('admin.update.profile.save')->middleware('auth','admin.access');
    // save password change
    Route::put('admin/my-profile/change-password/{member_id}', [AdminProfileController::class, 'changePassword'])->name('admin.change.password')->middleware('auth','admin.access');

    // Show loan Applications
    Route::get('/admin/loan-applications/{loanType}/{freeze}', [AdminLoanApplicationController::class, 'showLoanApplications'])->name('admin.loan.applications')->middleware('auth','admin.access');

    // Show loan Applications
    Route::get('/admin/loan-applications/{loanType}/{freeze}/filter', [LoanApplicationsFilterController::class, 'show'])->name('admin.loan.applications.filter')->middleware('auth','admin.access');



    // Add Amortization
    Route::post('/admin/loan-applications/amortization/{id}', [AdminAmortizationController::class, 'createAmortization'])->name('create.amortization')->middleware('auth','admin.access');

    // Edit Loan
    Route::post('/admin/loan-applications/update-loan/{id}', [AdminLoanApplicationController::class, 'updateLoan'])->name('update.loan')->middleware('auth','admin.access');


    // Show MPL or HSL Applications
    Route::get('/admin/loan-applications-tracking/{loan_type}', [AdminLoanApplicationController::class, 'showLoanApplicationsTracking'])->name('admin.loan.applications.tracking')->middleware('auth','admin.access');

    Route::get('/admin/loan-applications-tracking/{loan_type}/filter', [LoanApplicationTrackingFilterController::class, 'show'])->name('admin.loan.applications.tracking.filter')->middleware('auth','admin.access');


    // add status in regards to the application process
    Route::post('admin/loan-application/status/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationStatus'])->name('create.status')->middleware('auth','admin.access');

    // add a state to a loan of active closed or null
    Route::post('admin/loan-application/state/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationState'])->name('create.state')->middleware('auth','admin.access');

    // add category to the loan NEW ADD RENEW
    Route::post('admin/loan-application/category/{loan_id}', [AdminLoanApplicationController::class, 'createLoanApplicationCategory'])->name('create.category')->middleware('auth','admin.access');

    // update principal amount by admin
    Route::post('admin/loan-application/adjust/{loan_id}', [AdminLoanApplicationController::class, 'updateLoanApplicationAmount'])->name('update.principalAmount')->middleware('auth','admin.access');

    // create / update adjustments
    Route::post('admin/loan-application/adjustments/{loan_id}', [AdjustmentsController::class, 'updateLoanAdjustments'])->name('update.adjustments')->middleware('auth','admin.access');

    // Show Admin Dashboard
    Route::get('/admin/dashboard/', [AdminController::class, 'index'])->name('admin-dashboard')->middleware('auth','admin.access');

    //Show All Accounts View
    Route::get('/admin/all-users', [AdminController::class, 'allUsers'])->name('admin.all.users')->middleware('auth','admin.access');

    //Show all members
    Route::get('/admin/members', [AdminController::class, 'showMembers'])->name('admin.members')->middleware('auth','admin.access');
    //Show filter members
    Route::get('/admin/members/filter', [AdminController::class, 'showMembersFilter'])->name('admin.members.filter')->middleware('auth','admin.access');
    // Show Create Member Page
    Route::get('/admin/members/create-member', [AdminCreateMemberController::class, 'show'])->name('admin.members.create')->middleware('auth','admin.access');
    Route::post('/admin/members/create-member', [AdminCreateMemberController::class, 'create'])->name('admin.members.save')->middleware('auth','admin.access');

    // Show Update Member Page
    Route::get('/admin/members/update-member/{member_id}', [AdminUpdateMemberController::class, 'show'])->name('admin.members.update')->middleware('auth','admin.access');
    Route::post('/admin/members/update-member/{member_id}/update', [AdminUpdateMemberController::class, 'update'])->name('admin.members.update.save')->middleware('auth','admin.access');



    //Show membership Applications
    Route::get('/admin/membership-applications', [MembershipApplicationController::class, 'show'])->name('admin.membership-application')->middleware('auth','admin.access');

    //Accept membership application
    Route::get('/admin/membership/accept/{id}', [MembershipApplicationController::class, 'acceptMembership'])->name('membership.accept')->middleware('auth','admin.access');
    //Reject membership application
    Route::get('/admin/membership/reject/{id}', [MembershipApplicationController::class, 'rejectMembership'])->name('membership.reject')->middleware('auth','admin.access');

    // Show Admin Ledger
    // Route::get('/ledger/test-me', [AdminController::class, 'memberLedger']); //->middleware('auth','admin.access');

    Route::put('/admin/update-role/{user}', [UserController::class, 'updateUserRole'])->name('users.updateRole')->middleware('auth','admin.access');

    Route::get('/admin/remittance/view', [AdminRemittanceController::class, 'showRemittance'])->name('admin.remittance')->middleware('auth','admin.access');

    Route::post('/admin/remittance/view/payment/add', [AdminRemittanceController::class, 'addPaymentRemittance'])->name('add.payment.remittance')->middleware('auth','admin.access');

    //Route::put('/admin/remittance/view/payment/update/{id}', [AdminRemittanceController::class, 'updatePaymentRemittance'])/* ->middleware('auth','admin.access') ->name('update.payment.remittance');

    //View Logs
    Route::get('/admin/remittance/view/logs', [AdminRemittanceController::class, 'showLogsRemittance'])/* ->middleware('auth','admin.access') */->name('logs.remittance')->middleware('auth','admin.access');
    //delete payment
    Route::delete('/admin/remittance/view/payment/delete/{id}', [AdminRemittanceController::class, 'deletePaymentRemittance'])->name('delete.payment.remittance')->middleware('auth','admin.access');

    Route::get('/admin/logs/loan', [LoanLogController::class, 'show'])->name('loan.logs')->middleware('auth','admin.access');
    Route::get('/admin/logs/loan-adjustments', [LoanLogController::class, 'showAdjustments'])->name('adjustment.logs')->middleware('auth','admin.access');
    Route::get('/admin/logs/amortization', [LoanLogController::class, 'showAmortization'])->name('amortization.logs')->middleware('auth','admin.access');



 //ADMIN ======================================================================================================

//🟩MEMBER =================================================================================================
    //Show Member Profile
    // Route::get('/member/profile/{id}', [MemberController::class, 'viewProfile'])->middleware('auth','member.access', 'checkSessionTimeout');

    //create membership create form
    Route::put('/member/application/{member}', [MemberController::class,'createMembership'])->middleware('verified');

    // Show Member Profile
    Route::get('/member/profile', [MemberController::class, 'viewProfile'])->middleware('auth','member.access', 'checkSessionTimeout')->name('member.profile');

    // Update Profile
    Route::post('/member/profile/update/{id}', [MemberController::class, 'profileUpdate'])->middleware('auth','member.access', 'checkSessionTimeout')->name('member.profile.update');

    // Change Password
    Route::post('/member/profile/change-password/{id}', [MemberController::class, 'changePassword'])->middleware('auth','member.access', 'checkSessionTimeout')->name('member.change.password');

    //Show Membership Form
    Route::get('/member/membership-form', [MemberController::class,'membershipForm'])->middleware('verified');

    //Show Membership Download or Edit
    Route::get('/member/membership-form/edit-download', [MemberController::class,'membershipFormEditDownload'])->middleware('verified');

    //Show Membership Form for Editing
    Route::get('/member/membership-form/edit', [MemberController::class,'membershipFormEdit'])->middleware('verified');

    //Update Membership Form
    Route::put('/member/application/edit/{member}', [MemberController::class, 'updateMembership'])->middleware('verified');

    //Check Membership Application
    Route::get('/member/membership-application/check/{member_id}', [MemberController::class,'checkMembershipApplication'])->middleware('verified');

    //Generate Membership Application Form
    Route::get('/generateMembershipForm/{id}',[PDFController::class,'generateMembershipForm'])->middleware('auth')->name('generateMembershipForm')->middleware('verified');

    //Generate MPL Application Form
    Route::get('/member/generateMulti-PurposeLoanApplicationForm/{id}',[PDFController::class,'generateMPL'])->middleware('auth')->name('generateMulti-PurposeLoanApplicationForm');

    //Generate HSL Application Form
    Route::get('/member/generateHousingLoanApplicationForm/{id}',[PDFController::class,'generateHL'])->middleware('auth')->name('generateHousingLoanApplicationForm');

    //Generate Insurance Form
    Route::get('/member/this/generateInsuranceForm',[PDFController::class,'generateInsuranceForm'])->middleware('auth')->name('generateInsuranceForm');
//MEMBER ======================================================================================================


// Show Home or Landing Page ====================================================================================

Route::get('/', function () {
    return view('home');
})->middleware('verified.access');

Route::get('/member', [MemberController::class, 'showMemberDash'])->name('member-dashboard')->middleware('auth','member.access', 'checkSessionTimeout');

//auth logout flush
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Auth::routes(['verify' => true]);

// Show Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified.access')->name('home');

// About BUPF
Route::get('/about-bupf', function () {
    return view('about-bupf');
})->middleware('verified.access')->name('about-bupf');


// About eBUPF
Route::get('/about-ebupf', function () {
    return view('about-ebupf');
})->middleware('verified.access')->name('about-ebupf');


// About MPL
Route::get('/about/multi-purpose-loan', function () {
    return view('about-mpl');
})->middleware('verified.access')->name('about-mpl');


// About HL
Route::get('/about/housing-loan', function () {
    return view('about-hsl');
})->middleware('verified.access')->name('about-hsl');

// Terms and Conditions
Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->middleware('verified.access')->name('terms-and-conditions');

// Privacy Policy
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->middleware('verified.access')->name('privacy-policy');

// Access sitemap.xml this is not a blade file
Route::get('ebupf-sitemap.xml', function () {
    return response()->file(public_path('ebupfSiteMap.xml'));
});
