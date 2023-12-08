<!-- Modal -->
<div class="modal fade" id="cancelLoanAppModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="cancelLoanAppModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cancelLoanAppModalLabel">Cancel Loan Application</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('cancel.on.submitted', $loan->loan->id)}}" method="post">
            @csrf
            @method('PUT')
            <div style="font-size: 14px">
                Are you sure you want to cancel the loan application for <span class="fw-bold">{{$loan->loan->loan_code}}</span> ?
            </div> 
            

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label text-danger">Please provide a reason for cancelling this application *</label>
                <textarea class="form-control" id="reason_for_cancel" name="reason_for_cancel" rows="3"  rows="4" cols="50"></textarea>
            </div>

            <p class="mt-2" style="font-size: 14px">
                Once you cancel, you won't be able to undo the action.
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No, go back</button>
          <button id="submitCancelApp" type="submit" class="btn btn-dark disabled">Yes, cancel my application</button>
        </div>
    </form>
      </div>
    </div>
  </div>
