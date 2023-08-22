<div class="modal fade" id="myModal{{$loan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  border-0 ">
      <div class="modal-content">
        <div class="modal-header  border-0 p-3">
            <p class="text-secondary" style="font-size: small">Reference ID: {{$loan->id}}</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-0 px-5 pt-0 text-center">
            <h1><i style="color: #5a619e;" class="bi bi-question-circle"></i></h1>
            <p class="fw-bold fs-5">You are about to accept the request.</p>
            <p class="text-secondary" style="font-size: 15px">Are you sure you want to accept <strong>{{$loan->member->firstname}}'s</strong> request be their co-borrower?</p>
            <p  class="text-secondary" style="font-size: 15px">They will still require your signature</p>
        </div>
        
            <div class="row g-0 px-4 py-3 bg-light rounded">
                <div class="col-6  p-1">
                    <button type="button" class="btn w-100 btn-outline-bu2" data-bs-dismiss="modal">Close, go back</button>
                </div>
                <div class="col-6  p-1">
                    <a href="/member/coBorrower/accept/{{$loan->id}}"><button type="button" class="btn  w-100 bu-orange text-light">Yes, accept request</button></a>
                </div>
            </div> 
        
      </div>
    </div>
</div>  