@extends('member-components.member-layout')

@section('content')
<style>
    .download-ledger:hover {
        color: #fff !important;
        background: #005749 !important;
        transition: all 0.5s ease;
    }
</style>
<main >
    <div class="container-fluid">
        <div class="col pt-1 m-2">
            <div class="row px-lg-1">
                <div class="col-lg-6 ">
                    <!-- LOAN DETAILS CARD -->
                    <div class="card shadow-sm rounded-4 " style="border-color: #32BEA6; border-width: 2px;">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12 pb-3" style="margin: 10px 0 0 10px">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-6">
                                            <div class="fs-5 fw-bolder m-0 lh-1">Loan Details</div>
                                        </div>
                                        <div class="col-6 text-end pe-3">
                                            <a href="{{route('generateLedger', ['id' => $loan->id])}}" class="btn download-ledger rounded-3" style="border: 1px solid #008f77; color:#005e4e; @if ($payments->isEmpty())
                                                pointer-events: none; color: grey; border: 1px solid grey;
                                             @endif font-size: 14px"

                                            >Download Ledger <i class="bi bi-download"></i></a>
                                        </div>
                                    </div>
                                    <label style="color: #878787;"  class="fs-7 fw-bold">Last Updated <span>{{$loan->updated_at->format('F j, Y - h:i A')}}</span></label>
                                </div>

                                <div class="col-12 " style="scale: 0.9;">
                                    <div class="row">
                                        <div class="col-2">
                                            @if($loan->loan_type_id == 1)
                                                <img class="img-fluid" src="{{asset('assets/MPL-mini.svg')}}" alt="mpl mini" width="50px">
                                            @elseif($loan->loan_type_id == 2)
                                                <img class="img-fluid" src="{{asset('assets/HSL-mini.svg')}}" alt="HSL mini" width="50px">
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <p class="fs-6 fw-bold m-0">
                                            @if($loan->loan_type_id == 1)
                                                Multi-purpose Loan
                                            @elseif($loan->loan_type_id == 2)
                                                Housing Loan
                                            @endif
                                            </p>
                                            <p class="m-0 fs-7">
                                                @if($loan->amortization)
                                                {{date("F Y", strtotime($loan->amortization->amort_start))}}
                                                <span>
                                                    -  {{date("F Y", strtotime($loan->amortization->amort_end))}} </span>
                                                @else
                                                    No amortization period yet
                                                @endif
                                            </p>
                                            <p class="m-0 fw-bold mt-4 fs-7">
                                                Monthly Payable
                                                <span class="fw-normal">
                                                    @if ($loan->amortization)
                                                        Php {{ number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.', ',') }}
                                                    @else
                                                        No amortization yet
                                                    @endif
                                                </span>
                                            </p>



                                        </div>
                                        <div class="col-4">
                                            <p  class="fs-7 fw-bold m-0" style="color: #00638D;">Outstanding Balance</p>
                                            <p class="fs-5 fw-bold"><span class="fw-light" style="font-size: small;">Php</span> {{
                                                number_format(
                                                    $loan->principal_amount + $loan->interest -
                                                    ($loan->payment ? $loan->payment->sum('principal') + $loan->payment->sum('interest') : 0),
                                                    2,
                                                    '.',
                                                    ','
                                                )
                                            }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-10">
                                            @if ($loan->penalty->count() != 0)
                                                <h6>
                                                    <span style="font-size: 14px" class="text-danger">
                                                        <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="">
                                                            Penalty Balance:
                                                        @php
                                                            $sum = 0;
                                                                foreach ($loan->penalty as $penalty) {
                                                                   $sum += $penalty->penalty_total;
                                                                }
                                                        @endphp
                                                        <span class="text-danger fw-bold">
                                                            @if ($sum - $sumPenaltyPayments < 1)
                                                                Php 0.00
                                                            @else
                                                                Php {{number_format($sum - $sumPenaltyPayments, 2, '.',',')}}
                                                            @endif
                                                        </span>
                                                    </span>
                                                </h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LOAN MORE INFO -->
                    <div class="card mt-2 shadow-sm" style="border-radius: 15px 15px 0 0">
                        <div class="bg-success-bu" style="border-radius: 14px 14px 0 0">
                            <p class="fw-bold m-1 text-center">Loan Details</p>
                        </div>
                        <div class="card-body mx-4">
                            <div class="row fs-7">
                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Loan ID
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      {{$loan->id}}
                                    </p>
                                </div>

                                <div class="col-6 mb-3">
                                    <p class="fw-bold m-0">
                                        Loan Category
                                    </p>
                                </div>
                                <div class="col-6 mb-3">
                                    @if ($loan->loanCategory)
                                        <p class="m-0">
                                            {{ $loan->loanCategory->loan_category_name }} Loan
                                        </p>
                                    @else
                                        <p class="m-0">
                                            No Loan Category Yet
                                        </p>
                                    @endif
                                </div>

                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Principal Amount
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                        <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{number_format($loan->principal_amount, 2, '.', ',')}}
                                    </p>
                                </div>

                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Interest
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                        <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{number_format($loan->interest, 2, '.', ',')}}
                                    </p>
                                </div>

                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Total
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{number_format($loan->principal_amount + $loan->interest, 2, '.', ',')}}
                                    </p>
                                </div>

                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Loan Term
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      {{$loan->term_years}} Years
                                    </p>
                                </div>

                                <div class="col-6 mb-3">
                                    <p class="fw-bold m-0">
                                        End of Term
                                    </p>
                                </div>
                                <div class="col-6">
                                    @if ($loan->amortization && $loan->amortization->amort_end)
                                        <p class="m-0">
                                            {{ date("F Y", strtotime($loan->amortization->amort_end)) }}
                                        </p>
                                    @else
                                        <p class="m-0">
                                            No End of Term Yet
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- LOAN AMORTIZATION  -->
                    <div class="card mt-2 shadow-sm" style="border-radius: 0">
                        <div class="card-body mx-4">
                            <div class="row g-0 fs-7">
                                <div class="col-12 text-center">
                                    <p class="fw-bold">Amortization</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <p class="fw-bold m-0">
                                        Monthly Principal
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{$loan->amortization ? number_format($loan->amortization->amort_principal, 2, '.', ',') : '0.00'}}
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="fw-bold m-0">
                                        Monthly Interest
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{$loan->amortization ? number_format($loan->amortization->amort_interest, 2, '.', ',') : '0.00'}}
                                    </p>
                                </div>
                                <div class="col-12 border-dotted-top" >
                                </div>
                                <div class="col-6 mb-3">
                                    <p class="fw-bold m-0">
                                        Monthly Payable
                                    </p>
                                </div>
                                <div class="col-6 mb-3 ">
                                    <p class="m-0">
                                      <span class="fw-bold" style="font-size: small; color: #00638D;">Php</span> {{$loan->amortization ? number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.', ',') : '0.00'}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- History Card --}}
                <div class="col-lg-6 col-sm-12  ">
                    <div class="card shadow-sm h-100" style="border-radius: 15px">
                        <div style="border-radius: 14px 14px 0 0; background-color: #A2ABFF;">
                            <p class="fw-bold m-1 text-center">Payment History</p>
                        </div>
                        <div class="mt-1 mx-4">
                            @if ($payments->isEmpty())
                            <div style="height: 660px;">
                                <div class="d-flex justify-content-center align-content-center">
                                    <img src="{{ asset('assets/no-transaction.svg') }}" alt="no transaction icon" width="150px" style="margin-top: 80px;">
                                </div>
                                <p class="text-center">No transaction</p>
                            </div>
                            @else
                            <div style=" overflow-y: auto;">
                                <div class="table-responsive">
                                    <table class="table fs-7">
                                        <thead>
                                            <tr>
                                                <th scope="col">OR No.</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Principal</th>
                                                <th scope="col">Interest</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments->sortByDesc('created_at') as $payment)
                                            <tr>
                                                <td>{{ $payment->or_number }}</td>
                                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') }}</td>
                                                <td> <span class="text-muted">Php</span> {{ number_format($payment->principal, 2, '.', ',') }}</td>
                                                <td><span class="text-muted">Php</span> {{ number_format($payment->interest, 2, '.', ',') }}</td>
                                                <td><span class="text-muted">Php</span> {{ number_format($payment->principal + $payment->interest, 2, '.', ',') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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

@endsection
