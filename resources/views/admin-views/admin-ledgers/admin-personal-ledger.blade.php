@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" style="scale: 0.95;">
    <div class="row">
        <div class="col-md-6 d-flex gap-2">
            <h3 class="pl-head">Personal Ledger</h3>
            <p class="pl-50 d-flex justify-content-center align-items-center">Not Paid 50%</p>
        </div>
        <div class="col-md-6 ">
            <div class="d-flex justify-content-end">
                <span class="badge rounded-pill  w-25 d-flex align-items-center justify-content-center" style="background-color: #0092D1; font-size: 12px;">Primary</span>
                
                <div class="dropdown ms-2">
                    <button  class="btn ps-4  fw-bold bu-orange text-white rounded-pill " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="font-size: 12px;">Multi-Purpose Loan 3 <img class="ms-3"  src="{{asset('icons/caret-down-white.svg')}}" style="width: 10px;" ></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: 14px">
                        <a class="dropdown-item" href="#">Multi-Purpose 2</a>
                        <a class="dropdown-item" href="#">Housing loan 1</a>
                        <a class="dropdown-item" href="#">Multi-Purpose 1</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pl-details mt-2">
        <div class="row">
            <div class="col-lg-3 ">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size "><span class="fw-bold">Principal: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->principal_amount}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->interest}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Amort. Prin.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->amortization->amort_principal}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->amortization->amort_interest}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
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

                        // Calculate the difference in months
                        $monthsDifference = $carbonStartDate->diffInMonths($carbonEndDate) + 1;
                    @endphp
                    <div class="col-4">
                        <p class="pl-text-size">{{$monthsDifference}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$principal_paid}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$interest_paid}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$interest_paid + $principal_paid}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Paid: </span></p>
                    </div>
                    <div class="col-4">
                        @php
                            // Parse the start and end dates as Carbon objects
                            $latestPayment = Carbon\Carbon::parse($latest_payment->payment_date);
                            // Calculate the difference in months
                            $monthsDifferencePayment = $monthsDifference - $latestPayment->diffInMonths($carbonEndDate);
                         @endphp
                        <p class="pl-text-size">{{$monthsDifferencePayment}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row ">
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Bal.: </span></p>
                    </div>
                    <div class="col-4 ">
                        <p class="pl-text-size">{{$loan->principal_amount - $principal_paid}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$loan->interest - $interest_paid}}</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">
                            {{
                              ($loan->interest - $interest_paid)  + 
                              ($loan->principal_amount - $principal_paid)
                            }}
                        </p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Left: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">{{$monthsDifferencePayment = $latestPayment->diffInMonths($carbonEndDate)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container border rounded-3">
        <table class="table fixed-width-table pl-table">
            <thead>
                <tr class="pl-tr">
                    <th></th>
                    <th colspan="2">2027</th>
                    <th colspan="2">2026</th>
                    <th colspan="2">2025</th>
                    <th colspan="2">2024</th>
                    <th colspan="2">2023</th>
                    <th colspan="2">2022</th>
                </tr>
                <tr class="pl-tr" style="border-bottom: 1px solid black">
                    <th>Month</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                </tr>
            </thead>
            <tbody>
                <tr class="pl-tr">
                    <td>January</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>3,333.33</td>
                    <td>600.00</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>February</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>March</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>April</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>May</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>June</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>July</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>August</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>September</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>October</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>November</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>December</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-danger fw-bolder">Loan Granted</td>
                </tr>
                <tr class="pl-tr-last">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>3,333.33</td>
                    <td>600.00</td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


@endsection