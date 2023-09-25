<div class="modal fade" id="amortizationModal{{$loan->id}}" tabindex="-1" aria-labelledby="amortizationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="amortizationModalLabel">Amortization</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{route('create.amortization', $loan->id)}}" method="POST">
            @csrf
            <label for="amort_principal">Principal Amount</label>
            <input class="form-control" type="number" name="amort_principal" id="amort_principal" value="">

            <label for="amort_interest">Interest</label>
            <input class="form-control" type="number" name="amort_interest" id="amort_interest" value="">
            <div class="row">
                <div class="col-12 mt-3">
                    Amortization Period
                </div>
                <div class="col-6">
                    <label for="amort_start">Start</label>
                    <input class="form-control" type="date" name="amort_start" id="amort_start" value="">
                </div>
                <div class="col-6">
                    <label for="amort_end">End</label>
                    <input class="form-control" type="date" name="amort_end" id="amort_end" value="">
                </div>
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