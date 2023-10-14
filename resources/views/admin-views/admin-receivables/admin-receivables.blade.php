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
                            <div class="m-0 fw-bold fs-5"> Schedule of Recievables</div> <br>
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
                                    @for ($year = date('Y'); $year <= $currentYear + 3; $year++)
                                        <option value="{{ $year }}"{{ $year == $selectedYear ? ' selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-outline-dark" name="applyFilterButton">Apply Filter</button>
                            <button type="submit" class="btn btn-outline-primary" name="clearFilterButton">Clear Filter</button>
                        </div>
                    </form>
                </div>

                 <div class="table-responsive">
                        <table class="table admin-table table-striped border" id="loanApplicationTable">
                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th colspan="4" class="sticky-header">UNIT: BU GENERAL ADMINISTRATION</th>
                                    <th colspan="6" class="sticky-header text-center" style="background-color: #4F81BD !important; color: white !important; ">Loan Receivables</th>
                                    <th colspan="6" class="sticky-header text-center" style="background-color: #C0504D !important; color: white !important;">Interest Receivables</th>
                                </tr>
                                <tr style="border-bottom: 2px solid black; ">
                                    <th class="sticky-header" style="background-color: #e9e9e9 !important;">ID</th>
                                    <th class="sticky-header" style="background-color: #e9e9e9 !important;">Principal Borrower</th>
                                    <th class="sticky-header" style="background-color: #e9e9e9 !important; ">Unit</th>
                                    <th class="sticky-header" style="background-color: #e9e9e9 !important;">Date Granted</th>
                                    {{-- Loan Receivable --}}
                                    <th style="background-color: #e9e9e9;">Balance as of 12/31/2022</th>
                                    <th style="background-color: #e9e9e9;">First Quater</th>
                                    <th style="background-color: #e9e9e9;">Second Quater</th>
                                    <th style="background-color: #e9e9e9;">Third Quater</th>
                                    <th style="background-color: #e9e9e9;">Fourth Quater</th>
                                    <th style="background-color: #e9e9e9;">Balance as of 12/31/2023</th>
                                    {{-- Interest Receivable --}}
                                    <th style="background-color: #e9e9e9;">Balance as of 12/31/2022</th>
                                    <th style="background-color: #e9e9e9;">First Quater</th>
                                    <th style="background-color: #e9e9e9;">Second Quater</th>
                                    <th style="background-color: #e9e9e9;">Third Quater</th>
                                    <th style="background-color: #e9e9e9;">Fourth Quater</th>
                                    <th style="background-color: #e9e9e9;">Balance as of 12/31/2023</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loans as $loan)
                                    @if ($selectedUnit == 'All' || $loan->member->units->unit_code == $selectedUnit)
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

                                            <td class="fw-bold">200,000.00</td>
                                            <td>{{$quarterlyPayments[$loan->id][$selectedYear][1] ?? '-'}}</td>
                                            <td>{{$quarterlyPayments[$loan->id][$selectedYear][2] ?? '-'}}</td>
                                            <td>{{$quarterlyPayments[$loan->id][$selectedYear][3] ?? '-'}}</td>
                                            <td>{{$quarterlyPayments[$loan->id][$selectedYear][4] ?? '-'}}</td>

                                            <td>195922.33</td>
                                            <td>36000.00</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>57757.22</td>
                                        </tr>
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
