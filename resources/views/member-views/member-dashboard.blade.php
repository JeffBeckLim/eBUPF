@extends('member-components.member-layout')

@section('content')

    <div class="mt-3 mx-1 me-lg-2 mb-5">
                <div class="row g-2">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                @if($inActiveLoan)
                                    <div class="card" style="color: #545454; padding: 10px; margin-bottom: 6px;">
                                        <div class="d-flex">
                                            <img width="20" height="20" src="https://img.icons8.com/sf-regular/48/545454/high-priority.png"  alt="alert"/><span class="fw-bold" style="font-size: 12px; padding-top: 1px;"> You have a pending loan application. You won't be able to apply for another loan for now.</span>
                                        </div>
                                    </div>
                                @endif
                                    <div class="card" style="border-radius: 10px; border: 0.50px #ACACAC solid;">
                                        <div style="position: relative;" class="mb-2">
                                            <img class="w-100" style="height: 100px; border-radius: 9px;" src="assets/core-feature-bg.png" />
                                            <p class="text-white text-center" style="width: 100%; position: absolute; top: 47%; left: 50%; transform: translate(-50%, -50%); font-size: 0.9rem;">
                                                <?php
                                                    $mplTotalAmount = 0;
                                                    $hslTotalAmount = 0;

                                                    foreach ($loans as $loan) {
                                                        if ($loan->loan_type_id == 1) {
                                                            $mplTotalAmount += ($loan->principal_amount + $loan->interest);
                                                        } elseif ($loan->loan_type_id == 2) {
                                                            $hslTotalAmount += ($loan->principal_amount + $loan->interest);
                                                        }
                                                    }
                                                    $mplTotalBalance = $mplTotalAmount;
                                                    $hslTotalBalance = $hslTotalAmount;
                                                    foreach ($loans as $loan) {
                                                        if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id])){
                                                            $mplTotalBalance -= $totalPaymentMPL[$loan->id];
                                                        }
                                                        if(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id])){
                                                            $hslTotalBalance -= $totalPaymentHSL[$loan->id];
                                                        }
                                                    }
                                                ?>
                                                MPL ₱<span class="fw-bold">{{ number_format($mplTotalBalance, 2) }}</span>
                                                <span class="fw-bold fs-5">&nbsp;|&nbsp;</span> HSL ₱<span class="fw-bold">{{ number_format($hslTotalBalance, 2) }}</span>

                                            </p>
                                            <p class="text-white" style="position: absolute; top: 70%; left: 50%; transform: translate(-50%, -50%); font-size: 13px;">Total Outstanding Balance</p>
                                        </div>
                                        <div class="mb-2" style="min-height: 270px; max-height: 300px; overflow-y: auto;">
                                            @if ($loans->isEmpty())
                                                <div class="text-center align-items-center pt-5 pb-5 mt-5 mb-5" style="font-size: 16px">
                                                    You currently don't have active loans.
                                                </div>
                                            @else

                                                @php
                                                    $sortedLoans = $loans->sortBy('created_at');
                                                @endphp

                                                @foreach ($sortedLoans as $loan)
                                                        <a href="{{route('loan.details', ['id' => $loan->id])}}" style="text-decoration: none;">
                                                            <div class="p-3 row"  style="border-radius: 10px; border: 1px solid #DCDCDC; background: #FFF; margin: 12px 20px 12px;" class="card  g-0">
                                                                <div class="col-2 d-md-block d-none text-center my-auto">
                                                                    {{-- <div class="col-3 ps-2 d-flex justify-content-center align-items-start pe-2"> --}}
                                                                        @if ($loan->loan_type_id == 1)
                                                                        <img class="img-fluid" src="assets/MPL-mini.svg" alt="mpl mini" width="45px" height="45px">
                                                                        @else
                                                                        <img class="img-fluid" src="assets/HSL-mini.svg" alt="hsl mini" width="45px" height="45px">
                                                                        @endif
                                                                    {{-- </div> --}}
                                                                </div>

                                                                <div class="col">

                                                                    <div class="row  mt-2 g-0">
                                                                        <div class="col-8  g-0">
                                                                            <div class="row h-100 g-0">
                                                                                {{-- <div class="col-3 ps-2 d-flex justify-content-center align-items-start pe-2">
                                                                                    @if ($loan->loan_type_id == 1)
                                                                                    <img class="img-fluid" src="assets/MPL-mini.svg" alt="mpl mini" width="40px">
                                                                                    @else
                                                                                    <img class="img-fluid" src="assets/HSL-mini.svg" alt="hsl mini" width="40px">
                                                                                    @endif
                                                                                </div> --}}
                                                                                <div class="col-9">
                                                                                    <p class="myline-height">
                                                                                        @if ($loan->loan_type_id == 1)
                                                                                        <span class="text14-design">Multi-Purpose Loan
                                                                                        </span>
                                                                                        @else
                                                                                        <span class="text14-design">Housing Loan
                                                                                        </span>
                                                                                        @endif
                                                                                        @php
                                                                                            $sum = 0;
                                                                                                foreach ($loan->penalty as $penalty) {
                                                                                                $sum += $penalty->penalty_total;
                                                                                                }
                                                                                        @endphp

                                                                                        @if ($loan->penalty->count() != 0 && ($sum - $sumPenaltyPayments) != 0)
                                                                                        <span style="font-size: 12px" class="text-danger" title="This loan has penalty">
                                                                                            <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="Penalty Icon">
                                                                                        </span>
                                                                                    @endif
                                                                                        <br>
                                                                                        @if($loan->amortization)
                                                                                            <span class="text13-design" style="font-size: 12px !important;">
                                                                                                {{date("M Y", strtotime($loan->amortization->amort_start))}}
                                                                                                -  {{date("M Y", strtotime($loan->amortization->amort_end))}}
                                                                                            </span>
                                                                                        @else
                                                                                            <span class="text13-design">No amortization period yet</span>
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4 text-end">
                                                                            <p style="font-size: 13px" class=" m-0 text3-1-design">Outstanding Balance</p>
                                                                            <p style="font-size: 14px" class=" m-0 text-dark fw-bold"><span> Php </span>
                                                                            @if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id]))
                                                                            {{ number_format(($loan->principal_amount + $loan->interest) - $totalPaymentMPL[$loan->id], 2) }}
                                                                            @elseif(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id]))
                                                                            {{ number_format(($loan->principal_amount + $loan->interest) - $totalPaymentHSL[$loan->id], 2) }}
                                                                            @else
                                                                                {{ number_format(($loan->principal_amount + $loan->interest), 2) }}
                                                                            @endif
                                                                            </p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row mb-2 g-0 ">
                                                                        <div class="col-6 ">
                                                                            <span class="text11-design fw-bold p-0">Monthly Payable </span> <span class="text12-design p-0">
                                                                                @if($loan->amortization)
                                                                                    Php {{number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.',',')}}
                                                                                @else
                                                                                    No amortization yet.
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-6  text-end" style="line-height: 90%">
                                                                            @php
                                                                                $years = $loan->remainingMonths / 12;
                                                                                
                                                                                $months = $loan->remainingMonths%12
                                                                            @endphp 
                                                                            
                                                                            @if ($years < 1)
                                                                                <span class="text11-design fw-bold p-0">
                                                                                {{$loan->remainingMonths}}
                                                                                </span>  
                                                                                <span class="text12-design p-0">month{{$loan->remainingMonths>1? 's': ''}} to pay</span>
                                                                            @elseif ($years > 1)
                                                                                <span class="text11-design fw-bold p-0">
                                                                                {{(int)$years}}
                                                                                <span class="fw-light text12-design p-0">year{{$years>1? 's' : ''}} 
                                                                                    
                                                                                </span>
                                                                                @if ($months >= 1)
                                                                                    &
                                                                                    {{$months}} 
                                                                                    <span class="text12-design p-0 fw-light">months to pay</span>
                                                                                    </span>      
                                                                                @endif
                                                                            @endif

                                                                           
                                                                           
                                                                        </div>
                                                                        <div class="col-12  mt-1 text-end text-secondary" style="font-size: 11px">
                                                                            Code: <span class="fw-bold">{{$loan->loan_code}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                @endforeach
                                            @endif
                                        </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 ">
                                <div style="background: white; border-radius: 10px; border: 0.50px #ACACAC solid;">
                                    <div class="container">
                                        <div class="row mt-2 mx-lg-2">

                                            <div class="col-md-4 pt-2">
                                                <p class="fs-6 fw-bold ">Loan Application</p>
                                            </div>
                                            <div class="col-md-8 gap-2 d-flex justify-content-end">
                                                <a href="/member/mpl-application-form/" type="button" class="btn border text-start d-flex shadow-sm grow-on-hover"
                                                   @if ($mplDisabled)
                                                       disabled
                                                       style="pointer-events: none; opacity: 0.6;"
                                                    @endif
                                                >
                                                    <img class="img-fluid" src="assets/MPL-mini.svg" alt="mpl mini" width="30px">
                                                    <div class="ps-2">
                                                        <h6 style="font-size: 10px">Apply</h6>
                                                        <strong style="font-size: 12px">Multi-Purpose Loan</strong>
                                                    </div>
                                                </a>

                                                <a href="/member/hsl-application-form/" type="button" class="btn border text-start d-flex shadow-sm grow-on-hover"
                                                @if ($hslDisabled)
                                                       disabled
                                                       style="pointer-events: none; opacity: 0.6;"
                                                   @endif
                                                >
                                                    <img class="img-fluid" src="assets/HSL-mini.svg" alt="mpl mini" width="30px">
                                                    <div class="ps-2">
                                                        <h6 style="font-size: 10px">Apply</h6>
                                                        <strong style="font-size: 12px">Housing Loan</strong>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-center mt-4 mx-lg-3 m-1">
                                            @if ($inActiveLoan)
                                                <div class="w-100 border bg-white rounded px-3 pt-2 pb-4 mb-2 shadow-sm">
                                                    <div class="row  mt-2 g-0 ">
                                                        <div class="col-12 mb-1" style="font-size: 12px">
                                                            Code: <span class="fw-bold">{{$inActiveLoan->loan->loan_code}}</span>
                                                        </div>
                                                        <div class="col-lg-3 col-12   border rounded px-2 pt-2 pb-2">
                                                            @php
                                                                $status_array=[];
                                                                foreach ($inActiveLoan->loan->loanApplicationStatus as $status) {
                                                                    array_push($status_array, $status->loan_application_state_id);
                                                                }
                                                            @endphp

                                                            @if ($inActiveLoan->loan->deleted_at != null)
                                                            <span style="font-size: small;" class="fw-bold text-danger">Cancelled</span>
                                                        @elseif ($inActiveLoan->loan->is_active == 1)
                                                            <span style="font-size: small;" class="fw-bold text-primary">Performing</span>
                                                        @elseif($inActiveLoan->loan->is_active == 2)
                                                            <span style="font-size: small;" class="fw-bold {{$inActiveLoan->loan->deleted_at == null ? 'd-none' : ''}}">Non-performing</span>
                                                        @endif

                                                        @if(in_array(6, $status_array))
                                                            <span style="font-size: small;" class="fw-bold text-danger">Declined</span>
                                                        @endif

                                                        @if ($inActiveLoan->loan->is_active == null)
                                                        @php
                                                            $co_borrower = App\Models\CoBorrower::where('loan_id', $inActiveLoan->id)->first();
                                                        @endphp
                                                            @if ($co_borrower->accept_request  != 1)
                                                                <h6 class="me-1" style="font-size: 12px">No approval from co-borrower</h6>
                                                            @elseif(in_array(6,$status_array))
                                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1"  style="color: red"></i><span class="text-danger">Denied</span></p>
                                                            @elseif(in_array(5,$status_array))
                                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: #0092D1"></i><span class="text-primary">Check Picked Up</span></p>
                                                            @elseif(in_array(4,$status_array))
                                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: #b700ff"></i><span style="color: #77028f">Check Ready</span></p>
                                                            @elseif(in_array(3,$status_array))
                                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: green"></i><span class="text-success">Approved</span></p>
                                                            @elseif(count($status_array) == 0)
                                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: rgb(0, 0, 0)"></i><span class="text-success">Not yet submitted</span></p>
                                                            @else
                                                                <p class="text16-design m-0 text-secondary"><i class="bi bi-circle-fill me-1"></i><span class="text-secondary">Being Processed</span></p>
                                                            @endif

                                                        @endif
                                                            <p class="fw-bold text m-0" style="font-size: small">{{$inActiveLoan->loan->loanType->loan_type_description}}</p>
                                                        </div>
                                                        <div class="col-lg-3 col-3 text-center">
                                                            <p class="text16-design">{{$inActiveLoan->created_at->format('F j, Y')}}</p>
                                                        </div>


                                                        <div class="col-lg-4 col-5 ">
                                                            <p class=" text15-design m-0">Request</p>
                                                            <p class="text17-design ">
                                                                <span class="fw-light fw-bold">
                                                                    Php{{number_format($inActiveLoan->loan->principal_amount, 2, '.',',')}}
                                                                </span>
                                                            </p>
                                                        </div>


                                                        <div class="col-lg-2 col-4 ">
                                                            <p class="text15-design m-0"> Year{{$inActiveLoan->loan->term_years > 1 ? 's': ''}} to Pay</p>
                                                            <p class="text17-design">{{$inActiveLoan->loan->term_years}} Year{{$inActiveLoan->loan->term_years > 1 ? 's': ''}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row g-0">
                                                        <div class="col-8">
                                                            <p class="m-0 ps-2 mt-2" style="font-size:small">Co-Borrower</p>
                                                            <div class="row g-0">
                                                                <div class="col  mt-1 d-flex">
                                                                    <img class="rounded-circle mx-2" src="{{

                                                                        $inActiveLoan->member->profile_picture != null ?
                                                                        asset('storage/'.$inActiveLoan->member->profile_picture) : asset('assets/no_profile_picture.jpg')
                                                                        }}" alt="Default Picture" style="height: 2.5rem; width: 2.5rem;">
                                                                    <span class="fw-bold fs-7 my-auto">
                                                                        {{$inActiveLoan->member->firstname}}
                                                                        {{$inActiveLoan->member->lastname}}
                                                                        <br>
                                                                        <span class="fw-light">
                                                                            BU - {{$inActiveLoan->member->units->unit_code}}
                                                                        </span>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-4 d-flex justify-content-end align-items-end">
                                                            <a href="{{route('loan.application.status', $inActiveLoan->loan->id)}}" type="button" class="btn status-btn bu-orange text-light">View Status</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else
                                                <div class="w-100 border bg-white rounded pt-5 pb-5 mb-2 shadow-sm d-flex justify-content-center align-items-center text-center" style="font-size: 16px">
                                                    You currently don't have pending loan application.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 transactions">

                        @if($transactions->isEmpty() == false)
                            <div class="shadow-sm" style="border-radius: 10px; border: 1px solid #AAA; background: #FFF; height: 100%; width: 100%;">
                                <div class="container">
                                    <div class="mt-3">
                                        <span class="fw-bold fs-6">Transactions</span>
                                    </div>

                                    <div class="mt-3 transaction-container" id="transaction-container"
                                        @if($inActiveLoan)
                                            style="height: 670px;"
                                        @else
                                            style="height: 550px;"
                                        @endif
                                    >
                                        @foreach($transactions as $transaction)
                                            @if($transaction instanceof \App\Models\Payment)
                                                <div class="col-12 border-bottom border-top">
                                                    <div class="row" style="padding: 0 30px 0 10px;">
                                                        <div class="col-7 my-1">
                                                            <p class="fs-7 fw-bold m-0">Loan Payment</p>
                                                            <p class="m-0" style="font-size: 11px;"> {{ date('M Y', strtotime($transaction->payment_date)) }}
                                                            </p>
                                                        </div>
                                                        <div class="col-4 my-1">
                                                            <p class="fs-7 fw-bold m-0">Php {{ number_format($transaction->principal + $transaction->interest, 2) }}</p>
                                                        </div>
                                                        <div class="col-1 my-1">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#paymentTransaction{{$transaction->id}}">
                                                                <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($transaction instanceof \App\Models\PenaltyPayment)
                                                <div class="col-12 border-bottom border-top">
                                                    <div class="row" style="padding: 0 30px 0 10px;">
                                                        <div class="col-7 my-1">
                                                            <p class="fs-7 fw-bold m-0">Loan Penalty Payment</p>
                                                            <p class="m-0" style="font-size: 11px;">{{ $transaction->created_at->format('F d, Y, h:i A') }}</p>
                                                        </div>
                                                        <div class="col-4 my-1">
                                                            <p class="fs-7 fw-bold m-0">Php
                                                                {{ number_format($transaction->penalty_payment_amount, 2) }}
                                                            </p>
                                                        </div>
                                                        <div class="col-1 my-1">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#paymentPenaltyModal{{$transaction->id}}">
                                                                <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($transaction instanceof \App\Models\Loan)
                                                <div class="col-12 border-bottom border-top">
                                                    <div class="row" style="padding: 0 30px 0 10px;">
                                                        <div class="col-7 my-1">
                                                            <p class="fs-7 fw-bold m-0" style="font-size: 14px">Applied a loan</p>
                                                            <p class="m-0" style="font-size: 11px;">{{ $transaction->created_at->format('F d, Y, h:i A') }}</p>
                                                        </div>
                                                        <div class="col-4 my-1">
                                                            <p class="fs-7 fw-bold">
                                                                @if($transaction->loanType->loan_type_description == 'Multi-purpose Loan')
                                                                    MPL
                                                                @elseif($transaction->loanType->loan_type_description == 'Housing Loan')
                                                                    HL
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-1 my-1">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#loanTransaction{{$transaction->id}}">
                                                                <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div style="border-radius: 10px; border: 1px solid #AAA; background: #FFF; height: 100%; width: 100%; ">
                                <div class="container">
                                    <div class="mt-3">
                                        <img src="assets/history.svg" alt="history icon" width="35px">
                                        <span class="fw-bold fs-6">Transactions</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-content-center">
                                        <img src="assets/no-transaction.svg" alt="no transaction icon" width="150px" style="margin-top: 80px;">
                                    </div>
                                    <p class="text-center">No transaction</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    @foreach($transactions as $transaction)
                        @include('member-views.payment-transaction-modal')
                    @endforeach

                    {{-- foreach transaction on loan --}}
                    @foreach ($transactions as $transaction)
                        @if($transaction instanceof \App\Models\Loan)
                            @if($transaction->co_borrower)
                                @foreach ($transaction->co_borrower as $co_borrower)
                                    @include('member-views.loan-transaction-modal')
                                @endforeach
                            @endif
                        @endif
                    @endforeach

                    @foreach ($transactions as $transaction)
                        @if($transaction instanceof \App\Models\PenaltyPayment)

                            @include('member-views.loan-penalty-payment-modal')

                        @endif
                    @endforeach
                    {{-- <div class="col-md-5 transactions mb-5">
                        <div class="container mt-3 ">

                        </div>
                    </div> --}}
                </div>
    </div>

@endsection
