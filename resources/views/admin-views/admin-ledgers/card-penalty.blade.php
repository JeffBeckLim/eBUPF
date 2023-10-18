<div id="penalty-div" class="border bg-white py-2 px-3 pb-4 mt-2 rounded">
            
    <div class="row g-0">
        <div class="col-12 pb-3 pt-2 border-bottom mb-3">
             <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn penalty-btn mx-2"  data-bs-toggle="tooltip" data-bs-title="Add Penalty" href="#">
                <img style="height: 30px ;" src="{{asset('icons/penalty.svg')}}" alt="">
            </a>

            <span class="fw-bold">Penalties</span>
        </div>
        <div class="col-3">
            Monthly Amortization
        </div>
        <div class="col-9">
            {{$loan->amortization->amort_principal + $loan->amortization->amort_interest}}
        </div>

        <div class="col-3">
            Penalty Rate
        </div>
        <div class="col-9">
            {{$loan->penalty->penalty_rate}}
        </div>

        <div class="col-3">
            Total Penalty for MPL
        </div>
        <div class="col-9 fw-bold text-danger">
            {{number_format($loan->penalty->penalty_total , 2, ',','.')}}
        </div>
    </div>
</div>

