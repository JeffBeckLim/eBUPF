<div class="modal fade" id="additionalLoanModal{{$user->member->id}}" tabindex="-1" aria-labelledby="additionalLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="additionalLoanModalLabel">Apply Additional Loan</h1>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          @if ($user->member->additional_loan == null)
          
            <div class="border rounded p-3" style="font-size: small">
              <h5 style="color: #00D186"><i class="bi bi-check-circle-fill"></i> <span class="fw-bold" style="font-size: small">ADDTIONAL LOAN</span></h5>
              <span class="fw-bold">{{$user->member->firstname}} {{$user->member->lastname}}</span> is currently allowed to request for additional loans.
            </div>

          @else

            <div class="border rounded p-3" style="font-size: small">
              <h5 style="color: #838383"><span class="fw-bold" style="font-size: small">NOT LEGIBLE: ADDTIONAL LOAN</span></h5>
              <span class="fw-bold">{{$user->member->firstname}} {{$user->member->lastname}}</span> is currently not legible to apply for additional loans.
            </div>

          @endif
          

          <div class="row pt-3">
            <span class="m-1" style="font-size: small">Do you want to allow thi user to apply for additional loans?</span>
            <div class="col d-flex gap-2 mt-3 pb-2">
              <a class="btn bu-orange text-light w-100" href="{{route('allow.additional.loan' ,$user->member->id)}}">Allow </a>
              <a class="btn btn-outline-secondary w-100" href="{{route('not.allow.additional.loan' ,$user->member->id)}}">Don't Allow</a>
            </div>
            
          </div>
        {{-- <form action="" method="POST">
            @csrf  --}}
            {{-- <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="is_active1" value=""{{$loan->loan->loan_category_id == '' ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active1" >
                    None
                </label>
              </div>
            
            @foreach ($loan_categories as $category)
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="is_active1" value="{{$category->id}}"{{$loan->loan->loan_category_id == $category->id ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active1" >
                  {{$category->loan_category_name}}
                </label>
              </div>
            @endforeach --}}

             
        </div>
            {{-- <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button> --}}
            {{-- <button type="submit" class="btn bu-orange text-light">Save changes</button> --}}
            {{-- </div> --}}
        {{-- </form> --}}
      </div>
    </div>
</div>