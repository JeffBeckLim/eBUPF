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
                        MPL Applications Tracking</a>
                    </div>
                    <div class="col-6">
                        <a
                        class="btn border rounded-start-0 w-100 h-100 bg-white"
                        href="">
                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        HSL Applications Tracking
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
                        <select id="campusSelect" class="form-control bg-white border-0">
                            <option value="All">All Year</option>
                            <option value="Main">2023</option>
                            <option value="Daraga">2024</option>
                            <option value="East">2025</option>
                        </select>
                    </div>
                    <button id="" class="btn btn-outline-dark">Apply Filter</button>
                    <button id="" class="btn btn-outline-primary">Clear Filter</button>
                </div>

                <div style="margin: 30px 0 0 15px;">
                    <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                    <input type="text" class="membership-application-search-input" id="search-input">
                </div>

                <div class="table-responsive border m-3 rounded view">
                    <div class="wrapper">
                        <table class="table admin-table table-striped border-top text-center">
                            <thead>
                                <tr>
                                    <th colspan="4" class="sticky-col first-col text-center text-secondary">UNIT: BU GENERAL ADMINISTRATION</th>
                                    {{-- <th class="sticky-col second-col"></th>
                                    <th class="sticky-col third-col"></th>
                                    <th class="sticky-col fourth-col"></th> --}}
                                    <th colspan="6" class="text-center" style="background-color: #4F81BD; color: white; border-radius:5px 0 0 5px;">Loan Receivables</th>
                                    <th colspan="6" class="text-center" style="background-color: #C0504D; color: white; border-radius:0 5px 5px 0;">Interest Receivables</th>
                                </tr>
                                <tr style="border-bottom: 2px solid black;">
                                    <th class="sticky-col first-col">ID</th>
                                    <th class="sticky-col second-col">Principal Borrower</th>
                                    <th class="sticky-col third-col">Unit</th>
                                    <th class="sticky-col fourth-col">Date Granted</th>
                                    {{-- Loan Receivable --}}
                                    <th>Balance as of 12/31/2022</th>
                                    <th>First Quater</th>
                                    <th>Second Quater</th>
                                    <th>Third Quater</th>
                                    <th>Fourth Quater</th>
                                    <th>Balance as of 12/31/2023</th>
                                    {{-- Interest Receivable --}}
                                    <th>Balance as of 12/31/2022</th>
                                    <th>First Quater</th>
                                    <th>Second Quater</th>
                                    <th>Third Quater</th>
                                    <th>Fourth Quater</th>
                                    <th>Balance as of 12/31/2023</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>

                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>

                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>

                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                                <tr>
                                    <td class="sticky-col first-col">1</td>
                                    <td class="sticky-col second-col">Aaron Labini</td>
                                    <td class="sticky-col third-col">BUCS</td>
                                    <td class="sticky-col fourth-col">10/10/2023</td>

                                    <td>200,000.00</td>
                                    <td>3633.33</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>195922.33</td>

                                    <td>36000.00</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>57757.22</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin-components.admin-dataTables')
@endsection
