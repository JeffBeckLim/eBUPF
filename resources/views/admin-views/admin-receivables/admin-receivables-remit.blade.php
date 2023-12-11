@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container-fluid">
            <div class="adminbox">

                <div class=" d-flex text-dark mt-3">
                    <div class="g-0 ps-2 my-auto d-flex align-items-center">
                        <img src="{{asset('assets/admin-icons/receivables-big.svg')}}" alt="Receivables Big Icon" width="40px" height="40px"  style="margin-right: 5px;">
                        <div style="line-height: 0.6;">
                            <div class="m-0 fw-bold fs-5"> Schedule of Receivables</div> <br>
                            <div class="fs-7 text-secondary">Monthly Remit</div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 g-0 mx-3">
                    <style>
                        .scale-1-active{
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white
                        {{$loan_type == 'mpl' ? 'fw-bold shadow-sm scale-1-active' : ''}}
                        " href="{{route('admin.receivables.remit', ['report' => $report, 'loan_type' => 'mpl'])}}">
                        <img src="{{asset('assets/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        Multi-Purpose Loan Receivables</a>
                    </div>
                    <div class="col-6">
                        <a
                        class="btn border rounded-start-0 w-100 h-100 bg-white
                        {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}"
                        href="{{route('admin.receivables.remit', ['report' => $report, 'loan_type' => 'hsl'])}}">
                        <img src="{{asset('assets/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        Housing Loan Receivables
                    </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <form method="get" action="{{ route('admin.receivables.remit', ['report' => $report, 'loan_type' => $loan_type]) }}">
                            <div class="filter-group gap-3 mt-4">
                                <div class="form-group fg-admin" style="width: 150px; position: relative;">
                                    <select name="unitSelect" class="form-control bg-white border-0">
                                        <option value="All" {{ $selectedUnit == 'All' ? 'selected' : '' }}>All Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->unit_code }}" {{ $selectedUnit == $unit->unit_code ? 'selected' : '' }}>
                                                {{ $unit->unit_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


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
                                <button type="submit" class="btn btn-outline-primary fw-bold rounded-5 px-4 py-2" style="font-size: 12px"name="clearFilterButton">Clear Filter</button>
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

                 <div class="table-responsive border rounded mt-3">
                        <style>
                            #second-tr th{
                                background-color: #f5f5f5;
                                font-size: small;
                            }
                        </style>
                        <table class="table admin-table table-striped border px-1" id="myTable">
                            <thead>
                                <tr>
                                    <th colspan="2" class="border-end"></th>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <th colspan="3" class="text-center border-end text-muted">{{ date("F", mktime(0, 0, 0, $i, 1, 2000)) }}</th>
                                    @endfor
                                    <th colspan="3" class="text-center border-end text-muted">{{ $selectedYear }} TOTAL PAYMENTS</th>
                                </tr>
                                <tr>
                                    <th class="text-center">UNIT</th>
                                    <th class="text-center border-end">Name of Borrower</th>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <th class="text-center">Principal</th>
                                        <th class="text-center">Interest</th>
                                        <th class="text-center border-end">Total</th>
                                    @endfor
                                    <th class="text-center">Principal</th>
                                    <th class="text-center">Interest</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membersWithPayments as $memberData)
                                    @foreach ($memberData['member_loans'] as $loanData)
                                        @if ($selectedUnit == 'All' || $selectedUnit == $memberData['unit_name'])
                                            <tr>
                                                <td class="fw-bold">{{ $memberData['unit_name'] }}</td>
                                                <td class="border-end">{{ $memberData['member_name'] }}</td>
                                                @php
                                                    $monthlyPayments = $loanData['monthly_payments'];
                                                @endphp
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $month = date("F Y", mktime(0, 0, 0, $i, 1, $selectedYear));
                                                        $payments = $monthlyPayments[$month] ?? ['principal' => '', 'interest' => '', 'total' => ''];
                                                    @endphp
                                                    <td class="text-center">{{ $payments['principal'] ?? '' }}</td>
                                                    <td class="text-center">{{ $payments['interest'] ?? '' }}</td>
                                                    <td class="text-center border-end">{{ $payments['total'] ?? '' }}</td>
                                                @endfor
                                                @php
                                                    $loanName = $loanData['loan_name'];
                                                    // Calculate the total payments for the selected year
                                                    $yearlyTotal = ['principal' => 0, 'interest' => 0, 'total' => 0];
                                                    foreach ($monthlyPayments as $payments) {
                                                        $yearlyTotal['principal'] += $payments['principal'];
                                                        $yearlyTotal['interest'] += $payments['interest'];
                                                        $yearlyTotal['total'] += $payments['total'];
                                                    }
                                                @endphp
                                                <td class="text-center">{{ $yearlyTotal['principal'] }}</td>
                                                <td class="text-center">{{ $yearlyTotal['interest'] }}</td>
                                                <td class="text-center fw-bold">{{ $yearlyTotal['total'] }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>

                        </table>

                    </div>
            </div>
        </div>
    </div>
</div>

@include('admin-components.admin-dataTables')
@endsection
