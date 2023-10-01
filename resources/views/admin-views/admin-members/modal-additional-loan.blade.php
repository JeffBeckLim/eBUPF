<div class="modal fade" id="additionalLoanModal{{$user->member->id}}" tabindex="-1" aria-labelledby="additionalLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="additionalLoanModalLabel">Apply Additional Loan</h1>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="border rounded p-3" style="font-size: small">
              <h5 style="color: #838383"><span class="fw-bold" style="font-size: small">LEGIBLE ADDTIONAL LOAN?</span></h5>
              <span class="fw-bold">Select what type of additional loans {{$user->member->firstname}} {{$user->member->lastname}}</span> is legible for...
            </div>
            
            <div class="row pt-3 mx-3">
          
            <form action="{{route('allow.additional.loan', $user->member->id)}}" method="POST">
                @csrf  
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="additional_loan" id="additional_loan1" value=" " 
                    {{$user->member->additional_loan == null ? 'checked' : ''}}>
                    <label class="form-check-label" for="additional_loan">
                      Cannot apply for additional loans
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="additional_loan" id="additional_loan" value="1"
                    {{$user->member->additional_loan == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="additional_loan">
                      Can apply for additional MPL only
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="additional_loan" id="additional_loan" value="2"
                    {{$user->member->additional_loan == 2 ? 'checked' : ''}}>
                    <label class="form-check-label" for="additional_loan">
                      Can apply for additional HSL only
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="additional_loan" id="additional_loan" value="3"
                    {{$user->member->additional_loan == 3 ? 'checked' : ''}}>
                    <label class="form-check-label" for="additional_loan">
                      Can apply for additional MPL and HSL
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