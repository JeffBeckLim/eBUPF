<div class="modal fade" id="stateModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="stateModalLabel">Change State</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        @php
            $loanStatus = App\Models\LoanApplicationStatus::where('loan_id', $loan->loan_id)->get();
            $flag = 0;
            foreach ($loanStatus as $status) {
              if($status->loan_application_state_id == 5){
                  $flag += 1;
              }
            }
        @endphp
        <div class="p-3 m-0">
           <span style="font-size: 12px">
              Loan will be automatically set to performing if "check picked up" status is added.
           </span>
        </div>
        <form action="{{route('create.state',$loan->loan->id)}}" method="POST">
            @csrf
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_active" id="is_active1" value=""{{$loan->loan->is_active == '' ? 'checked' : ''}} >
                <label class="form-check-label" for="is_active1" >
                  No State / None
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input " type="radio" name="is_active" id="is_active2" value="1" {{$loan->loan->is_active == '1' ? 'checked' : ''}} {{$flag == 0 ? 'disabled' : ''}}>
                <label class="form-check-label fw-bold text-primary" for="is_active2">
                  Performing / Active 
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input " type="radio" name="is_active" id="is_active3" value="2" {{$loan->loan->is_active == '2' ? 'checked' : ''}}>
                <label class="form-check-label fw-bold text-dark" for="is_active3" >
                  Non-performing Loan NPL / Closed
                </label>
              </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>