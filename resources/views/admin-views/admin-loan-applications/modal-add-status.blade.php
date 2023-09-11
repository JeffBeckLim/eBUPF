<div class="modal fade" id="statusModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h1 class=" fw-bold fs-5">Add Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row g-0 mx-3">
        <div class="col-12" >
          Loan ID
          <h4 style="color: #0092D1;" class="fw-bold">{{$loan->loan->id}}</h4>
        </div>
        <div class="col-12">
          <div class="row  g-0">
            <div class="col-6">
              <h6 class="fw-bold">
                {{$loan->loan->member->firstname}}
                {{$loan->loan->member->lastname}}
              </h6>
              BU{{$loan->loan->member->units->unit_code}} <br>
              {{ date("F j, Y, g:i A", strtotime($loan->loan->created_at))}}
            </div>
            <div class="col-6 ">
              Php {{number_format($loan->loan->principal_amount, 2, '.',',')}}
            </div>
          </div>
        </div>
      </div>
      @php
            $array = [];
            foreach ($loan->loan->LoanApplicationStatus as $status) {
                array_push($array, $status->loan_application_state_id);
            }
      @endphp
      <div class="modal-body">
        <form method="POST" action="{{route('create.status',$loan->loan->id)}}" >
          @csrf
          <div class="mb-3">
            <label for="statusDropdown" class="col-form-label">Select Satatus</label>
            <select name="loan_application_state_id" id="statusDropdown" class="form-select form-control">
             <option value="" selected disabled>...</option>
              @foreach ($loan_app_states as $state)
                <option value="{{$state->id}}">
                   {{$state->id}} . {!!in_array($state->id, $array)? '✔️' : ' '!!} {{$state->state_name}}  
                   
                </option>    
              @endforeach
            </select>
          </div>
          <div class="mb-2">
            <label for="date_evaluated" class="col-form-label">Date</label>
            <input name="date_evaluated" type="date" class="form-control" id="date_evaluated">
          </div>
          
          <div class="mb-2">
            <label for="message-text" class="col-form-label">Remarks</label>
            <textarea name="remarks" class="form-control" id="message-text"></textarea>
          </div>
        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Add Status</button>
          </div>
      </form>
    </div>
  </div>
</div>