<div class="modal fade" id="editPayment{{$payment->id}}" tabindex="-1" aria-labelledby="editLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
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
        </form>
      </div>
    </div>
</div>

