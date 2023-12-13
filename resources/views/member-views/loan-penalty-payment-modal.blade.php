<div class="modal fade" id="paymentPenaltyModal{{$transaction->id}}" tabindex="-1" aria-labelledby="paymentPenaltyModalLabel{{$transaction->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="paymentPenaltyModalLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">

                <p class="fw-bold">Loan Penalty Payment for Loan Code <span style="color: rgb(136, 0, 0);">{{ $transaction->penalty->loan->loan_code }}</span></p>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-6">
                        <p class="fs-6">OR Number</p>
                    </div>
                    <div class="col-6 fw-bold fs-6">
                        @if($transaction->or_number == null)
                            <p>No OR Number</p>
                        @else
                            <p>{{$transaction->or_number}}</p>
                        @endif
                    </div>
                    <div class="col-6">
                        <p class="fs-6">Date and Time</p>
                    </div>
                    <div class="col-6 fs-6">
                        @if($transaction->payment_date == null)
                            <p class="fw-bold">{{ $transaction->created_at->format('F d, Y, h:i A') }}</p>
                        @else
                            <p class="fw-bold">{{ $transaction->payment_date->format('F d, Y, h:i A') }}</p>
                        @endif
                    </div>
                </div>

                <p class="fw-bold fs-6" style="margin-bottom: 5px;">Penalty Paid:</p>
                <div class="row fs-6">
                    <div class="col-1"></div>
                    <div class="col-5"  style="margin-bottom: -10px;">
                        <p class="">Month and Year</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold"> {{date("F", mktime(0, 0, 0, $transaction->penalty->penalized_month, 1))}} {{$transaction->penalty->penalized_year}}
                        </p>
                    </div>

                    <div class="col-1">

                    </div>
                    <div class="col-5 ">
                        Amount
                    </div>
                    <div class="col-6 fw-bold mb-3">
                        Php {{ number_format($transaction->penalty_payment_amount, 2) }}
                    </div>

                </div>

                {{-- Back button --}}
                <div class="row fs-6">
                    <div class="col-12">
                        <button type="button" class="btn bu-orange w-100 text-light fw-bold mt-3 rounded" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
