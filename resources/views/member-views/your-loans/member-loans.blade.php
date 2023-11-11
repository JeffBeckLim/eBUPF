@extends('member-components.member-layout')

@section('content')

<main class=" ms-2">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col p-0">
                <div class="card border col-lg-7 col-sm-12 mx-auto p-lg-4 p-3 pt-4 my-2">
                    <div class="col-12">
                        <p class="text-center fw-bold fs-5">Your Loans</p>
                    </div>
                    <div class="col-12">
                        <span class="d-flex justify-content-center align-items-center">
                            <a href="{{route('member.loans', 1)}}" class="fs-7 px-3 text-decoration-none fw-bold {{$loan_status == 1 ? 'fs-7 btn bu-orange text-light fw-bold rounded-pill' : ''}}"  style="color: rgb(55, 55, 55);">
                                Permorning
                            </a>
                            <a href="{{route('member.loans', 2)}}" class="fs-7 px-3 text-decoration-none fw-bold {{$loan_status == 2 ? 'fs-7 btn bu-orange text-light fw-bold rounded-pill' : ''}}" style="color: rgb(55, 55, 55);">
                                Paid
                            </a>
                            <a href="{{route('member.loans', 3)}}" class="fs-7 px-3 text-decoration-none fw-bold {{$loan_status == 3 ? 'fs-7 btn bu-orange text-light fw-bold rounded-pill' : ''}}" style="color: rgb(55, 55, 55);">
                                All Loans
                            </a>
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
                        <h6 class="text-secondary fs-7 ps-2">
                            <i class="bi bi-lightbulb-fill"></i>
                            Here are the loans with the checks you've already claimed.
                        </h6>
                    </div>

                    <div class="col-12">
                        <div class="loan-container p-1" style="min-height: 100px; max-height: 450px; width: 100%; overflow-y: auto; overflow-x:hidden;">
                            @if (count($loans) != 0)
                                @foreach ($loans as $loan)
                                    @php
                                        $paid = false;
                                        if ($loan->totalPayment >= ($loan->principal_amount + $loan->interest)) {
                                            $paid = true;
                                        }
                                    @endphp
                                    <!-- Status Card -->
                                    <a href="{{route('loan.details', ['id' => $loan->id])}}" class="text-decoration-none text-dark">
                                        <div class="col-12 pb-3">
                                            <div class="card {{ $paid ? 'bg-bugreen' : '' }} rounded-4 shadow-sm loan_card">
                                                <div class="row g-0 p-3">
                                                    <div class="col m-0 d-flex justify-content-center">
                                                        @if ($loan->loan_type_id == 1)
                                                        <img src="{{asset('icons/MPL-mini.svg')}}" alt="mini mpl icon" style="width: 40px">
                                                        @elseif ($loan->loan_type_id == 2)
                                                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="mini hsl icon" style="width: 40px">
                                                        @endif

                                                    </div>
                                                    <div class="col-lg-6 col-5 ">
                                                        <p style="font-size: 14px" class="fw-bold m-0">
                                                            {{$loan->LoanType->loan_type_description}}
                                                            <span class="fw-light" style="font-size: 12px">
                                                            {{$loan->term_years}}
                                                            @if ($loan->term_years > 1)
                                                                years
                                                            @else
                                                                year
                                                            @endif
                                                            </span>
                                                            @if ($loan->penalty != null)
                                                            <span style="font-size: 12px" class="text-danger">
                                                                <img style="height: 30px ;" src="{{asset('icons/penalty.svg')}}" alt="">
                                                            </span>    
                                                            @endif
                                                        </p>

                                                       

                                                        <p class="m-0" style="font-size: x-small;">
                                                            @if($loan->amortization)
                                                            {{date("M Y", strtotime($loan->amortization->amort_start))}}
                                                            <span>
                                                                -  {{date("M Y", strtotime($loan->amortization->amort_end))}} </span>
                                                            @else
                                                                No amortization period yet
                                                            @endif
                                                        </p>
                                                        <p class="m-0 fw-bold mt-4" style="font-size: 10px;">
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

                                                    <div class="col-4 text-end">
                                                        <p  class="text3-1-design m-0">Outstanding Balance</p>
                                                        @if($paid)
                                                            <span class="fs-7 fw-bold text-success">
                                                                Fully Paid <img src="{{asset('icons/check-icon.svg')}}" alt="check-icon">
                                                            </span>
                                                        @else
                                                            <p class="fw-bold" style="font-size: 14px"><span class="fw-light" style="font-size: 10px;">Php</span>
                                                                {{
                                                                    number_format($loan->principal_amount + $loan->interest - $loan->totalPayment, 2, '.',',')
                                                                }}
                                                            </p>
                                                        @endif

                                                        
                                                    </div>

                                                
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-12 p-5 text-center">
                                        @if($loan_status == 1)
                                        <p>You don't have performing loans yet</p>
                                        @elseif($loan_status == 2)
                                        <p>You don't have paid loans yet</p>
                                        @else
                                        <p>You don't have loans yet</p>
                                        @endif
                                        <img src="{{asset('icons/no-transaction.svg')}}" alt="" style="width: 200px">
                                        <p class="mt-5" style="font-size: small;">
                                            Apply for a <a class="text-decoration-none" href="/member/mpl-application-form">Multi-purpose</a> or a <a class="text-decoration-none" href="/member/hsl-application-form">Housing Loan</a> loan today!</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
     
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const cards = document.querySelectorAll('.loan_card');

        searchInput.addEventListener('input', function () {
            const searchText = searchInput.value.trim().toLowerCase();

            cards.forEach(card => {
                const cardContent = card.textContent || card.innerText;
                const cardDisplay = card.style.display;
                const isMatch = cardContent.toLowerCase().includes(searchText);

                if (isMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
