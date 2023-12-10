<div class="modal fade" id="loanTransaction{{$transaction->id}}" tabindex="-1" aria-labelledby="loanTransactionLabel{{$transaction->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="loanTransactionLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-3">

                <p class="fw-bold">Successful Loan Application <br>
                    @if ($transaction->co_borrower->isNotEmpty())
                        @foreach ($transaction->co_borrower as $coBorrower)
                            @if ($coBorrower->accept_request === null)
                                <span style="color: rgb(0, 0, 0);" class="fw-normal fs-7">Wait for your co-borrower to approve your request</span>
                            @elseif($coBorrower->accept_request === 0)
                                <span style="color: rgb(136, 0, 0);" class="fw-normal fs-7">Your co-borrower has rejected your request</span>
                            @elseif ($coBorrower->accept_request === 1)
                                <span style="color: rgb(0, 88, 0);" class="fw-normal fs-7">Your co-borrower has approved your request</span>
                            @endif
                        @endforeach
                    @else
                        <span style="color: rgb(136, 0, 0);" class="fw-normal fs-7">No co-borrower associated with this transaction</span>
                    @endif
                </p>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-6">
                        <p class="">Loan Code</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">{{$transaction->loan_code}}</p>
                    </div>
                    <div class="col-6">
                        <p class="">Loan Type</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">{{$transaction->loanType->loan_type_description}}</p>
                    </div>
                    <div class="col-6">
                        <p class="">Principal Amount</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">
                            Php {{ number_format($transaction->original_principal_amount, 2) }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="">Term</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">
                            @if ($transaction->term_years === 1)
                                {{$transaction->term_years}} year
                            @else
                                {{$transaction->term_years}} years
                            @endif
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="">Date and Time</p>
                    </div>
                    <div class="col-6">
                        <p class="fw-bold">{{ $transaction->created_at->format('F d, Y, h:i A') }}</p>
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
