<div class="modal fade" id="adjustmentsModal{{$loan->id}}" tabindex="-1" aria-labelledby="adjustmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="adjustmentsModalLabel">Adjustments</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form action="{{route('update.adjustments', $loan->id)}}" method="POST">
            @csrf
         
            <label for="MRI">MRI</label>
            <input class="form-control" type="number" name="mri" id="mri" value="">

            <label for="previous_loan_balance">Previous Loan Balance / Refund</label>
            <input class="form-control" type="number" name="previous_loan_balance" id="previous_loan_balance" value="">
            
            <label for="interest_rebate">Interest Rebate / Refund</label>
            <input class="form-control" type="number" name="interest_rebate" id="interest_rebate" value="">
            
            
            {{-- placeholder="current term: {{$loan->term_years}} year(s)" --}}
         
             
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>