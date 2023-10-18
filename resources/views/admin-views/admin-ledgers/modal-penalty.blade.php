<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Penalty</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.penalty.updateOrCreate', $loan->id)}}" method="POST">
            @csrf

            <label for="date" >Update Penalty Total</label>
            <input  class="form-control" type="numeric" name="penalty_total" id="numericInput" value="{{$loan->penalty->penalty_total}}">
            
            {{-- <label for="remarks">Remarks</label>
            <input class="form-control" type="text" name="remarks" id="remarks" value="">
             --}}

        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Save Penalty</button>
        </div>

        </form>
      </div>
    </div>
  </div>
