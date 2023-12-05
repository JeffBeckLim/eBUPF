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
                            <div class="fs-7 text-secondary">Quarterly</div>
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
                        " href="{{route('admin.receivables', ['report' => 'quarterly', 'loan_type' => 'mpl'])}}">
                        <img src="{{asset('assets/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        Multi-Purpose Loan Receivables</a>
                    </div>
                    <div class="col-6">
                        <a
                        class="btn border rounded-start-0 w-100 h-100 bg-white
                        {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}"
                        href="{{route('admin.receivables', ['report' => 'quarterly', 'loan_type' => 'hsl'])}}">
                        <img src="{{asset('assets/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        Housing Loan Receivables
                    </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <form method="get" action="{{ route('admin.receivables', ['report' => $report, 'loan_type' => $loan_type]) }}">
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

                                <button type="submit" class="btn btn-outline-dark" name="applyFilterButton">Apply Filter</button>
                                <button type="submit" class="btn btn-outline-primary" name="clearFilterButton">Clear Filter</button>
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
                            #second-tr th{
                                background-color: #f5f5f5;
                                font-size: small;
                            }
                        </style>
                        <table class="table admin-table table-striped border px-1" id="myTable">
                            <thead>
                                <tr>
                                    <th colspan="4"></th>
                                    <th colspan="6" class=" text-center" style="background-color: #4F81BD !important; color: white !important; ">Loan Receivables</th>
                                    <th colspan="6" class=" text-center" style="background-color: #C0504D !important; color: white !important;">Interest Receivables</th>
                                </tr>
                                <tr id="second-tr">
                                    <th>ID</th>
                                    <th>Principal Borrower</th>
                                    <th>Unit</th>
                                    <th>Date Granted</th>
                                    {{-- Loan Receivable --}}
                                    <th>Balance as of {{ Carbon\Carbon::createFromDate($selectedYear - 1, 12, 31)->format('M. d, Y') }}</th>
                                    <th>First Quarter</th>
                                    <th>Second Quarter</th>
                                    <th>Third Quarter</th>
                                    <th>Fourth Quarter</th>
                                    <th>Balance as of {{ Carbon\Carbon::createFromDate($selectedYear, 12, 31)->format('M. d, Y') }}</th>
                                    {{-- Interest Receivable --}}
                                    <th>Balance as of {{ Carbon\Carbon::createFromDate($selectedYear - 1, 12, 31)->format('M. d, Y') }}</th>
                                    <th>First Quarter</th>
                                    <th>Second Quarter</th>
                                    <th>Third Quarter</th>
                                    <th>Fourth Quarter</th>
                                    <th>Balance as of {{ Carbon\Carbon::createFromDate($selectedYear, 12, 31)->format('M. d, Y') }}</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($loans as $loan)

                                    @php
                                        $amortStartYear = \Carbon\Carbon::parse($loan->amortization->amort_start)->year;
                                        $amortEndYear = \Carbon\Carbon::parse($loan->amortization->amort_end)->year;
                                    @endphp

                                    @if ($selectedUnit == 'All' || $loan->member->units->unit_code == $selectedUnit)
                                        @for ($year = $amortStartYear; $year <= $amortEndYear; $year++)
                                            @if ($year == $selectedYear)
                                                <tr>
                                                    <td>{{$loan->id}}</td>
                                                    <td>
                                                        {{$loan->member->firstname}}
                                                        {{$loan->member->lastname}}
                                                    </td>
                                                    <td>
                                                        {{$loan->member->units->unit_code}}
                                                    </td>
                                                    <td>
                                                        @php
                                                        $dateString = $loan->amortization->amort_start;
                                                        $date = \Carbon\Carbon::parse($dateString);
                                                        $oneMonthAgo = $date->subMonth();
                                                        @endphp
                                                        {{ $oneMonthAgo->format('M. Y') }}
                                                    </td>

                                                    <td class="fw-bold">
                                                        {{ number_format($yearlyBalances[$loan->id][$year]['beginning_balance_principal'], 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPayments[$loan->id][$year][1] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPayments[$loan->id][$year][2] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPayments[$loan->id][$year][3] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPayments[$loan->id][$year][4] ?? 0, 2) }}
                                                    </td>
                                                    <td class="fw-bold">
                                                        {{ number_format($yearlyBalances[$loan->id][$year]['ending_balance_principal'], 2) }}
                                                    </td>
                                                    <td class="fw-bold">
                                                        {{ number_format($yearlyBalances[$loan->id][$year]['beginning_balance_interest'], 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPaymentsForInterest[$loan->id][$year][1] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPaymentsForInterest[$loan->id][$year][2] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPaymentsForInterest[$loan->id][$year][3] ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($quarterlyPaymentsForInterest[$loan->id][$year][4] ?? 0, 2) }}
                                                    </td>
                                                    <td class="fw-bold">
                                                        {{ number_format($yearlyBalances[$loan->id][$year]['ending_balance_interest'], 2) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endfor
                                    @endif
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
