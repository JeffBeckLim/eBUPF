@extends('member-components.member-layout')

@section('content')

<main >
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col">
                <div class="card border col-lg-7 col-sm-12 mx-auto p-lg-4 p-3 pt-4">
                    <div class="col-12">
                        <p class="text-center fw-bold fs-5">Your Loans</p>
                    </div>
                    <div class="col-12 ">
                        <span class=" d-flex justify-content-center align-items-center">
                            <a href="#" class="px-3 text-decoration-none text-muted fw-bold"><p  class="fs-7 btn bu-orange text-light fw-bold rounded-pill">Permorning</p></a>
                            <a href="#" class="px-3 text-decoration-none text-muted fw-bold "><p  class="fs-7">Paid</p></a>
                            <a href="#" class="px-3 text-decoration-none text-muted fw-bold"><p class="fs-7">All Loans</p></a>
                        </span>
                    </div>
                    <div class="col-12 pt-4 pb-2">
                        <div class="row  align-items-center">
                            <div class="col-auto">
                              <label for="searcn-input" class="col-form-label">Search</label>
                            </div>
                            <div class="col flex-grow-1">
                              <input type="text" id="search-input" class="form-control search-input rounded-3" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border mb-3 rounded" style="padding:10px 0 2px 5px;">
                        <h6 class="text-secondary fs-7">
                            <i class="bi bi-lightbulb-fill"></i>
                            Here are the loans with the checks you've already claimed.
                        </h6>
                    </div>
                    @if (count($loans) != 0)

                    @foreach ($loans as $loan)
                    <!-- Status Card -->
                    <a href="{{route('loan.details', ['id' => $loan->loan_type_id])}}" class="text-decoration-none text-dark">
                        <div class="col-12 pb-3">
                            <div class="card rounded-4 shadow-sm">
                                <div class="row g-0 p-3">
                                    <div class="col m-0 d-flex justify-content-center">
                                        @if ($loan->loan_type_id == 1)
                                        <img src="{{asset('icons/MPL-mini.svg')}}" alt="mini mpl icon" style="width: 40%">
                                        @elseif ($loan->loan_type_id == 2)
                                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="mini hsl icon" style="width: 40%">
                                        @endif

                                    </div>
                                    <div class="col-lg-6 col-5 ">
                                        <p style="font-size: 95%;" class="fw-bold m-0">
                                            {{$loan->LoanType->loan_type_description}}
                                            <span class="fw-light" style="font-size: small">
                                            {{$loan->term_years}}
                                            @if ($loan->term_years > 1)
                                                years
                                            @else
                                                year
                                            @endif
                                            </span>
                                        </p>
                                        <p class="m-0" style="font-size: x-small;">
                                            @if($loan->amortization)
                                            {{date("F Y", strtotime($loan->amortization->amort_start))}}
                                             <span>
                                                -  {{date("F Y", strtotime($loan->amortization->amort_end))}} </span>
                                            @else
                                                No amortization period yet
                                            @endif
                                        </p>
                                        <p class="m-0 fw-bold mt-4" style="font-size:   small;">
                                            Monthly Payable
                                            <span class="fw-normal">
                                                @if($loan->amortization)
                                                Php {{number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.',',')}}
                                                @else
                                                No amortization yet.
                                                @endif
                                            </span>
                                        </p>
                                    </div>

                                    @php
                                        $paid = 0;
                                        foreach ($loan->payment as $payment) {
                                            $temp = $payment->principal + $payment->principal;
                                            $paid = $paid + $temp;
                                        }
                                    @endphp

                                    <div class="col-4 text-end ">
                                        <p  class="text3-1-design m-0">Outstanding Balance</p>
                                        <p class="fw-bold" ><span class="fw-light" style="font-size: small;">Php</span>
                                            {{
                                                number_format($loan->principal_amount + $loan->interest -$paid, 2, '.',',')
                                            }}
                                        </p>

                                    {{-- @php
                                        $endDate = Carbon\Carbon::parse($loan->amortization->amort_end);
                                        $currentDate = Carbon\Carbon::now();
                                        $monthsDifference = $endDate->diffInMonths($currentDate);

                                    @endphp
                                        <div class=" m-0">
                                            <p  class="text3-1-design m-0">Months to Pay</p>
                                            <p class="fw-bold m-0" style="font-size: small;">{{$monthsDifference}} Months</p>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @endforeach

                    @else

                    <div class="row">
                        <div class="col-12 p-5 text-center">
                            <p>You have no loans yet</p>
                            <img src="{{asset('icons/no-transaction.svg')}}" alt="" style="width: 200px">
                            <p class="mt-5" style="font-size: small">
                                Apply for a <a class="text-decoration-none" href="/member/mpl-application-form">Multi-purpose</a> or a <a class="text-decoration-none" href="/member/hsl-application-form">Housing Loan</a> loan today!</p>
                        </div>
                    </div>

                    @endif

                    <!-- Status Card -->


                    <!-- Status Card -->
                    {{-- <a href="#" class="text-decoration-none text-dark">
                        <div class="col-12 pb-3">
                            <div class="card bg-bugreen rounded-4 shadow-sm">
                                <div class="row g-0 p-3">
                                    <div class="col  d-flex justify-content-center">
                                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 40%;">
                                    </div>
                                    <div class="col-lg-6 col-5 ">
                                        <p class="fw-bold m-0">
                                            Housing Loan
                                        </p>
                                        <p class="m-0" style="font-size: x-small;">
                                            April 1, 2023 <span> - May 24, 2024</span>
                                        </p>
                                        <p class="m-0 fw-bold mt-4" style="font-size: small;">

                                            Monthly Payable
                                            <span class="fw-normal"> Php 200,000</span>
                                        </p>


                                    </div>
                                    <div class="col-4 text-end ">
                                        <span class="fw-bold text-success">
                                            Fully Paid <img src="{{asset('icons/check-icon.svg')}}" alt="check-icon">
                                        </span>
                                        <p  class="text3-1-design m-0 pt-3">Outstanding Balance</p>
                                        <p class=" fw-bold"><span class="fw-light" style="font-size: small;">Php</span> 0.00</p>

                                        <!-- <div class=" m-0">
                                            <p  class="text3-1-design m-0">Next Payment Due</p>
                                            <p class="fw-bold m-0" style="font-size: small;">May 1, 2023</p>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a> --}}



                </div>
            </div>

        </div>
    </div>


</main>

@endsection
