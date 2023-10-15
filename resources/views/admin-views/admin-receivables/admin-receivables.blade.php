@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container-fluid">
            <div class="adminbox">

                <div class=" d-flex text-dark mt-3">
                    <div class="g-0 ps-2 my-auto d-flex align-items-center">
                        <img src="{{asset('icons/admin-icons/receivables-big.svg')}}" alt="Receivables Big Icon" width="40px" height="40px"  style="margin-right: 5px;">
                        <div style="line-height: 0.6;">
                            <div class="m-0 fw-bold fs-5"> Schedule of Receivables</div> <br>
                            <div class="fs-7 text-secondary">Quarterly</div>
                        </div>

                    </div>
                </div>

                <div class="row mt-4 g-0 mx-3">
                    <style>
                        .scale-1-active{
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white
                        " href="">
                        <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        Multi-Purpose Loans</a>
                    </div>
                    <div class="col-6">
                        <a
                        class="btn border rounded-start-0 w-100 h-100 bg-white"
                        href="">
                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        Housing Loans
                    </a>
                    </div>
                </div>
                <div>
                    <form method="get" action="{{ route('admin.receivables') }}">
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
                                    @foreach ($distinctYears as $year)
                                        <option value="{{ $year }}"{{ $year == $selectedYear ? ' selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-outline-dark" name="applyFilterButton">Apply Filter</button>
                            <button type="submit" class="btn btn-outline-primary" name="clearFilterButton">Clear Filter</button>
                        </div>
                    </form>
                </div>
                 <div class="table-responsive border rounded mt-3">
                        <style>
                            #second-tr th{
                                background-color: #f5f5f5;
                                font-size: small;
                            }
                        </style>
                        <table class="table admin-table table-striped border" id="myTable">
                            <thead>
                                <tr>
                                    <th colspan="4">UNIT: BU GENERAL ADMINISTRATION</th>
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
