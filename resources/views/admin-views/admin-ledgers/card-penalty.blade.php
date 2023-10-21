<div id="penalty-div" class="border bg-white py-2 px-3 pb-4 mt-2 rounded">
          
    <div class="row g-0">
        <div class="col-12 pb-3 pt-2 border-bottom mb-3">
            <p class="ms-2">
                <span class="fw-bold text-danger">Penalties</span>
            </p>
             <a type="button" data-bs-toggle="modal" data-bs-target="#penaltyModal" class="btn penalty-btn mx-2 text-danger" data-bs-title="Add Penalty" href="#">
                <img style="height: 20px;" src="{{asset('icons/penalty.svg')}}" alt="">
                Update Penalty
            </a>

            @if ($loan->penalty_id != null)
            <a class="btn btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#penaltyPaymentModal">
                <i class="bi bi-plus"></i>
                Add Penalty Payment
            </a>    
            @endif
            
        </div>
        <div class="col-3">
            Monthly Amortization
        </div>
        <div class="col-9">
            {{number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.',',')}}
        </div>

        <div class="col-3">
            Penalty Rate
        </div>
        <div class="col-9">
            @if ($loan->penalty)
            {{$loan->penalty->penalty_rate}}     
            @endif
        </div>

        <div class="col-3">
            Total Penalty for <strong>{{$loan->loanType->loan_type_name}}</strong>
        </div>
        <div class="col-9 fw-bold text-danger">
            @if ($loan->penalty)
                {{number_format($loan->penalty->penalty_total , 2, '.',',')}}     
            @endif
        </div>
    </div>

    <div class="row">
        <div class="table-responsive border mt-3">
            <table class="table caption-top">
                <caption class="ps-1 mt-3">Penalty Payments</caption>
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">OR Number</th>
                    <th scope="col">. . .</th>
                  </tr>
                </thead>
                <tbody>
                 @if (count($penalty_payments) != null)
                    @foreach ($penalty_payments as $payments)
                    <tr>
                        <td>{{$payments->id}}</td>
                        <td>{{$payments->penalty_payment_amount}}</td>
                        <td>{{$payments->payment_date}}</td>
                        <td>{{$payments->or_number}}</td>
                        <td class="text-center">

                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{$payments->id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                          
                        </td>
                      </tr>
                     
                    @endforeach    
                    
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            No Penalty Payments exist.
                        </td>
                    </tr>
                 @endif


                </tbody>
            </table>
          </div>
    </div>
</div>

