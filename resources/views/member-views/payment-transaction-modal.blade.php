<div class="modal fade" id="paymentTransaction{{$transaction->id}}" tabindex="-1" aria-labelledby="paymentTransactionLabel{{$transaction->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="paymentTransactionLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">

                @if ($transaction->loan)
                    <p class="fw-bold">Loan Payment for Loan Code <span style="color: rgb(136, 0, 0);">{{ $transaction->loan->loan_code }}</span></p>
                @else
                    <p class="fw-bold">Loan Payment for Loan Code <span style="color: rgb(136, 0, 0);">No associated loan</span></p>
                @endif

                <div class="row" style="margin-top: 30px;">
                    <div class="col-6">
                        <p class="">OR Number</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">{{$transaction->or_number}}</p>
                    </div>
                    <div class="col-6">
                        <p class="">Payment Date</p>
                    </div>
                    <div class="col-6">
                        <p>
                            {{date('F d, Y', strtotime($transaction->payment_date));}}
                        </p>
                    </div>
                </div>

                <p class="fw-bold " style="margin-bottom: 5px;">Amounts:</p>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5"  style="margin-bottom: -10px;">
                        <p class="">Principal</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold"> Php {{ number_format($transaction->principal, 2) }}</p>
                    </div>

                    <div class="col-1">

                    </div>
                    <div class="col-5 ">
                        Interest
                    </div>
                    <div class="col-6 fw-bold mb-3">
                        Php {{ number_format($transaction->interest, 2) }}
                    </div>

                </div>
                <div style="border-top: grey 1px solid"></div>
                <div class="row mt-2">
                    <div class="col-1">

                    </div>
                    <div class="col-5 fw-bold ">
                        Total
                    </div>
                    <div class="col-6 fw-bold">
                        Php {{ number_format($transaction->principal + $transaction->interest, 2) }}
                    </div>
                </div>
                {{-- Back button --}}
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn bu-orange w-100 text-light fw-bold mt-3 rounded" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
