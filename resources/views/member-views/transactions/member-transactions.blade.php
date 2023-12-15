@extends('member-components.member-layout')

@section('content')

<div class="container-fluid">

        <div class="col pt-3">
            <div class="card border col-lg-6 col-sm-12 mx-auto shadow-sm p-lg-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{-- <img src="{{asset('assets/receipt-history.svg')}}" alt="history" style="width: 3rem;"> --}}
                            <p class="text-center fw-bolder m-0 fs-5">
                                Transaction
                                <br>
                                History
                            </p>
                        </div>

                        <div class="col-12 pt-4">
                            <span class=" d-flex justify-content-center align-items-center">
                                <a href="#" class="px-3 text-decoration-none fw-bold fs-7 myFilter" data-filter="all" style="color: grey;">All Activity</a>
                                <a href="#" class="px-3 text-decoration-none fw-bold fs-7 myFilter" data-filter="mpl" style="color: grey;">MPL</a>
                                <a href="#" class="px-3 text-decoration-none fw-bold fs-7 myFilter" data-filter="housing" style="color: grey;">Housing</a>
                            </span>
                        </div>
                        @if (count($transactions) == 0)
                            <div class="d-flex justify-content-center align-content-center">
                                <img src="{{asset('assets/no-transaction.svg')}}" alt="no transaction icon" width="150px" style="margin-top: 80px;">
                            </div>
                            <p class="text-center">No transaction</p>
                        @elseif($transactions->isEmpty() == false)
                            <div class="mt-3 transaction-container" id="transaction-container" style="height:500px;">
                                @foreach($transactions as $transaction)
                                    @if($transaction instanceof \App\Models\Payment)
                                        <div class="col-12 border-bottom border-top" >
                                            <div class="row" style="padding: 0 30px 0 10px;">
                                                <div class="col-6 my-1">
                                                    <p class="fs-7 fw-bold m-0">Loan Payment</p>
                                                    <p class="m-0" style="font-size: 12px;"><i class="bi bi-clock-history"></i>
                                                        {{ date('M Y', strtotime($transaction->payment_date)) }}
                                                    </p>
                                                </div>
                                                <div class="col-4 my-1">
                                                    <p class="fs-7 fw-bold m-0">
                                                        {{ number_format($transaction->principal + $transaction->interest, 2) }}
                                                    </p>
                                                </div>
                                                <div class="col-2 my-1 text-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#paymentTransaction{{$transaction->id}}">
                                                        <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($transaction instanceof \App\Models\PenaltyPayment)
                                        <div class="col-12 border-bottom border-top">
                                            <div class="row" style="padding: 0 30px 0 10px;">
                                                <div class="col-6 my-1">
                                                    <p class="fs-7 fw-bold m-0">Loan Penalty Payment</p>
                                                    <p class="m-0" style="font-size: 12px;"><i class="bi bi-clock-history"></i>
                                                        {{ $transaction->created_at->format('F d, Y, h:i A') }}
                                                    </p>
                                                </div>
                                                <div class="col-4 my-1">
                                                    <p class="fs-7 fw-bold m-0">Php
                                                        {{ number_format($transaction->penalty_payment_amount, 2) }}
                                                    </p>
                                                </div>
                                                <div class="col-2 my-1 text-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#paymentPenaltyModal{{$transaction->id}}">
                                                        <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($transaction instanceof \App\Models\Loan)
                                        @php
                                            $loanTypes = [
                                                'Multi-purpose Loan' => 'mpl',
                                                'Housing Loan' => 'housing',
                                            ];

                                            $loanCode = $loanTypes[$transaction->loanType->loan_type_description];
                                        @endphp

                                        <div class="col-12 border-bottom border-top" style="pointer-events: none;" data-filter="{{ $loanCode }}">
                                            <div class="row" style="padding: 0 30px 0 10px;">
                                                <div class="col-6 my-1">
                                                    <p class="fs-7 fw-bold m-0">Applied a loan</p>
                                                    <p class="m-0" style="font-size: 12px;"><i class="bi bi-clock-history"></i> {{ $transaction->created_at->format('F d, Y, h:i A') }}</p>
                                                </div>
                                                <div class="col-4 my-1">
                                                    <p class="fs-7 fw-bold m-0">
                                                        @if($transaction->loanType->loan_type_description == 'Multi-purpose Loan')
                                                            MPL
                                                        @elseif($transaction->loanType->loan_type_description == 'Housing Loan')
                                                            HL
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-2 my-1 text-end">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loanTransaction{{$transaction->id}}" class="info-icon" style="pointer-events: auto;">
                                                        <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-content-center">
                                <img src="{{asset('assets/no-transaction.svg')}}" alt="no transaction icon" width="150px" style="margin-top: 80px;">
                            </div>
                            <p class="text-center">No transaction</p>
                        @endif

                    </div>
                </div>
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
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('.info-icon').click(function(e) {
            e.stopPropagation();
        });
    });

    $(document).ready(function() {
    // Initially, show all transactions
    $('.transaction-container .col-12').show();

    // Handle filter link click
    $('[data-filter]').click(function(e) {
        e.preventDefault();

        // Get the filter value from the data attribute
        var filterValue = $(this).data('filter');

        // Remove the 'active' class from all filter links
        $('[data-filter]').removeClass('transaction-active');

        // Add the 'active' class to the clicked filter link
        $(this).addClass('transaction-active');

        // Hide all transactions
        $('.transaction-container .col-12').hide();

        // Show transactions based on the selected filter
        if (filterValue === 'all') {
            $('.transaction-container .col-12').show();
        } else {
            $('.transaction-container .col-12[data-filter="' + filterValue + '"]').show();
        }
    });

    // Automatically trigger a click on "All Activity" to show all transactions and add the 'active' class
    $('[data-filter="all"]').addClass('active').trigger('click');
});

</script>
@endsection
