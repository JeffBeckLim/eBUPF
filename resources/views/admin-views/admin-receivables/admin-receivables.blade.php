@extends('admin-components.admin-layout')

@section('content')
<style>
    .view {
        margin: auto;
        min-height: auto;
        max-height: 550px;
    }

    .wrapper {
        position: relative;
        overflow: auto;
        white-space: nowrap;
    }

    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }

    .first-col {
        width: 35px;
        min-width: 35px;
        max-width: 35px;
        left: 0px;
    }

    .second-col {
        width: 150px;
        min-width: 150px;
        max-width: 150px;
        left: 35px;
    }

    .third-col {
        width: 80px;
        min-width: 80px;
        max-width: 80px;
        left: 185px;
    }

    .fourth-col {
        width: 120px;
        min-width: 120px;
        max-width: 120px;
        left: 265px;
        border-right: 1px solid #dee2e6;
    }

    table{
        border-collapse: collapse;
    }

    thead.sticky{
        position: sticky;
        top: 0;
        z-index: 1;
    }
    th.first-col{
        position: sticky;
        left: 0;
        z-index: 2;
    }

</style>
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

                <div class="filter-group gap-3 mt-4">
                    <div class="form-group fg-admin" style="width: 150px; position: relative;">
                        <select id="campusSelect" class="form-control bg-white border-0">
                            <option value="All">Unit</option>
                            <option value="Main">CS</option>
                            <option value="Daraga">GASS</option>
                            <option value="East">CBEM</option>
                        </select>
                    </div>

                    <div class="form-group fg-admin" style="width: 150px; position: relative;">
                        <select id="yearSelect" class="form-control bg-white border-0">
                            @for ($year = date('Y'); $year <= $currentYear + 3; $year++)
                                <option value="{{ $year }}"{{ $year == $currentYear ? ' selected' : '' }}>{{ $year }}</option>
                            @endfor

                        </select>
                    </div>

                    <button id="applyFilterButton" class="btn btn-outline-dark">Apply Filter</button>
                    <button id="" class="btn btn-outline-primary">Clear Filter</button>
                </div>

                <div style="margin: 30px 0 0 15px;">
                    <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                    <input type="text" class="membership-application-search-input" id="search-input">
                </div>

                <div class="table-responsive border m-3 rounded view">
                    <div class="wrapper mx-1" style="min-height: 200px;max-height: 540px;">
                        <table class="table admin-table table-striped border-top text-center">
                            <thead class="sticky table-header">
                                <tr>
                                    <th colspan="4" class="sticky-col first-col text-center text-secondary">UNIT: BU GENERAL ADMINISTRATION</th>
                                    <th colspan="6" class="text-center" style="background-color: #4F81BD; color: white; border-radius:5px 0 0 5px;">Loan Receivables</th>
                                    <th colspan="6" class="text-center" style="background-color: #C0504D; color: white; border-radius:0 5px 5px 0;">Interest Receivables</th>
                                </tr>
                                <tr style="border-bottom: 2px solid black; ">
                                    <th class="sticky-col first-col" style="background-color: #d9d9d9;">ID</th>
                                    <th class="sticky-col second-col" style="background-color: #d9d9d9;">Principal Borrower</th>
                                    <th class="sticky-col third-col" style="background-color: #d9d9d9;">Unit</th>
                                    <th class="sticky-col fourth-col" style="background-color: #d9d9d9;">Date Granted</th>
                                    {{-- Loan Receivable --}}
                                    <th style="background-color: #d9d9d9;">Balance as of 12/31/2022</th>
                                    <th style="background-color: #d9d9d9;">First Quater</th>
                                    <th style="background-color: #d9d9d9;">Second Quater</th>
                                    <th style="background-color: #d9d9d9;">Third Quater</th>
                                    <th style="background-color: #d9d9d9;">Fourth Quater</th>
                                    <th style="background-color: #d9d9d9;">Balance as of 12/31/2023</th>
                                    {{-- Interest Receivable --}}
                                    <th style="background-color: #d9d9d9;">Balance as of 12/31/2022</th>
                                    <th style="background-color: #d9d9d9;">First Quater</th>
                                    <th style="background-color: #d9d9d9;">Second Quater</th>
                                    <th style="background-color: #d9d9d9;">Third Quater</th>
                                    <th style="background-color: #d9d9d9;">Fourth Quater</th>
                                    <th style="background-color: #d9d9d9;">Balance as of 12/31/2023</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loans as $loan)
                                    <tr>
                                        <td class="sticky-col first-col">{{$loan->id}}</td>
                                        <td class="sticky-col second-col">
                                            {{$loan->member->firstname}}
                                            {{$loan->member->lastname}}
                                        </td>
                                        <td class="sticky-col third-col">
                                            {{$loan->member->units->unit_code}}
                                        </td>
                                        <td class="sticky-col fourth-col">
                                            @php
                                            $dateString = $loan->amortization->amort_start;
                                            $date = \Carbon\Carbon::parse($dateString);
                                            $oneMonthAgo = $date->subMonth();
                                            @endphp
                                        {{ $oneMonthAgo->format('M. Y') }}
                                        </td>

                                        <td class="fw-bold">200,000.00</td>
                                        <td>{{$quarterlyPayments[$loan->id][2023][1] ?? '-'}}</td>
                                        <td>{{$quarterlyPayments[$loan->id][2023][2] ?? '-'}}</td>
                                        <td>{{$quarterlyPayments[$loan->id][2023][3] ?? '-'}}</td>
                                        <td>{{$quarterlyPayments[$loan->id][2023][4] ?? '-'}}</td>

                                        <td>195922.33</td>

                                        <td>36000.00</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>57757.22</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the header element
    const header = document.querySelector('thead.sticky');

    // Get the table container
    const tableContainer = document.querySelector('.view');

    // Add an event listener to scroll
    tableContainer.addEventListener('scroll', () => {
        // Get the current scroll position
        const scrollTop = tableContainer.scrollTop;

        // Set the top style property of the header to make it sticky
        header.style.top = `${scrollTop}px`;
    });
</script>
@include('admin-components.admin-dataTables')
@endsection
