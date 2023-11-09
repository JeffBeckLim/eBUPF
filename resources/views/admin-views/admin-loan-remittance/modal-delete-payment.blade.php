<div class="modal fade" id="editPayment{{$payment->id}}" tabindex="-1" aria-labelledby="editLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: auto !important;">
      <div class="modal-content p-3">
        <div class="text-center fw-bold text-center fs-6 pt-2">
            Delete Payment?
        </div>

        <div class="text-center text-center fs-7 px-5 pt-3">
            Are you sure you want to delete payment <span class="fw-bold">{{$payment->id}}</span> with OR number <span class="fw-bold">{{$payment->or_number}}</span>? This action cannot be undone.
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
            <form action="{{ route('delete.payment.remittance', ['id' => $payment->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer border-0 mx-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bu-orange text-light">Delete</button>
                </div>
            </form>
        </div>
       {{--  <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="editLoanModalLabel" style="color: #0D3546;">Edit Payment {{$payment->id}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="border bg-light rounded mx-1 p-2 mb-2">
                <p class="m-0" style="font-size: 12px">Editing this payment may affect related records. Please review changes carefully.</p>
            </div>
        <form action="{{ route('update.payment.remittance', ['id' => $payment->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="or_number" class="fw-bold">OR Number <span class="fw-bold text-danger">*</span></label>
            <input class="form-control" type="number" name="or_number" id="or_number" value="{{$payment->or_number}}">

            <label for="payment_date" class="fw-bold">Date <span class="fw-bold text-danger">*</span></label>
            <input id="payment_date_input" class="form-control" name="payment_date" type="date" value="{{ old('payment_date', $payment->payment_date) }}" required>

            <div class="pe-1">
                <label for="loan_id" class="fw-bold">Loan ID <span class="fw-bold text-danger">*</span></label>
                <select name="loan_id" id="loan_id{{$payment->id}}" class="form-control" required>
                    <option value="" disabled>Select a Loan ID</option>
                    @foreach ($loans as $loan)
                        <option value="{{ $loan->id }}" {{ (old('loan_id', $payment->loan_id) == $loan->id) ? 'selected' : '' }}>
                            ID: {{$loan->id}} - {{$loan->loanType->loan_type_name}} - {{ substr($loan->member->firstname, 0, 1) }}. {{ $loan->member->lastname }} - {{ $loan->member->units->unit_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label for="principal" class="fw-bold">Principal</label>
            <input id="principal_input" class="form-control" name="principal" type="number" min="0" value="{{$payment->principal}}">

            <label for="interest" class="fw-bold">Interest <span class="fw-bold text-danger">*</span></label>
            <input id="interest_input" class="form-control w-100" name="interest" type="number" min="0" value="{{$payment->interest}}" >
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Save changes</button>
            </div>
        </form> --}}
      </div>
    </div>
</div>

