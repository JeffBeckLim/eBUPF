<div id="penalty-div" class="border bg-white py-2 px-3 pb-4 mt-2 rounded">

    <div class="row g-0">
        <div class="col-12 pb-3 pt-2 border-bottom mb-3">
            <p class="ms-2">
                <span class="fw-bold text-danger">Penalties</span>
            </p>
             {{-- <a type="button" data-bs-toggle="modal" data-bs-target="#penaltyModal" class="btn penalty-btn mx-2 text-danger" data-bs-title="Add Penalty" href="#">
                <img style="height: 20px;" src="{{asset('assets/penalty.svg')}}" alt="">
                Update Penalty
            </a> --}}

          

            {{-- Parse again to re initialize the --}}
            @php
                // Parse the start and end dates as Carbon objects
                $carbonStartDate = Carbon\Carbon::parse($loan->amortization->amort_start);
                
                $carbonEndDate = Carbon\Carbon::parse($loan->amortization->amort_end);

                $startMonth = $carbonStartDate->month;
                $startYear = $carbonStartDate->year;

                $endMonth = $carbonEndDate->month;
                $endYear = $carbonEndDate->year;
            @endphp
            
            <form action="{{route('admin.penalty.updateOrCreate', $loan->id)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <label  for="yearSelect">Year Penalized</label>
                        <select class="form-select form-control" id="yearSelect" name="penalized_year">
                            <option selected disabled>Choose Year</option>
                            @for ($i = $startYear ;$i <= $endYear; $i++)
                           
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        @error('penalized_year')
                            <h6 class="text-danger">{{$message}}</h6>    
                        @enderror
                        
                    </div>
                    <div class="col-lg-3 col-12">                  
                        <label for="">Month Penalized</label>
                        <select name="penalized_month" class="form-select form-control" id="monthSelect" disabled></select>
                        @error('penalized_month')
                            <h6 class="text-danger">{{$message}}</h6>    
                        @enderror
                    </div>
                    <div class="col-lg-4 col-12">                   
                        <label for="">Penalty amount for the Month</label>
                        <input type="number" class="form-control" id="penalty_amount_input" name="penalty_total" disabled></input>
                        @error('penalty_total')
                            <h6 class="text-danger">{{$message}}</h6>    
                        @enderror
                    </div>
                    <div class="col  d-flex align-content-center mt-2">                   
                        <button class="btn btn-danger w-100 disabled" type="submit" id="submit-btn">
                            Add Penalty
                        </button>
                    </div>
                </div>
               
                
            </form>

        </div>
        <div class="col-3">
            Monthly Amortization
        </div>
        <div class="col-9">
            {{number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.',',')}}
        </div>

        {{-- <div class="col-3">
            Penalty Rate
        </div>
        <div class="col-9">
            @if ($loan->penalty)
            {{$loan->penalty->penalty_rate}}
            @endif
        </div> --}}

        <div class="col-3">
            Total Penalty for <strong>{{$loan->loanType->loan_type_name}}</strong>
        </div>
        <div class="col-9 text-danger">
            @if ($loan->penalty)
                @php
                $sum = 0;
                    foreach ($loan->penalty as $penalty) {
                       $sum += $penalty->penalty_total;
                    }
                @endphp
                {{number_format($sum , 2, '.',',')}}
                
            @endif
        </div>

        <div class="col-3">
            Penalty Payment Sum
        </div>
        <div class="col-9 text-success">
            <span class="">{{number_format($sumPenaltyPayments, 2,'.',',')}}</span>
        </div>

        <div class="col-3">
            Penalty Balance
        </div>
        <div class="col-9" style="font-size: 20px">
            @if ($loan->penalty)
                <span class="text-danger fw-bold">{{number_format($sum  - $sumPenaltyPayments , 2,'.',',')}}</span>
            @endif
        </div>
      
    </div>

    <div class="row">
        <div class="table-responsive border mt-3">
            @if ($loan->penalty != null)
                <a class="btn btn-outline-dark mt-2" href="#" data-bs-toggle="modal" data-bs-target="#penaltyPaymentModal">
                    <i class="bi bi-plus"></i>
                    Add Penalty Payment
                </a>
            @endif
            <table class="table caption-top">
                <caption class="ps-1 mt-3">Penalty Payments</caption>
                
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">OR Number</th>
                    {{-- <th scope="col">. . .</th> --}}
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
                        {{-- <td class="text-center">

                            <button type="button" class="btn btn-link disa" data-bs-toggle="modal" data-bs-target="#editPaymentModal{{$payments->id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                        </td> --}}
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

<script>
var startMonth = @json($startMonth);
var startYear = @json($startYear);

var endMonth = @json($endMonth);
var endYear = @json($endYear);

function appendMonths(startingMonth, endingMonth) {
  const months = [
    "January", "February", "March", "April",
    "May", "June", "July", "August",
    "September", "October", "November", "December"
  ];

  const select = document.getElementById("monthSelect");

  // Clear existing options
  select.innerHTML = '';

  // Populate select with month options
  for (let i = startingMonth - 1; i < endingMonth; i++) {
    const option = document.createElement("option");
    option.text = months[i];
    option.value = i + 1; // Month index is 1-based
    select.add(option);
  }
}

const yearSelect = document.getElementById("yearSelect");


// Event listener for the change event
yearSelect.addEventListener("change", function() {
    const monthSelect = document.getElementById("monthSelect");
    const inputPenalty = document.getElementById("penalty_amount_input");
  const selectedOption = yearSelect.options[yearSelect.selectedIndex];


  monthSelect.removeAttribute("disabled");
  inputPenalty.removeAttribute("disabled");
  if(startYear == endYear){
    appendMonths(1, 12);
  }
  else if (selectedOption.value == startYear) {
    appendMonths(startMonth, 12);
  }
  else if (selectedOption.value == endYear) {
    appendMonths(1, startMonth); 
  }
  else {
    appendMonths(1, 12);
  }

//   console.log("Selected Value:", selectedOption.value);
//   console.log("Selected Text:", selectedOption.text);
});
const inputPenalty = document.getElementById("penalty_amount_input");
inputPenalty.addEventListener("input", function() {
    const submitBtn = document.getElementById("submit-btn");
    if(inputPenalty.value == ''){
        submitBtn.classList.add('disabled');
    }
    else{
        submitBtn.classList.remove('disabled');
    }
    
});
    // Example: Append months starting from March (index 3)
    // appendMonths(3);
    
</script>