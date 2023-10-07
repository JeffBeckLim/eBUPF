<div class="modal fade" id="checkModal{{$loan->id}}" tabindex="-1" aria-labelledby="checkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="checkModalLabel">Check and Others</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @include('admin-views.admin-loan-applications.div-identifier')
      
        <form action="{{route('loan.check.update', $loan->id)}}" method="POST">
            @csrf

            <label for="principal_amount">Adjusted Net Pay After Loan</label>
            <input class="form-control" type="number" name="adjusted_net_pay" id="principal_amount" value="">

            <p class="m-0 pt-2 fw-bold">Reference</p>
            <label for="check_co">Check CO.</label>
            <input class="form-control" type="number" name="check_co" id="check_co" value="">
            
            <label for="date">Date</label>
            <input class="form-control" type="date" name="date" id="date" value="">
            
            <label for="remarks">Remarks</label>
            <input class="form-control" type="text" name="remarks" id="remarks" value="">
            
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