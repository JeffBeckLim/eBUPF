<div class="modal fade" id="cancelModal{{$cb_withLoan->loan->id}}" tabindex="-1" aria-labelledby="cancelModal" aria-hidden="true">
    <div class="modal-dialog  border-0 ">
      <div class="modal-content">
        <div class="modal-header  border-0 p-3">
            <p class="text-secondary" style="font-size: small">{{$cb_withLoan->loan->loanType->loan_type_name}}: {{$cb_withLoan->loan->id}} - Php {{$cb_withLoan->loan->principal_amount}} </p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-0 px-5 pt-0 text-center">
            <h1><i style="color: orange" class="bi bi-cone-striped"></i></i></h1>
            <p class="fw-bold fs-5">You are about to cancel the request.</p>
            <p style="font-size: 15px">Are you sure you want to cancel your request?</p>
            <p  class="text-secondary" style="font-size: 15px">This will cancel your loan application request, and cannot be reverted</p>
        </div>
        
            <div class="row g-0 px-4 py-3 bg-light rounded">
                <div class="col-6  p-1">
                    <button type="button" class="btn w-100 btn-outline-bu2" data-bs-dismiss="modal">Close, go back</button>
                </div>
                <div class="col-6  p-1">
                    <a href="{{route('cancel.application', $cb_withLoan->loan->id)}}"><button type="button" class="btn  w-100 bu-orange text-light">Yes, cancel the request</button></a>
                </div>
            </div> 
        
      </div>
    </div>
</div>  