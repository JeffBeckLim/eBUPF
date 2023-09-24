@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid mt-2">
    <div class="adminbox m-4">
        <div class="d-flex">
            <div class="d-flex membership-app-header1-mpl">
                <img src="{{asset('/icons/MPL-mini.svg')}}" alt="" width="50px">
                <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Multi-Purpose Loan</span> <span class="fw-bold fs-7">Applications</span></p>
            </div>

            <div class="membership-app-header2">
                <div class="lh-1" style="padding: 15px 0 0 15px;">
                    <p class="fw-bold">1 Pending</p>
                    <div class="d-flex">
                        <div class="row">
                            <div class="col-sm-6">
                                <p style="margin-right: 20px; font-size: 0.7rem; width: 100%;" class="text-success">2 Approved</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-danger" style="font-size: 0.7rem; width: 100%">1 Denied</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content p-4">
                <span class="text-center fs-6 fw-bold">Add Status</span>
                <div>
                    <span class="fs-7">Loan ID</span> <br>
                    <span style="color: #0092D1" class="fw-bold">102030</span>
                    <div class="row">
                        <div class="col-7">
                            <span class="fw-bold fs-7">Juan Dela Cruz Jr.</span> <br> <span class="fs-7">BUCS</span>
                        </div>
                        <div class="col-5 d-flex justify-content-end">
                            <span class="fs-7">200,000.00</span>
                        </div>
                        <span class="fs-7">04-23-2023</span>
                    </div>
                </div>
                <div class="mt-3">
                    <select id="statusDropdown" class="form-select fomr-con admin-custom-select">
                        <option value="" disabled selected>Status</option>
                        <option value="Staff">Staff</option>
                        <option value="LoanAnalyst">Loan Analyst</option>
                        <option value="ExeDirector">Executive Director</option>
                        <option value="Check">Check</option>
                      </select>
                </div>
                <div class="mt-2">
                    <input type="date" id="dateInput" class="form-control" />
                </div>
                <div class="mt-2">
                    <textarea id="remarksInput" class="form-control" rows="3" placeholder="Remarks"></textarea>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" class="btn bu-orange p-1 text-white fs-7">Confirm</button>
                </div>
            </div>
        </div>
        <div class="filter-group gap-2 mt-4">
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="monthSelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="All">Month</option>
                    <option value="">January</option>
                    <option value="">February</option>
                    <option value="">March</option>
                    <option value="">April</option>
                    <option value="">May</option>
                    <option value="">June</option>
                    <option value="">July</option>
                    <option value="">August</option>
                    <option value="">September</option>
                    <option value="">October</option>
                    <option value="">November</option>
                    <option value="">December</option>
                </select>
            </div>
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="daySelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="All">Day</option>
                </select>
            </div>
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="typeSelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="All">All Loan</option>
                    <option value="BUCS">New Loan</option>
                    <option value="CBEM">Renewal</option>
                    <option value="unit3">Additional</option>
                </select>
            </div>
            <button id="applyFilterBtn" class="btn btn-primary " style="">Apply Filter</button>
        </div>
        {{-- <div>
            <div class="row mt-4">
                <div class="col-md-6 d-flex">
                    <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                    <input type="text" class="membership-application-search-input">
                </div>
                <div class="col-md-6 d-flex justify-content-end ma-search gap-3">
                    <span class="filter-option active" data-filter="all">All Applications</span>
                    <span class="filter-option" data-filter="approved">Approved</span>
                    <span class="filter-option" data-filter="denied">Denied</span>
                </div>
            </div>
        </div> --}}
        <style>
            th, td{
                font-size: 12px !important;
            }
        </style>
        
        <div class="table-responsive">
                <table class="table admin-table table-striped border mt-2" id="myTable">
                    <thead style="border-bottom: 2px solid black">
                        <tr class="border">
                            <th>Loan ID</th>
                            <th>Loan Type</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th class="border-end">Date Requested</th>

                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Total Payable</th>
                            <th>Term</th>
                            <th>Gross Loan</th>
                            <th>MRI</th>
                            <th>Prev. Loan Balance/Refund</th>
                            <th>Interest Rebate/Refund</th>
                            <th>Penalty</th>
                            <th>Net Proceeds</th>

                            <th class="border-start">Prin</th>
                            <th>Int</th>
                            <th>
                                <p class="text-secondary" style="font-size: 10px">Amortization</p>
                                Monthly
                            </th>
                            <th>Start</th>
                            <th>End</th>
                            <th class="border-end">...</th>

                            <th>Adjusted Net Pay.</th>
                            <th>Check no.</th>
                            <th>Date</th>
                            <th>Remarks</th>

                        </tr>
                    </thead>
                    @if (count($loans) != 0)
                    <tbody>
                        @foreach ($loans as $loan)
                            <tr class="table-row" data-status="">

                                {{-- loan ID --}}
                                <td>
                                    {{$loan->id}}
                                </td>

                                {{-- loan Type --}}
                                <td>
                                    @if($loan->LoanCategoy != null)
                                        {{$loan->LoanCategoy->loan_category_name}}    
                                    @endif
                                </td>

                                {{-- name --}}
                                <td>
                                    {{$loan->member->firstname}}
                                    {{$loan->member->lastname}}
                                </td>

                                {{-- units --}}
                                <td>
                                    {{$loan->member->units->unit_code}}
                                </td>

                                {{-- date of request --}}
                                <td class="border-end">
                                    {{date("F j, Y", strtotime($loan->created_at))}}
                                </td>

                                {{-- principla amount --}}
                                <td>
                                    {{number_format($loan->principal_amount, 2, '.',',')}}  
                                </td>
                                
                                {{-- interest --}}
                                <td>
                                    {{$loan->member->interest}}
                                </td>
                            
                                {{-- total payable --}}
                                <td>
                                    {{number_format($loan->principal_amount + $loan->interest, 2, '.',',')}}
                                </td>

                                {{-- loan term --}}
                                <td>
                                    {{$loan->term_years}}
                                </td>
                                
                                {{-- gross loan -- principal amount lang to --}}
                                <td>
                                    {{$loan->principal_amount}}
                                </td>
                                {{-- MRI --}}
                                <td></td>
                                {{-- Previous Loan Balance --}}
                                <td></td>
                                {{-- Interest Rebate/Refund --}}
                                <td></td>
                                {{-- Penalty --}}
                                <td></td>
                                {{-- Net Proceeds --}}
                                <td></td>
                                
                                {{-- AMORTIZATION --------------- --}}
                                {{-- prin --}}
                                <td class=" border-start"></td>
                                {{-- int --}}
                                <td></td>
                                {{-- monthly --}}
                                <td></td>
                                {{-- start --}}
                                <td>Start</td>
                                {{-- end --}}
                                <td>End</td>
                                <td class="border-end">
                                    <h6>
                                    <a href="#">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    </h6>
                                </td>
                                {{-- check --}}
                                <td>Adjusted Net Pay.</td>
                                <td>Check no.</td>
                                <td>Date</td>
                                <td>Remarks</td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                    @endif
                </table>
        </div>
    </div>
