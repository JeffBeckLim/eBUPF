@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" style="scale: 0.95;">

    <div class="row">
        <div class="col-12 mb-3">
            @if (session('passed'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('passed')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('warning')}}
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
                <div class="fs-7 py-2 ms-1" >
                    <a href="{{route('admin.ledgers')}}" class="text-decoration-none text-secondary fw-bold">Ledgers 
                        <i class="bi bi-chevron-right"></i>
                    </a> 
                    <span class="fw-bold">
                        <a  class="text-decoration-none text-secondary fw-bold" href="/admin/ledgers/member/mpl/{{$loan->member->id}}">
                            {{$loan->member->firstname}} {{$loan->member->lastname}} <span style="font-size: x-small">{{$loan->member->units->unit_code}} | {{$loan->member->units->campuses->campus_code}} 
                        </a>
                        <i class="bi bi-chevron-right"></i>
                    </span>
                    <span class="fw-bold">
                        <a  class="text-decoration-none text-secondary fw-bold text-dark">
                            {{$loan->loan_code}} 
                        </a>
                    </span>
                </div>

                {{-- <a class="btn text-decoration-none text-dark" href="/admin/ledgers/member/{{strtolower($loan->LoanType->loan_type_name)}}/{{$loan->member->id}}">
                    <i class="bi bi-arrow-left-short"></i>Go back
                </a> --}}
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
                    @php
                    $sum = 0;
                        foreach ($loan->penalty as $penalty) {
                        $sum += $penalty->penalty_total;
                        }
                    @endphp
                @endif

                @if($sum - $sumPenaltyPayments != 0)
                    <a href="#penalty-div" class="mx-2"  data-bs-toggle="tooltip" data-bs-title="This loan has penalty" >
                        <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="">
                    </a>
                @endif
               {{--  @if ($loan->penalty )
                    <a href="#penalty-div" class="mx-2"  data-bs-toggle="tooltip" data-bs-title="This loan has penalty" >
                        <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="">
                    </a>
                @endif --}}
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
                            $dateString = $loan->amortization->amort_start;
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
                    <div class="col-4 pl-text-size">
                        {{$totalUniquePayments}}
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
                    <div class="col-4 pl-text-size">
                        {{$monthsDifference - $totalUniquePayments}}
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

                    @php
                        $recordStart = $amort_start->copy()->subMonth()->format('Y');
                        $recordEnd = $amort_end->format('Y');
                    @endphp
                    @for ($x = $recordEnd; $x >= $recordStart; $x--)
                        <th colspan="2" style="text-align: center;">{{{$x}}}</th>
                    @endfor
                </tr>
                <tr class="pl-tr" style="border-bottom: 1px solid black">
                    <th>Month</th>
                    @for ( $i=-1; $i < $loan->term_years; $i++)
                        <th class="fw-normal">Principal</th>
                        <th class="fw-normal">Interest</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for ($x = 0; $x < count($months); $x++)
                    <tr>
                        <td class="border-start border">{{$months[$x]}}</td>
                        @for ($i = $recordEnd; $i >= $recordStart; $i--)
                            @php
                                $targetMonth = $months[$x];
                                $targetYear = $i;
                                $amortStartYear = $amort_start->copy()->addMonths($i * 12)->format('Y');
                                $paymentCount = isset($filteredPayments[$targetYear][$targetMonth]) ? count($filteredPayments[$targetYear][$targetMonth]) : 0;
                                $principal = 0;
                                $interest = 0;

                                if(isset($filteredPayments[$targetYear][$targetMonth])){
                                    foreach($filteredPayments[$targetYear][$targetMonth] as $payment){
                                        $principal += $payment->principal;
                                        $interest += $payment->interest;
                                    }
                                }
                            @endphp

                            @if($paymentCount > 0)
                                <td style="text-align: center;">
                                    {{ number_format($principal, 2, '.', ',') }}

                                    @foreach ($loan->penalty as $penalty)
                                    @php

                                          $penalty_payment_instance = App\Models\PenaltyPayment::where('penalty_id', $penalty->id)->sum('penalty_payment_amount');
                                    @endphp
                                        @if ($penalty->penalized_month == $x+1 &&
                                            $penalty->penalized_year == $i)
                                            <h6 style="font-size: 12px" class="{{$penalty_payment_instance >= $penalty->penalty_total ? 'd-none' : 'text-danger'}} text-start">Penalty

                                            @if ($penalty_payment_instance >= $penalty->penalty_total)
                                                (Paid)
                                            @else
                                                ( {{$penalty->penalty_total}} )
                                                {{-- CHECK IF PAYMENT NOT ZERO THE DONT DISPALY --}}
                                                @if ($penalty_payment_instance > 0)
                                                , Paid {{$penalty_payment_instance}}
                                                @endif
                                            @endif


                                            </h6>

                                        @endif
                                    @endforeach

                                </td>
                                <td style="text-align: center;">{{ number_format($interest, 2, '.', ',') }}
                                </td>
                            @elseif($amortStartSubMonth->format('F') === $targetMonth && $amortStartSubMonth->year == $targetYear)
                                <td colspan="2" style="text-align: center; font-weight: bold;" class="fs-6">Loan Granted</td>
                            @else
                                <td colspan="2">
                                    @foreach ($loan->penalty as $penalty)
                                    @php

                                          $penalty_payment_instance = App\Models\PenaltyPayment::where('penalty_id', $penalty->id)->sum('penalty_payment_amount');
                                    @endphp
                                        @if ($penalty->penalized_month == $x+1 &&
                                            $penalty->penalized_year == $i)
                                            <h6 style="font-size: 12px" class="text-danger">No payment w/ penalty

                                            @if ($penalty_payment_instance >= $penalty->penalty_total)
                                                (Paid)
                                            @else
                                                ( {{$penalty->penalty_total}} )
                                                {{-- CHECK IF PAYMENT NOT ZERO THE DONT DISPALY --}}
                                                @if ($penalty_payment_instance > 0)
                                                , Paid {{$penalty_payment_instance}}
                                                @endif
                                            @endif


                                            </h6>

                                        @endif
                                    @endforeach
                                </td> {{-- Empty cell, No Payment--}}
                            @endif
                        @endfor
                    </tr>
                @endfor

                    <tr>
                        <td style="border-top: 2px solid black; font-weight: bold;">Total</td>
                        @for ($i = $recordEnd; $i >= $recordStart; $i--)
                            @php
                                $targetYear = $i;
                                $principalTotal = 0;
                                $interestTotal = 0;
                                //get the totals
                                if(isset($filteredPayments[$targetYear])){
                                    foreach($filteredPayments[$targetYear] as $month){
                                        foreach($month as $payment){
                                            $principalTotal += $payment->principal;
                                            $interestTotal += $payment->interest;
                                        }
                                    }
                                }
                            @endphp
                            <td style="border-top: 2px solid black; font-weight: bold; text-align: center;">
                                @if ($principalTotal)
                                {{ number_format($principalTotal, 2,'.' , ',') }}
                                @endif
                            </td>
                            <td style="border-top: 2px solid black; font-weight: bold; text-align: center;">
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
{{-- @include('admin-views.admin-ledgers.modal-penalty') --}}

@if ($loan->penalty != null)
    @include('admin-views.admin-ledgers.modal-penalty-payment')
@endif

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

@endsection
