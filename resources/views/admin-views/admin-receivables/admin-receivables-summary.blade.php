@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2">
    <div class="row mt-2">
        <div class="container-fluid">
            <div class="adminbox">
                <div class="row d-flex text-dark mt-3">
                    <div class="col-7 g-0 ps-2 my-auto d-flex align-items-center">
                        <img src="{{ asset('assets/admin-icons/receivables-big.svg') }}" alt="Receivables Big Icon" width="40px" height="40px" style="margin-right: 5px;">
                        <div style="line-height: 0.6;">
                            <div class="m-0 fw-bold fs-5">Schedule of Receivables</div>
                            <br>
                            <div class="fs-7 text-secondary">Yearly Summary</div>
                        </div>
                    </div>
                    <div class="col-5 text-end">
                        <div class="btn-group" style="margin-right: 20px;">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Download Report
                            </button>
                            <ul class="dropdown-menu" id="yearDropdown">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 g-0 mx-3">
                    <style>
                        .scale-1-active {
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white {{ $loan_type == 'mpl' ? 'fw-bold shadow-sm scale-1-active' : '' }}" href="{{ route('admin.receivables.summary', ['report' => $report, 'loan_type' => 'mpl']) }}">
                            <img src="{{ asset('assets/MPL-mini.svg') }}" alt="" style="width: 20px;"> Multi-Purpose Loan Receivables
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="btn border rounded-start-0 w-100 h-100 bg-white {{ $loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : '' }}" href="{{ route('admin.receivables.summary', ['report' => $report, 'loan_type' => 'hsl']) }}">
                            <img src="{{ asset('assets/HSL-mini.svg') }}" alt="" style="width: 20px;"> Housing Loan Receivables
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <form method="get" action="{{ route('admin.receivables.summary', ['report' => $report, 'loan_type' => $loan_type]) }}">
                            <div class="filter-group gap-3 mt-4">
                                <div class="form-group fg-admin" style="width: 150px; position: relative;">
                                    <select name="yearSelect" class="form-control bg-white border-0">
                                        @if($distinctYears == null)
                                            <option value="" selected>No Data</option>
                                        @else
                                            @foreach ($distinctYears as $year)
                                                <option value="{{ $year }}"{{ $year == $selectedYear ? ' selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-outline-dark fw-bold rounded-5 px-4 py-2" style="font-size: 12px" name="applyFilterButton">Apply Filter</button>
                                <button type="submit"class="btn btn-outline-primary fw-bold rounded-5 px-4 py-2" style="font-size: 12px" name="clearFilterButton">Clear Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.receivables', ['report' => 'quarterly', 'loan_type' => $loan_type ]) }}" class="btn text-secondary  fs-7 {{ $report == 'quarterly' ? 'fw-bold' : '' }}">
                            <img width="24" height="24" src="https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/external-quarter-date-and-time-tanah-basah-basic-outline-tanah-basah-2.png" alt="quarterly logo" /> &nbsp;
                            Quarterly
                        </a>
                        <a href="{{ route('admin.receivables.summary', ['report' => 'summary', 'loan_type' => $loan_type ]) }}" class="btn text-secondary fs-7 {{ $report == 'summary' ? 'fw-bold' : '' }}">
                            <i class="bi bi-calendar"></i> &nbsp;
                            Yearly Summary
                        </a>
                        <a href="{{ route('admin.receivables.remit', ['report' => 'remit', 'loan_type' => $loan_type ]) }}" class="btn text-secondary fs-7 {{ $report == 'remit' ? 'fw-bold' : '' }}">
                            <img width="18" height="20" src="https://img.icons8.com/external-tal-revivo-regular-tal-revivo/24/external-bar-chart-in-down-trend-after-market-crash-business-regular-tal-revivo.png" alt="remit logo" /> &nbsp;
                            Yearly Remit
                        </a>
                    </div>
                </div>

                <div class="table-responsive border rounded">
                    <style>
                        #second-tr th {
                            background-color: #f5f5f5;
                            font-size: small;
                        }
                    </style>
                    <table class="table admin-table table-striped border px-1" id="myTable">
                        <thead>
                            <tr>
                                <th style="border: none;"></th>
                                <th style="border: none;"></th>
                                <th colspan="2" class="border-end border-start border-bottom-0 text-center text-muted">{{$selectedYear}} Balances</th>
                                <th style="border: none;"></th>
                            </tr>
                            <tr>
                                <th style="width: 10%;" class="text-center">Unit</th>
                                <th style="width: 15%;" class="text-center">No. of Members</th>
                                <th style="width: 25%;" class="border-start text-center">Principal</th>
                                <th style="width: 25%;" class="border-end text-center">Interest</th>
                                <th style="width: 25%;" class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($units as $unit)
                                @if($unit->members->count() > 0) <!-- Check if the unit has members -->
                                    @php
                                        $unitCode = $unit->unit_code;
                                        $yearlyBalance = $combinedYearlyBalances[$unitCode][$selectedYear] ?? null;
                                    @endphp
                                    @if($yearlyBalance)
                                        <tr>
                                            <td class="fw-bold">{{ $unitCode }}</td>
                                            <td>{{ $unit->members->count() }}</td>
                                            <td>{{ number_format($yearlyBalance['ending_balance_principal'], 2) }}</td>
                                            <td>{{ number_format($yearlyBalance['ending_balance_interest'], 2) }}</td>
                                            <td class="fw-bold">{{ number_format($yearlyBalance['ending_balance_principal'] + $yearlyBalance['ending_balance_interest'], 2) }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update the year options
    function updateYearOptions() {
        var currentYear = new Date().getFullYear();
        var currentMonth = new Date().getMonth() + 1; // Add 1 since getMonth() returns 0-11
        var select = document.getElementById('yearDropdown');

        // Clear existing options
        select.innerHTML = '';

        // Populate the dropdown with the current year
        var currentYearOption = document.createElement('li');
        currentYearOption.innerHTML = '<button class="dropdown-item" type="button" data-year="' + currentYear + '">' + currentYear + '</button>';
        select.appendChild(currentYearOption);

        // Check if it's a new year, and if so, add the next year
        if (currentMonth === 12) {
            var nextYear = currentYear + 1;
            var nextYearOption = document.createElement('li');
            nextYearOption.innerHTML = '<button class="dropdown-item" type="button" data-year="' + nextYear + '">' + nextYear + '</button>';
            select.appendChild(nextYearOption);
        }
    }

    // Add a click event listener to the dropdown items
    document.addEventListener('click', function (event) {
        if (event.target.matches('.dropdown-item')) {
            var selectedYear = event.target.getAttribute('data-year');
            // Generate the URL for the route using Laravel's route function
            var routeUrl = "{{ route('generate.receivables.summary.report', ['year' => 'YEAR_PLACEHOLDER', 'loan_type' => $loan_type]) }}";
            routeUrl = routeUrl.replace('YEAR_PLACEHOLDER', selectedYear);
            window.location.href = routeUrl;
        }
    });

    // Initial population of the dropdown
    updateYearOptions();

    // Set up an interval to check and update the dropdown (every day)
    setInterval(updateYearOptions, 24 * 60 * 60 * 1000); // 24 hours * 60 minutes * 60 seconds * 1000 milliseconds
</script>


@include('admin-components.admin-dataTables')
@endsection
