<div class="modal fade" id="reasonModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" style="font-size: 14px" id="reasonModalLabel">Reason for Cancellation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="font-size: 14px">
            <h6 class="text-start fw-bold">
                {{$loan->loan->loan_code}}    
            </h6>
            {{$loan->loan->reason_for_cancel}}
        </div>
      </div>
    </div>
  </div>