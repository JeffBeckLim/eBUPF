@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" >
        <div class="adminbox" style="margin: 10px 20px">
            <div class="d-flex">
                <div class="d-flex membership-app-header1">
                    <img src="{{asset('icons/admin-icons/remittance.svg')}}" alt="" width="50px" height="58px">
                    <p style="padding-left: 10px; padding-top: 5px;" class="d-flex justify-content-center align-items-center"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Loan Remittance</span></p>
                </div>
            </div>
            <div class="filter-group gap-3">
                <div class="form-group fg-admin" style="width: 150px; position: relative;">
                    <select id="campusSelect" class="form-control bg-white border-0">
                        <option value="All">Quarter</option>
                        <option value="Main">1st Quarter</option>
                        <option value="Daraga">2nd Quarter</option>
                        <option value="East">3rd Quarter</option>
                    </select>
                </div>
                <div class="form-group fg-admin" style="width: 150px; position: relative;">
                    <select id="unitSelect" class="form-control bg-white border-0">
                        <option value="All">Year</option>
                        <option value="BUCS">2023</option>
                        <option value="CBEM">2022</option>
                        <option value="unit3">2021</option>
                    </select>
                </div>
                <div class="form-group fg-admin" style="width: 150px; position: relative;">
                    <select id="unitSelect" class="form-control bg-white border-0">
                        <option value="All">All</option>
                        <option value="mpl">MPL</option>
                        <option value="hsl">HSL</option>
                    </select>
                </div>
                <button id="remit-btn" class="btn btn-outline-dark" style="margin: 0 0 20px 0">Apply Filter</button>
                <button id="remit-btn" class="btn btn-outline-primary" style="margin: 0 0 20px 0">Clear Filter</button>

            </div>

            <div class="text-add-payment">
                Add New Payment
            </div>
            <div id="myAlert">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
                    <p style="font-size: 14px" class="m-0">{{session('success')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                    <p style="font-size: 14px" class="m-0">{{session('error')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <form method="POST" action="{{route('add.payment.remittance')}}">
                @csrf
                <div class="row g-0 mt-3" style="margin-left: 1px;">
                    <div class="col-md-2 pe-1">
                        <label for="or_number" class="fw-bold">OR Number <span class="fw-bold text-danger">*</span></label>
                        <input id="or_number_input" class="form-control" name="or_number" type="number" value="{{ old('or_number') }}" min="1" placeholder="Enter OR No." required>                    </div>

                    <div class="col-md-2 pe-1 pb-3">
                        <label for="payment_date" class="fw-bold">Date <span class="fw-bold text-danger">*</span></label>
                        <input id="payment_date_input" class="form-control" name="payment_date" type="date" value="{{ old('payment_date') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="loan_id" class="fw-bold">Loan ID <span class="fw-bold text-danger">*</span></label>
                        <select name="loan_id" id="loan_id" class="form-control" value="{{ old('loan_id') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                            <option value="" disabled selected>Select a Loan ID</option>
                            @foreach ($loans as $loan)
                                <option value="{{ $loan->id }}">
                                    ID: {{$loan->id}} -
                                    {{$loan->loanType->loan_type_name}} -
                                    {{ substr($loan->member->firstname, 0, 1) }}. {{ $loan->member->lastname }} -
                                    {{ $loan->member->units->unit_code }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="principal" class="fw-bold">Principal</label>
                        <input id="principal_input" class="form-control" name="principal" type="number" min="0" value="{{ old('principal') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);">
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="interest" class="fw-bold">Interest <span class="fw-bold text-danger">*</span></label>
                        <input id="interest_input" class="form-control w-100" name="interest" type="number" min="0" value="{{ old('interest') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);">
                    </div>

                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        {{-- <button id="remit-btn" class="btn btn-primary" type="submit">Add Payment</button> --}}
                        <button id="apply-button" type="button" class="btn btn-primary rounded-4 fs-6" data-bs-toggle="modal" data-bs-target="#addPayment">Add Payment</button>
                    </div>
                </div>
                @include('admin-views.admin-loan-remittance.modal-add-payment')
            </form>
        </div>

        <div class="adminbox" style="margin:10px 20px;">
            <div>
                <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                <input type="text" class="membership-application-search-input">
            </div>
            <div class="text-remit-table-head">Loan Payments</div>
            <div class="table-responsive">
                <div class="custom-table-for-admin p-2 pt-3">
                    <table class="table admin-table table-striped ">
                        <thead style="border-bottom: 2px solid black">
                            <tr>
                                <th>ID</th>
                                <th>OR Number</th>
                                <th>Principal Borrower</th>
                                <th>Unit</th>
                                <th>Date</th>
                                <th>Principal</th>
                                <th>Interest</th>
                                <th class="text-danger">MRI Adj</th>
                                <th>Total</th>
                                <th>Loan Particular</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sortedPayments = $payments->sortByDesc('created_at');
                            @endphp
                            @foreach ($sortedPayments as $payment)
                            <tr class="table-row" data-status="">
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->or_number }}</td>
                                <td><a href="#" class="fw-bold text-dark" style="text-decoration: none;">{{ $payment->member->firstname }} {{ $payment->member->middle_initial }}. {{ $payment->member->lastname }}</a></td>
                                <td>BU{{ $payment->member->units->unit_code }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->principal }}</td>
                                <td>{{ $payment->interest }}</td>
                                <td></td>
                                <td>{{ $payment->principal + $payment->interest }}</td>
                                <td><span class="fw-bold">{{ $payment->loan->loanType->loan_type_name }}</span> {{ $payment->loan_id }}</td>
                                <td>
                                    <button type="button" class="btn p-2" data-bs-toggle="modal" data-bs-target="#statusModal{{$payment->id}}">
                                        <h5 class="m-0"><i style="color: #1d85d0" class="bi bi-pencil-square"></i></h5>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

<script>
   $(document).ready(function() {
    //get the value of the form field
    var orNumberInput = $("#or_number_input");
    var loanIdSelect = $("#loan_id"); // Update the selector
    var principalInput = $("#principal_input");
    var interestInput = $("#interest_input");
    var applyButton = $("#apply-button");
    var paymentDateInput = $("#payment_date_input");

    //check if all fields are filled or not
    function areInputsFilled() {
        return (
            orNumberInput.val().trim() !== "" &&
            loanIdSelect.val().trim() !== "" &&
            interestInput.val().trim() !== "" &&
            paymentDateInput.val().trim() !== ""
        );
    }

    // Function to enable/disable the button based on input values
    function updateButtonState() {
        if (areInputsFilled()) {
            applyButton.prop("disabled", false); // Enable the button
        } else {
            applyButton.prop("disabled", true); // Disable the button
        }
    }

    // this is to track the changes in the input fields
    orNumberInput.on("input", updateButtonState);
    paymentDateInput.on("input", updateButtonState);
    loanIdSelect.on("change", updateButtonState);
    interestInput.on("input", updateButtonState);

    // call the function to update the button enable/disable state
    updateButtonState();

    $("#apply-button").on("click", function() {
        var or_number = orNumberInput.val();
        var payment_date = paymentDateInput.val();
        var loan_id = loanIdSelect.val();
        var principal = principalInput.val().trim();
        var interest = interestInput.val();

        // If the principal is empty, set it to 0
        if (principal === "") {
            principal = "0";
        }

        // Parse the payment_date string into a Date object
        var paymentDateObj = new Date(payment_date);

        // Define an array of month names
        var monthNames = ["January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December"];

        // Extract the components of the date
        var year = paymentDateObj.getFullYear();
        var monthIndex = paymentDateObj.getMonth();
        var day = paymentDateObj.getDate();

        // Format the date as "Month Day, Year"
        var formattedPaymentDate = monthNames[monthIndex] + " " + day + ", " + year;

        $("#or_number_modal").text(or_number);
        $("#payment_date_modal").text(formattedPaymentDate);
        $("#loan_id_modal").text(loan_id);
        var total = parseFloat(principal) + parseFloat(interest);
        $("#principal_modal").text(parseFloat(principal).toFixed(2));
        $("#interest_modal").text(parseFloat(interest).toFixed(2));
        $("#total_modal").text(parseFloat(total).toFixed(2));
    });
});

    function hideAlert() {
        var alert = document.getElementById('myAlert');
        alert.style.display = 'none';
    }
    setTimeout(hideAlert, 7000);

</script>
@endsection
