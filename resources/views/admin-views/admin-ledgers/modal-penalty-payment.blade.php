<div class="modal fade" id="penaltyPaymentModal" tabindex="-1" aria-labelledby="penaltyPaymentleModalLabel" aria-hidden="true">
 
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="penaltyPaymentleModalLabel">Penalty</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.penalty.createPayment', $loan->penalty_id)}}" method="POST">
            @csrf

            <label for="date" >Add Penalty Payment</label>
            <input  class="form-control" type="numeric" name="penalty_payment_amount" id="penalty_payment_amount" value="" required>
            
            <label for="remarks">Date</label>
            <input class="form-control" type="date" name="payment_date" id="payment_date" value="" required>

            <label for="remarks">OR Number</label>
            <input class="form-control" type="numeric" name="or_number" id="or_number" value="">
            

        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn bu-orange text-light">Save Payment</button>
        </div>

        </form>
      </div>
    </div>
  </div>
