<div class="modal fade" id="adjustmentsModal{{$loan->id}}" tabindex="-1" aria-labelledby="adjustmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="adjustmentsModalLabel">Adjustments</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          @include('admin-views.admin-loan-applications.div-identifier')
      

        <form action="{{route('update.adjustments', $loan->id)}}" method="POST">
            @csrf
            {{-- housing_service_fee --}}
            @if ($loanType == 2)
              <label for="housing_service_fee">For Housing: Service Fee</label>
              <input class="form-control" type="number" name="housing_service_fee" id="housing_service_fee" value="{{ $loan->adjustment != null ? $loan->adjustment->housing_service_fee : '' }}">    
            @endif
            
            <label for="interest_first_yr">Interest (1st YR)</label>
            <input class="form-control" type="number" name="interest_first_yr" id="interest_first_yr" value="{{ $loan->adjustment != null ? $loan->adjustment->interest_first_yr : '' }}">

            <label for="mri">MRI</label>
            <input class="form-control" type="number" name="mri" id="mri" value="{{ $loan->adjustment != null ? $loan->adjustment->mri : '' }}">

            <label for="previous_loan_balance">Previous Loan Balance / Refund</label>
            <input class="form-control" type="number" name="previous_loan_balance" id="previous_loan_balance" value="{{ $loan->adjustment != null ? $loan->adjustment->previous_loan_balance : '' }}">
            
            <label for="interest_rebate">Interest Rebate / Refund</label>
            <input class="form-control" type="number" name="interest_rebate" id="interest_rebate" value="{{ $loan->adjustment != null ? $loan->adjustment->interest_rebate : '' }}">

            <label for="previous_penalty">Penalty</label>
            <input class="form-control" type="number" name="previous_penalty" id="previous_penalty" value="{{ $loan->adjustment != null ? $loan->adjustment->previous_penalty : '' }}">
            
            
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