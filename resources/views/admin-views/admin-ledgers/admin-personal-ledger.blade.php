@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" style="scale: 0.95;">

    <div class="row">
        <div class="col-12 mb-3">
            @if (session('passed'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{session('passed')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('penalty_total')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            @error('penalty_payment_amount')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            @error('payment_date')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

            <div class="mb-2">

                <a class="btn text-decoration-none text-dark" href="/admin/ledgers/member/{{strtolower($loan->LoanType->loan_type_name)}}/{{$loan->member->id}}">
                    <i class="bi bi-arrow-left-short"></i>Go back
                </a>
            </div>
            <div class="d-flex">

                <div>
                    <img src="{{$loan->member->profile_picture != null ?asset('storage/'.$loan->member->profile_picture) : asset('assets/no_profile_picture.jpg') }}" alt="" style="height: 50px; width: 50px; object-fit: cover;" class="border rounded-circle">
                </div>
                <div class="pt-1 ms-2">
                    <h6 class="m-0 fw-bold">
                        {{$loan->member->lastname}}, {{$loan->member->firstname}}
                    </h6>
                    {{$loan->member->units->unit_code}}
                </div>
            </div>

        </div>
        <h6 class="text-secondary" style="font-size: small">Personal Ledger</h6>
        <div class="col-md-6 d-flex gap-2">
            <h3 class="pl-head">
                {{$loan->loanType->loan_type_name}}
                <i class="bi bi-caret-right-fill"></i>
                <span style="font-size: 14px">ID</span>
                <span>{{$loan->id}}</span>
            </h3>
            
            @if (($principal_paid + $interest_paid)/($loan->principal_amount + $loan->interest) < 0.5)
                <p class="pl-50 d-flex justify-content-center align-items-center py-1 text-danger">
                    Paid
                    {{number_format(($principal_paid + $interest_paid)/($loan->principal_amount + $loan->interest)*100, 2 ,'.',',')}}%
                </p>
            @elseif (($principal_paid + $interest_paid)/($loan->principal_amount + $loan->interest) > 0.5)
                <p class="pl-50-plus d-flex justify-content-center align-items-center py-1 ">
                    Paid
                    {{number_format(($principal_paid + $interest_paid)/($loan->principal_amount + $loan->interest)*100, 2 ,'.',',')}}%
                </p>
            @endif


        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">

                @if ($loan->penalty)
                    <a href="#penalty-div" class="mx-2"  data-bs-toggle="tooltip" data-bs-title="This loan has penalty" >
                        <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="">
                    </a>
                @endif
                {{-- <span class="badge rounded-pill  w-25 d-flex align-items-center justify-content-center" style="background-color: #dd5858; font-size: 12px;">Primary</span> --}}

                    @php
                        if ($loan->is_active == 1){
                            $color = "0092D1";
                        }
                        elseif ($loan->is_active == 2){
                            $color = "6a9577";
                        }
                        else{
                            $color = "dd5858";
                        }
                    @endphp
                    <span class="badge rounded-pill  w-25 d-flex align-items-center justify-content-center" style="background-color: #{{$color}}; font-size: 12px;">
                        @if ($loan->is_active == 1)
                            Performing
                        @elseif ($loan->is_active == 2)
                            Closed
                        @else
                            Not Specified
                        @endif
                    </span>



                <div class="dropdown ms-2">
                    <button  class="btn ps-4  fw-bold bu-orange text-white rounded-pill h-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="font-size: 12px;">{{$loan->loanType->loan_type_description}} {{$loan->id}}<img class="ms-3"  src="{{asset('assets/caret-down-white.svg')}}" style="width: 10px;" ></span>
                    </button>
                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" style="font-size: 14px">
                        @foreach ($memberLoans as $memberLoan)
                        @php
                            $amort_start_here = \Carbon\Carbon::parse($memberLoan->amortization->amort_start);
                        @endphp
                            <a class="dropdown-item" href="/admin/ledgers/personal-ledger/{{$memberLoan->id}}">{{$memberLoan->loanType->loan_type_description}} {{$memberLoan->id}}
                            <p>{{$amort_start_here->format('M Y')}}</p>
                            </a>
                        @endforeach
                        {{-- <a class="dropdown-item" href="#">Multi-Purpose 2</a>
                        <a class="dropdown-item" href="#">Housing loan 1</a>
                        <a class="dropdown-item" href="#">Multi-Purpose 1</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pl-details mt-2 border pt-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-12 text-center fw-bold">
                        <p style="letter-spacing: 1px; font-size: small">LOAN DETAILS</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size "><span class="fw-bold">Principal: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($loan->principal_amount, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($loan->interest, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Amort. Prin.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($loan->amortization->amort_principal, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($loan->amortization->amort_interest, 2, '.', ',')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-12 text-center fw-bold">
                        <p style="letter-spacing: 1px; font-size: small">OTHER DETAILS</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Loan Grant: </span></p>
                    </div>
                    <div class="col-4">
                        {{-- if naka base sa loan --}}
                        {{-- @foreach ($loan->loanApplicationStatus as $status)
                            @if ($status->loan_application_state_id == 5)
                                <p class="pl-text-size">{{ $status->created_at->format('M Y') }}</p>
                            @endif
                        @endforeach --}}
                        @php
                            $dateString = $loan->amortization->amort_start; // Assuming this is a date string in 'YYYY-MM-DD' format
                            $date = \Carbon\Carbon::parse($dateString); // Parse the date string into a Carbon date object

                            // Subtract one month
                            $oneMonthAgo = $date->subMonth();

                            // You can format and display the result
                            // echo $oneMonthAgo->format('Y-m-d'); // Format as 'YYYY-MM-DD' or any format you prefer
                        @endphp
                        <p class="pl-text-size">{{ $oneMonthAgo->format('M Y') }}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Amort. Period: </span></p>
                    </div>
                    @php
                        $amort_start = \Carbon\Carbon::parse($loan->amortization->amort_start);
                        $amort_end = \Carbon\Carbon::parse($loan->amortization->amort_end);
                    @endphp
                    <div class="col-4">
                        <p class="pl-text-size">{{$amort_start->format('M Y')}} | {{$amort_end->format('M Y')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Term (Year): </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->term_years}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Term (Month): </span></p>
                    </div>
                    @php
                        // Parse the start and end dates as Carbon objects
                        $carbonStartDate = Carbon\Carbon::parse($loan->amortization->amort_start);
                        $carbonEndDate = Carbon\Carbon::parse($loan->amortization->amort_end);

                        $amortStartSubMonth = Carbon\Carbon::parse($carbonStartDate->subMonth());

                        // Calculate the difference in months
                        $monthsDifference = $carbonStartDate->diffInMonths($carbonEndDate);
                    @endphp
                    <div class="col-4">
                        <p class="pl-text-size">{{$monthsDifference}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-12 text-center fw-bold">
                        <p style="letter-spacing: 1px; font-size: small">PAYMENT DETAILS</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($principal_paid, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($interest_paid, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($interest_paid + $principal_paid, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Paid: </span></p>
                    </div>
                    <div class="col-4">
                        @if ($latest_payment != null)
                        @php
                            // Parse the start and end dates as Carbon objects
                            $latestPayment = Carbon\Carbon::parse($latest_payment->payment_date);
                            // Calculate the difference in months
                            $monthsDifferencePayment = $monthsDifference - $latestPayment->diffInMonths($carbonEndDate) - 1;
                         @endphp
                        <p class="pl-text-size">{{$monthsDifferencePayment}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row ">
                    <div class="col-12 text-center fw-bold">
                        <p style="letter-spacing: 1px; font-size: small">OTHER PAYMENT DETAILS</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Bal.: </span></p>
                    </div>
                    <div class="col-4 ">
                        <p class="pl-text-size">{{number_format($loan->principal_amount - $principal_paid, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{number_format($loan->interest - $interest_paid, 2, '.', ',')}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">
                            {{
                                number_format(
                              ($loan->interest - $interest_paid)  +
                              ($loan->principal_amount - $principal_paid)
                              , 2, '.', ',')
                            }}
                        </p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Left: </span></p>
                    </div>
                    <div class="col-4">
                        @if ($latest_payment != null)
                        <p class="pl-text-size">{{$monthsDifferencePayment = $latestPayment->diffInMonths($carbonEndDate)}}</p>
                        @else
                        {{$monthsDifference}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container border rounded-3 pt-3 bg-white">
        <table class="table fixed-width-table pl-table">
            <thead>
                <tr class="pl-tr">
                    <th class="text-center">
                        @if($loan->loanCategory)
                            <span style="color: #a01a1a; letter-spacing: 2px">{{strtoupper($loan->loanCategory->loan_category_name)}}</span>
                        @else
                            <h6 style="font-size: 12px" class="m-0">Loan type: <br>not specified.</h6>
                        @endif


                    </th>

                    @for ($x = $loan->term_years; $x != 0; $x--)
                        <th colspan="2">{{$amort_start->copy()->addMonths($x * 12)->format('Y');}}</th>
                    @endfor

                    <th colspan="2">{{$amort_start->format(' Y')}}</th>
                    {{-- <th colspan="2">2027</th>
                    <th colspan="2">2026</th>
                    <th colspan="2">2025</th>
                    <th colspan="2">2024</th>
                    <th colspan="2">2023</th>
                    <th colspan="2">2022</th> --}}
                </tr>
                <tr class="pl-tr" style="border-bottom: 1px solid black">
                    <th>Month</th>
                    @for ( $i=-1; $i < $loan->term_years; $i++)
                        <th class="fw-normal">Principal</th>
                        <th class="fw-normal">Interest</th>
                    @endfor

                    {{-- <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th> --}}
                </tr>
            </thead>
            <tbody>
                @for ($x = 0; $x < count($months); $x++)

                    <tr class="pl-tr">
                        <td>{{$months[$x]}}</td>
                        @for($i = $loan->term_years; $i != -1; $i--)
                            @php
                                $targetMonth = $x+1;
                                $targetYear = $amort_start->copy()->addMonths($i * 12)->format('Y');

                                $filteredPayments =  App\Models\Payment::whereYear('payment_date', $targetYear)
                                ->whereMonth('payment_date', $targetMonth)->where('loan_id', $loan->id)
                                ->get();
                            @endphp
                            <td>
                                @if ($amortStartSubMonth->month == $targetMonth
                                && $amortStartSubMonth->year == $targetYear)
                                    <h6 class="fw-bold text-primary" style="font-size: 14px">Loan Granted</h6>
                                @endif

                                @if ($filteredPayments != null)
                                    @php
                                        $totalPrincipal = null;
                                        $num_payments = null;
                                        foreach ($filteredPayments as $filteredPayment){
                                            $totalPrincipal += $filteredPayment->principal;

                                            if ($filteredPayment->principal > 0) {
                                                $num_payments++;
                                            }
                                        }
                                    @endphp
                                    @if ($totalPrincipal != 0)
                                        @if ($num_payments > 1)
                                            <a class="text-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-title="{{$num_payments}} separate payments">{{number_format($totalPrincipal, 2, '.',',')}}</a>
                                        @else
                                            <a class="text-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-title="{{$num_payments}} payment">{{number_format($totalPrincipal, 2, '.',',')}}</a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td >
                                @if ($filteredPayments != null)
                                @php
                                    $totalInterest = null;
                                    $num_payments = null;
                                    foreach ($filteredPayments as $filteredPayment){
                                        $totalInterest += $filteredPayment->interest;
                                        $num_payments++;

                                    }
                                @endphp
                                @if ($totalInterest != 0)
                                    @if ($num_payments > 1)
                                        <a class=" text-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-title="{{$num_payments}} separate payments">{{number_format($totalInterest, 2, '.',',')}}</a>
                                    @else
                                        <a class="text-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-title="{{$num_payments}} payment">{{number_format($totalInterest, 2, '.',',')}}</a>
                                    @endif
                                @endif
                                @endif
                            </td>
                        @endfor
                    </tr>


                @endfor
                {{-- TOTAL row --}}

                <tr class="pl-tr-last">
                    <td style="border-top: 2px solid black">Total</td>
                    @for($i = $loan->term_years; $i != -1; $i--)
                    @php
                        // $targetMonth = 12;
                        $targetYear = $amort_start->copy()->addMonths($i * 12)->format('Y');
                        $principalTotal =  App\Models\Payment::whereYear('payment_date', $targetYear)
                        ->where('loan_id', $loan->id)
                        ->sum('principal');

                        $interestTotal =  App\Models\Payment::whereYear('payment_date', $targetYear)
                        ->where('loan_id', $loan->id)
                        ->sum('interest');
                    @endphp
                    <td style="border-top: 2px solid black">
                        @if ($principalTotal)
                        {{ number_format($principalTotal, 2,'.' , ',') }}
                        @endif
                    </td>
                    <td style="border-top: 2px solid black">
                        @if ($interestTotal)
                        {{ number_format($interestTotal, 2, '.' , ',') }}
                        @endif

                    </td>
                    @endfor
                </tr>

            </tbody>
        </table>
    </div>
        {{-- FOR PENALTY --}}
        @include('admin-views.admin-ledgers.card-penalty')


</div>
@include('admin-views.admin-ledgers.modal-edit-penalty-payment')

  <!-- Penalty Modal -->
@include('admin-views.admin-ledgers.modal-penalty')

@if ($loan->penalty_id != null)
    @include('admin-views.admin-ledgers.modal-penalty-payment')
@endif

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

@endsection
