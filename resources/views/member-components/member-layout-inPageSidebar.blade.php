@php
    use App\Models\Loan;
    use App\Models\Payment;
    use App\Models\CoBorrower;

    $user = Auth::user();
    $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();
    //get members additional_loan column
    $additionalLoan = $user->member->additional_loan;

    //get all mpl and hsl loans
    $mplLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 1)->where('is_active', 1)->get();
    $hslLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 2)->where('is_active', 1)->get();

    //get all payments for mpl and hsl loans, grouped by loan_id
    $mplPayments = Payment::where('member_id', $user->member->id)
    ->whereIn('loan_id', $mplLoans->pluck('id'))
    ->get()
    ->groupBy('loan_id');

    $hslPayments = Payment::where('member_id', $user->member->id)
    ->whereIn('loan_id', $hslLoans->pluck('id'))
    ->get()
    ->groupBy('loan_id');

    //get total payments for mpl and hsl loans, by grouping the payments by loan_id and summing the interest and principal
    $totalPaymentsMPL = $mplPayments->map(function ($payments) {
        $totalInterest = $payments->sum('interest');
        $totalPrincipal = $payments->sum('principal');
        return $totalInterest + $totalPrincipal;
    });

    $totalPaymentsHSL = $hslPayments->map(function ($payments) {
        $totalInterest = $payments->sum('interest');
        $totalPrincipal = $payments->sum('principal');
        return $totalInterest + $totalPrincipal;
    });

    $inActiveLoan = CoBorrower::with(
        'member.units.campuses',
        'loan.member.units.campuses',
        'loan.loanApplicationStatus.loanApplicationState',
        'loan.loanType'
    )
    ->whereHas('loan', function ($query) {
        $query->where(function ($query) {
            $query->where('member_id', Auth::user()->member->id)
                ->orWhereNull('member_id')
                ->orWhere('member_id', 0);
        })
        ->where(function ($query) {
            $query->where('is_active', 0)
                ->orWhereNull('is_active');
        });
    })->first();

    $mplTotalAmount = 0;
    $hslTotalAmount = 0;

    // Get total amount of all loans
    foreach ($loans as $loan) {
        if ($loan->loan_type_id == 1) {
            $mplTotalAmount += ($loan->principal_amount + $loan->interest);
        } elseif ($loan->loan_type_id == 2) {
            $hslTotalAmount += ($loan->principal_amount + $loan->interest);
        }
    }

    $mplTotalBalance = $mplTotalAmount;
    $hslTotalBalance = $hslTotalAmount;

    // Get total balance of all loans
    foreach ($loans as $loan) {
        if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id])){
        $mplTotalBalance -= $totalPaymentMPL[$loan->id];
    }
    if(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id])){
        $hslTotalBalance -= $totalPaymentHSL[$loan->id];
        }
    }

    // Check if all MPL loans have been paid 50%
    $allMPLPaid50Percent = $mplLoans->isEmpty() || $mplLoans->every(function ($loan) use ($totalPaymentsMPL) {
        return isset($totalPaymentsMPL[$loan->id]) && $totalPaymentsMPL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
    });

    // Check if all HSL loans have been paid 50%
    $allHSLPaid50Percent = $hslLoans->isEmpty() || $hslLoans->every(function ($loan) use ($totalPaymentsHSL) {
        return isset($totalPaymentsHSL[$loan->id]) && $totalPaymentsHSL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
    });

    // Determine if the MPL and HSL apply buttons should be disabled
    // MPL is disabled if there is an active loan or if all MPL loans have not been paid 50% and
    $mplDisabled = !empty($inActiveLoan) || !$allMPLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 2 && $additionalLoan != 3);
    $hslDisabled = !empty($inActiveLoan) || !$allHSLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 1 && $additionalLoan != 3);

@endphp

