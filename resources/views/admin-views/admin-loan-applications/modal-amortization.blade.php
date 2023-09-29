<div class="modal fade" id="amortizationModal{{$loan->id}}" tabindex="-1" aria-labelledby="amortizationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5 fw-bold" id="amortizationModalLabel">Amortization</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="border bg-light rounded p-3">
            Term of the loan: {{$loan->term_years}} years.
        </div>
        <form action="{{route('create.amortization', $loan->id)}}" method="POST">
            @csrf
            <label for="amort_principal">Principal Amount</label>
            <input class="form-control" type="number" name="amort_principal" id="amort_principal" value="{{$loan->amortization != null ? $loan->amortization->amort_principal : ''}}">

            <label for="amort_interest">Interest</label>
            <input class="form-control" type="number" name="amort_interest" id="amort_interest" value="{{$loan->amortization != null ? $loan->amortization->amort_interest : ''}}">
            <div class="row">
                <div class="col-12 mt-3">
                    Amortization Period
                </div>
                <div class="col-6">
                    <label for="amort_start">Start</label>
                    <input class="form-control" type="date" name="amort_start" id="amort_start" value="{{$loan->amortization != null ? $loan->amortization->amort_start : ''}}">
                </div>
                <div class="col-6">
                    <label for="amort_end">End</label>
                    <input class="form-control" type="date" name="amort_end" id="amort_end" value="{{$loan->amortization != null ? $loan->amortization->amort_end : ''}}">
                </div>
            </div>
            <div class="border rounded p-3 mt-2">
                <h6 class="text-secondary" style="font-size: x-small">amortization period difference, start and end</h6>
                <h6 style="font-size: small">Amort Period: <span id="yearsResult"></h6>
                
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

<script>

    // Get the date input elements by their IDs
var dateStartInput = document.getElementById('amort_start');
var dateEndInput = document.getElementById('amort_end');

// Add event listeners to capture changes in the input fields
dateStartInput.addEventListener('input', function() {
    var dateStart = new Date(dateStartInput.value);
    var dateEnd = new Date(dateEndInput.value);
    
    // Calculate the difference in months
    var monthsDiff = (dateEnd.getFullYear() - dateStart.getFullYear()) * 12 + (dateEnd.getMonth() - dateStart.getMonth());

    // Calculate the difference in years and round up to the nearest integer
    var yearsDiff = Math.ceil(monthsDiff / 12);

    // Display the results in the HTML elements
    document.getElementById('monthsResult').innerHTML = monthsDiff;
    document.getElementById('yearsResult').innerHTML = yearsDiff;
});

dateEndInput.addEventListener('input', function() {
    var dateStart = new Date(dateStartInput.value);
    var dateEnd = new Date(dateEndInput.value);

    // Calculate the difference in months
    var monthsDiff = (dateEnd.getFullYear() - dateStart.getFullYear()) * 12 + (dateEnd.getMonth() - dateStart.getMonth());

    // Calculate the difference in years and round up to the nearest integer
    var yearsDiff = Math.ceil(monthsDiff / 12);

    // Display the results in the HTML elements
    // document.getElementById('monthsResult').innerHTML = monthsDiff;
    if(yearsDiff != null){
        document.getElementById('yearsResult').innerHTML = yearsDiff;
    }
});

</script>