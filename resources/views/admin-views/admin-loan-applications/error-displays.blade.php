<style>
/* CSS for the alert */
    .alert-fixed {
    position: fixed;
    top: 20px;
    z-index: 9999;
    /* width: 40%; */
    padding: 10px;
    transition: right 0.3s ease-in-out; /* Transition property for the 'right' property */
    }

    .slide-in {
    position: fixed;
    top: 0;
    right: -100%; /* Initially position it outside the viewport */
    width: 30%; /* Set the width as needed */
    height: 100%; /* Set the height as needed */
    padding: 20px;
    animation: slideIn 0.4s forwards; /* Animation with forwards to retain final state */
    }

    @keyframes slideIn {
    to {
        right: 0; /* Slide it in to the desired position */
    }
    }


</style>


<div id="myAlert" class="alert-fixed alert-fixed slide-in">

    {{-- AMORTIZATION ======================================================================  --}}
    @if (session('date_error'))
        <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
            <p style="font-size: 12px" class="m-0">AMORTIZATION: {{session('date_error')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('dateMatchError'))
        <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
            <p style="font-size: 12px" class="m-0">AMORTIZATION: {{session('dateMatchError')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('amort_success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
            <p style="font-size: 12px" class="m-0">AMORTIZATION: {{session('amort_success')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @error('amort_principal')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">AMORTIZATION: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error('amort_interest')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">AMORTIZATION: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error('amort_start')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">AMORTIZATION: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    {{-- AMORTIZATION =================================================================================--}}





    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
            <p style="font-size: 12px" class="m-0">{{session('success')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif




    {{-- LOAN DETAILS =============================================================================== --}}
    @error('principal_amount')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">LOAN APP: {{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @error('interest')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">LOAN APP: {{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @error('loan_term')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">LOAN APP: {{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @error('term_years')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">LOAN APP: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    {{-- LOAN DETAILS ============================================================================ --}}


    {{-- ADJUSTMENTS ============================================================================= --}}
    {{-- 'mri'=> 'nullable|numeric|min:0',
                'interest_rebate'=> 'nullable|numeric|min:0',
                'previous_loan_balance'=> 'nullable|numeric|min:0',
                'interest_first_yr'=> 'nullable|numeric|min:0',
                'housing_service_fee'=> 'nullable|numeric|min:0', --}}
    @error('interest_rebate')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">ADJUSTMENTS: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error('previous_loan_balance')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">ADJUSTMENTS: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error('interest_first_yr')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">ADJUSTMENTS: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error('housing_service_fee')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">ADJUSTMENTS: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror

    @error('previous_penalty')
    <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
        <p style="font-size: 12px" class="m-0">ADJUSTMENTS: {{$message}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror


</div>
{{-- ADJUSTMENTS ============================================================================= --}}


<script>
    
    // Function to hide the alert after a specific time (e.g., 5 seconds)
    function hideAlert() {
        var alert = document.getElementById('myAlert');
        alert.style.display = 'none';
    }

    // Set a timeout to call the hideAlert function after 7 seconds (7000 milliseconds)
    setTimeout(hideAlert, 7000);
</script>

