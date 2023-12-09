<div class="modal fade" id="penaltyPaymentModal" tabindex="-1" aria-labelledby="penaltyPaymentleModalLabel" aria-hidden="true">
 
  
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="penaltyPaymentleModalLabel">Penalty</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('admin.penalty.createPayment')}}" method="POST">
            @csrf
            <label for="remarks">Date *</label>
            <select name="penalty_id" id="penalty_id" class="form-control form-select">
              <option disabled value selected>Choose Penalty to pay</option>
              @foreach ($loan->penalty as $penalty)
                    
              @php

                    $penalty_payment_instance = App\Models\PenaltyPayment::where('penalty_id', $penalty->id)->sum('penalty_payment_amount');
              @endphp
                  <option value="{{$penalty->id}}" {{$penalty->penalty_total-$penalty_payment_instance < 1? 'disabled' : ''}}>
                    ID: {{$penalty->id}}, {{$months[$penalty->penalized_month-1]}}, {{$penalty->penalized_year}},
                    @if ($penalty->penalty_total-$penalty_payment_instance < 1)
                        Paid
                    @else
                      Remaining balance: {{$penalty->penalty_total-$penalty_payment_instance}}
                    @endif
                  </option>
              @endforeach
            </select>

            <label for="date" >Add Penalty Payment *</label>
            <input  class="form-control" type="numeric" name="penalty_payment_amount" id="penalty_payment_amount" value="" required>
            
            <label for="remarks">Payment Date</label>
            <input class="form-control" type="date" name="payment_date" id="payment_date" value="">

            <label for="remarks">OR Number</label>
            <input class="form-control" type="numeric" name="or_number" id="or_number" value="">


        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn bu-orange text-light disabled" id="submit-pay">Save Payment</button>
        </div>

        </form>
      </div>
    </div>
  </div>
<script>
// Get references to form elements
const penaltyIdSelect = document.getElementById("penalty_id");
const penaltyPaymentAmountInput = document.getElementById("penalty_payment_amount");
const submitBtn = document.getElementById("submit-pay");

// Event listener for input and select changes
penaltyIdSelect.addEventListener("input", toggleSubmitButtonState);
penaltyPaymentAmountInput.addEventListener("input", toggleSubmitButtonState);

// Function to toggle submit button state based on field values
function toggleSubmitButtonState() {
  const isFieldsNotEmpty = penaltyIdSelect.value.trim() !== "" && penaltyPaymentAmountInput.value.trim() !== "";
  submitBtn.disabled = !isFieldsNotEmpty;

  // If you want to toggle the "disabled" class as well
  if (isFieldsNotEmpty) {
    submitBtn.classList.remove("disabled");
  } else {
    submitBtn.classList.add("disabled");
  }
}
</script>