</div>
<script>
    // Generate days of the month
    var daySelect = document.getElementById("daySelect");
    var option = document.createElement("option");
    option.value = "All";
    option.text = "1";
    daySelect.add(option);

    for (var i = 2; i <= 31; i++) {
        option = document.createElement("option");
        option.value = i.toString();
        option.text = i.toString();
        daySelect.add(option);
    }
    document.addEventListener('DOMContentLoaded', function() {
        var filterOptions = document.querySelectorAll('.filter-option');
        var tableRows = document.querySelectorAll('.table-row');

        filterOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                var filterValue = this.getAttribute('data-filter');

                // Remove active class from other options
                filterOptions.forEach(function(filterOption) {
                    filterOption.classList.remove('active');
                });

                // Add active class to clicked option
                this.classList.add('active');

                tableRows.forEach(function(row) {
                    if (filterValue === 'all') {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = row.getAttribute('data-status') === filterValue ? 'table-row' : 'none';
                    }
                });
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const icon = document.querySelector('.icon');
        const buttons = document.querySelector('.buttons');
        const approveBtn = document.querySelector('.approve-btn');
        const denyBtn = document.querySelector('.deny-btn');

        icon.addEventListener('click', function() {
            buttons.style.display = 'block';
        });

        approveBtn.addEventListener('click', function() {
            // Handle approve button click
            console.log('Approved');
            buttons.style.display = 'none';
        });

        denyBtn.addEventListener('click', function() {
            // Handle deny button click
            console.log('Denied');
            buttons.style.display = 'none';
        });
    });
</script>
@include('admin-components.admin-dataTables')
@endsection