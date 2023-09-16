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
                        <option value="BUCS">Medyu All</option>
                        <option value="CBEM">Parang All</option>
                        <option value="unit3">Not All</option>
                    </select>
                </div>
                <button id="remit-btn" class="btn btn-outline-dark" style="margin: 0 0 20px 0">Apply Filter</button>
                <button id="remit-btn" class="btn btn-outline-primary" style="margin: 0 0 20px 0">Clear Filter</button>

            </div>

            <div class="text-add-payment">
                Add New Payment
            </div>
            <form method="POST" action="{{route('add.payment.remittance')}}">
                @csrf
                <div class="row g-0 mt-3" style="margin-left: 1px;">
                    <div class="col-md-2 pe-1">
                        <label for="or_number" class="fw-bold">OR Number</label>
                        <input class="form-control" name="or_number" type="number" value="{{ old('or_number') }}" style="background: #D9E4E9;border-radius: 10px;color:rgb(77, 77, 77);" required>
                    </div>

                    <div class="col-md-2 pe-1 pb-3">
                        <label for="payment_date" class="fw-bold">Date</label>
                        <input id="myForm" class="form-control" name="payment_date" type="date" value="{{ old('payment_date') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="loan_id" class="fw-bold">Loan ID</label>
                        <select name="loan_id" id="loan_id" class="form-control" value="{{ old('loan_id') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                            <option value="" disabled selected>Select a Loan ID</option>
                            @foreach ($loanIds as $loanId)
                                <option value="{{ $loanId }}">{{ $loanId }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="principal" class="fw-bold">Principal</label>
                        <input id="myForm" class="form-control" name="principal" type="number" value="{{ old('principal') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                    </div>

                    <div class="col-md-2 pe-1">
                        <label for="interest" class="fw-bold">Interest</label>
                        <input class="form-control w-100" name="interest" type="number" value="{{ old('interest') }}" style="background: #D9E4E9;border-radius: 10px; color:rgb(77, 77, 77);" required>
                    </div>

                    <div class="col-md-2 d-flex justify-content-center align-items-center mt-3">
                        <button id="remit-btn" class="btn btn-primary" type="submit">Add Payment</button>
                    </div>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>

        <div class="adminbox" style="margin:10px 20px;">
            <div class="row">
                <div class="col-6">
                    <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                    <input type="text" class="membership-application-search-input">
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <a class="apply-changes-btn">Apply Changes</a>
                </div>
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
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


</div>
@endsection