<div class="row">

    <!-- Placeholder to prevent overlapping -->
    <div class="d-none d-lg-block" style="width: 20%;">
        <span class="placeholder"></span>
    </div>
    <!-- Placeholder to prevent overlapping -->

    <!-- NAVBAR -->
    <div class=" d-none  d-lg-block  position-fixed h-100 " style="background-color: #ffffff; width: 20%;">
        <div class="row d-flex py-3  m-0">
            <a href="{{route('home')}}">
                <img class="img-fluid ps-3 pt-2" src="{{asset('assets/bu-provident.svg')}}" alt="" style="width: 14rem;">
            </a>
        </div>


        <ul class="nav flex-column" style=" scale: .9" >

            <a class="text-decoration-none" href="{{ route('member.profile') }}">
                <li class="nav-items py-3 grow-on-hover {{ Route::is('member.profile') ? 'bg-selected fade-in  rounded-4':' '}}  ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="icon" src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="icon">
                        </div>
                        <div class="col d-flex align-items-center text-secondary">
                            <span class="fw-bold fs-7">{{ Auth::user()->member->firstname }} {{ Auth::user()->member->lastname }}</span>
                        </div>
                    </div>
                </li>
            </a>


            <a class="text-decoration-none" href="{{ route('home') }}">
                <li class="nav-item  py-3 grow-on-hover {{ Route::is('member-dashboard') ? 'bg-selected fade-in  rounded-4':' '}} ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img src="{{asset('icons/home.svg')}}" alt="">
                        </div>
                        <div class="col-9">
                            <span class="fw-bold fs-7 text-secondary">Home</span>
                        </div>
                    </div>
                </li>
            </a>


            <a class="text-decoration-none" href="{{route('member.loans', 1)}}">
                <li class="nav-item  py-3 grow-on-hover {{ Route::is('member.loans') ? 'bg-selected fade-in  rounded-4':' '}} ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <i class="fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold fs-7 text-secondary">Loans</span>
                        </div>
                    </div>
                </li>
            </a>


            <li class="nav-item grow-on-hover">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">

                        <button style="padding-left: 13px  !important;" class="accordion-button collapsed {{ Route::is('mpl.application','hsl.application') ? 'bg-selected fade-in  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoans" aria-expanded="false" aria-controls="collapseLoans">
                            <div class="row g-0 w-100">
                                <div class="col-3 text-center pe-2">
                                    <img src="{{asset('icons/loan-options.svg')}}" alt="">
                                </div>
                                <div class="col-9 ">
                                    <span class="fw-bold fs-7 text-secondary">Loan Options</span>
                                </div>
                            </div>
                        </button>

                      <div id="collapseLoans" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{ Route::is('mpl.application') ? 'fw-bold' : '' }}" href="{{ route('mpl.application') }}"
                                        @if ($mplDisabled)
                                            disabled
                                            style="pointer-events: none; opacity: 0.6;"
                                        @endif
                                    >
                                        Apply for MPL
                                    </a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{ Route::is('hsl.application') ? 'fw-bold' : '' }}" href="{{ route('hsl.application') }}"
                                        @if ($hslDisabled)
                                            disabled
                                            style="pointer-events: none; opacity: 0.6;"
                                        @endif
                                    >
                                        Apply for HSL
                                    </a>
                                </div>

                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>


            <li class="nav-item grow-on-hover">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">

                        <button style="padding-left: 13px  !important;" class="accordion-button collapsed {{ Route::is('loan.applications','outgoing.request') ? 'bg-selected fade-in  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoanApplications" aria-expanded="false" aria-controls="collapseLoanApplications">
                            <div class="row g-0 w-100">
                                <div class="col-3 text-center pe-2">
                                    <i style="font-size: 23px; color: #FF6F19;" class="bi bi-file-earmark-check-fill"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <span class="fw-bold fs-7 text-secondary">Applications</span>
                                </div>
                            </div>
                        </button>

                      <div id="collapseLoanApplications" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('loan.applications') ? 'fw-bold' : ''}} " href="{{ route('loan.applications')}}">Loan Applications</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('outgoing.request')? 'fw-bold': ''}}" href="/member/Your/coBorrower/requests/">Your Requests</a>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>





            <a class="text-decoration-none" href="{{route('incoming.request')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('incoming.request') ? 'bg-selected fade-in fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center">
                            <i style="font-size: 23px; color: #D100B0;" class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="col-9  d-flex align-items-center">
                            <span class="fw-bold fs-7 text-secondary">Co-borrower Request</span>
                        </div>
                    </div>
                </li>
            </a>

            <a class="text-decoration-none" href="{{route('member.transactions')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('member.transactions') ? 'bg-selected fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="mb-1" src="{{asset('icons/receipt.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class="fw-bold fs-7  text-secondary">Transactions</span>
                        </div>
                    </div>
                </li>
            </a>

            <a class="text-decoration-none" href="{{route('calculator')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('calculator') ? 'bg-selected fade-in fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center  ">
                            <img src="{{asset('icons/calculator.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class=" fw-bold fs-7 text-secondary">Calculator</span>
                        </div>
                    </div>
                </li>
            </a>


        <div class="ms-3 d-flex align-items-end mt-1">
            <div class="row g-0  w-100">
                <div class="col-12 border-top">
                    {{--  <i class="bi bi-list pe-4" style="color: #1030DA"></i> --}}
                    <div class="dropdown">
                    <a class="btn dropdown w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list pe-4" style="color: #1030DA"></i>More
                    </a>

                    <ul class="dropdown-menu border p-2" style="width: 110%">
                        <li><a class="dropdown-item rounded" href="/logout">Log out</a></li>
                    </div>
                </div>
            </div>
        </div>

    </div>
