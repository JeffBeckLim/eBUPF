<div class="modal fade" id="editLoanModal{{$loan->id}}" tabindex="-1" aria-labelledby="editLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="editLoanModalLabel">Edit Loan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row border bg-light rounded mx-1 p-2 mb-2">
                <p class="m-0" style="font-size: 12px">Any changes will be seen by the member (borrower)</p>
                <p class="m-0 pt-2 ">Php {{$loan->original_principal_amount}}</p>
                <p class="m-0" style="font-size: 12px">Original amount requested</p>
            </div>
        <form action="{{route('update.loan', $loan->id)}}" method="POST">
            @csrf
            <div class="border p-3 rounded bg-light">
              <h6 style="font-size: small">Loan Type</h6>
              <div class="d-flex ">
              @foreach ($loan_categories as $category)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="category" id="is_active1" value="{{$category->id}}"{{$loan->loan_category_id == $category->id ? 'checked' : ''}}>
                  <label class="form-check-label me-3" for="is_active1" >
                    {{$category->loan_category_name}}
                  </label>
                </div>
              @endforeach
              </div>
            </div>

            <label for="principal_amount">Principal Amount</label>
            <input class="form-control" type="number" name="principal_amount" id="principal_amount" value="{{$loan->principal_amount}}">

            <label for="interest">Interest</label>
            <input class="form-control" type="number" name="interest" id="interest" value="{{$loan->interest}}">
            
            <label for="term_years">Loan Term</label>
            <input class="form-control" type="number" name="term_years" id="term_years" value="{{$loan->term_years}}">
            
            
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