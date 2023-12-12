@if ($penalty_payments != null)
    @foreach ($penalty_payments as $payments)
        <!-- Modal for each payment -->
        <div class="modal fade" id="penaltyPaymentDeleteModal{{$payments->id}}" tabindex="-1" aria-labelledby="editLoanModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: auto !important;">
              <div class="modal-content p-3">
                <div class="text-center fw-bold text-center fs-6 pt-2">
                    Delete Payment?
                </div>

                <div class="text-center text-center fs-7 px-5 pt-3">
                    Are you sure you want to delete penalty payment <span class="fw-bold">{{$payments->id}}</span> with OR number <span class="fw-bold">{{$payments->or_number}}</span>? This action cannot be undone.
                </div>

                <div style="background-color: rgb(255, 208, 199); border-left: 3px solid red;" class="mx-5 mt-3 fs-7 p-2">
                    <div class="row">
                        <div class="col-1" style="padding-left: 18px;">
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                        </div>
                        <div class="col-11 fw-bold text-danger">
                            Warning
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                        </div>
                        <div class="col-11 text-danger">
                            Deleting this payment will affect related records. Be sure before you delete.
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.penalty.deletePayment', ['id' => $payments->id]) }}" method="POST" id="formDeletePayment">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer border-0 mx-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn bu-orange text-light" id="deletePaymentNow">Delete</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    @endforeach
@endif
