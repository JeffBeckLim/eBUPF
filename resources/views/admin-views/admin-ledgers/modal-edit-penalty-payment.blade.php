@if ($penalty_payments != null)

@foreach ($penalty_payments as $payments)
    <div class="modal fade" id="editPaymentModal{{$payments->id}}" tabindex="-1" aria-labelledby="editPenaltyPaymentModal" aria-hidden="true">  
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
            <h1 class="modal-title fs-5 fw-bold" id="editPenaltyPaymentModal">Edit Penalty Payment</h1>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h6 class="ms-3" style="font-size: small">Penalty-ID: {{$payments->id}}</h6>
            <div class="modal-body">
                {{-- {{route('admin.penalty.createPayment', $loan->penalty_id)}}     --}}
            <form action="{{route('admin.penalty.updatePayment', $payments->id)}}" method="POST">
                @csrf

                <label for="date" >Add Penalty Payment</label>
                <input  class="form-control" type="numeric" name="penalty_payment_amount" id="penalty_payment_amount" value="{{$payments->penalty_payment_amount}}" required>
                
                <label for="remarks">Date</label>
                <input class="form-control" type="date" name="payment_date" id="payment_date" value="{{$payments->payment_date}}" required>

                <label for="remarks">OR Number</label>
                <input class="form-control" type="numeric" name="or_number" id="or_number" value="{{$payments->or_number}}">
                

            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bu-orange text-light">Update Payment</button>
            </div>

            </form>
        </div>
        </div>
    </div>
@endforeach
@endif
