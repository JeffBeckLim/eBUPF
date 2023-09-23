<div class="modal fade" id="adjustModal{{$loan->loan->id}}" tabindex="-1" aria-labelledby="adjustModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="adjustModalLabel">Adjust Requested Amount</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row border bg-light rounded mx-1 p-2 mb-2">
            <p class="m-0" style="font-size: 12px">Any changes will be seen by the member (borrower)</p>
            <p class="m-0 pt-2 ">Php {{$loan->loan->original_principal_amount}}</p>
            <p class="m-0" style="font-size: 12px">Original amount requested</p>
        </div>

        <form action="{{route('update.principalAmount',$loan->loan->id)}}" method="POST">
            @csrf
            <label for="principal_amount">Amount Requested / Principal Amount</label>
            <input class="form-control" type="number" name="principal_amount" id="principal_amount" value="{{$loan->loan->principal_amount}}">
             
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>