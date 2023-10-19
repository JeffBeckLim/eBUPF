<div id="penalty-div" class="border bg-white py-2 px-3 pb-4 mt-2 rounded">
          
    <div class="row g-0">
        <div class="col-12 pb-3 pt-2 border-bottom mb-3">
            <p class="ms-2">
                <span class="fw-bold text-danger">Penalties</span>
            </p>
             <a type="button" data-bs-toggle="modal" data-bs-target="#penaltylModal" class="btn penalty-btn mx-2 text-danger" data-bs-title="Add Penalty" href="#">
                <img style="height: 30px ;" src="{{asset('icons/penalty.svg')}}" alt="">
                Add Penalty
            </a>
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
</div>

