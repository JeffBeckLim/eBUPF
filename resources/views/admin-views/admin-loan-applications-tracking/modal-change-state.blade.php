<div class="modal fade" id="stateModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="stateModalLabel">Change State</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('create.state',$loan->loan->id)}}" method="POST">
            @csrf
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_active" id="is_active1" value=""{{$loan->loan->is_active == '' ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active1" >
                  No State / None
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input " type="radio" name="is_active" id="is_active2" value="1" {{$loan->loan->is_active == '1' ? 'checked' : ''}}>
                <label class="form-check-label fw-bold text-primary" for="is_active2" >
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