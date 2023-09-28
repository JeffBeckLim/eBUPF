@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid mt-2">
    <div class="adminbox m-4">
        @if (session('date_error'))
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('date_error')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('dateMatchError'))
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('dateMatchError')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('amort_success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('amort_success')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('success')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @error('principal_amount')
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0">{{$message}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('interest')
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0">{{$message}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('loan_term')
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0">{{$message}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('term_years')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">{{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror
        @error('amort_principal')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">{{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror
        @error('amort_interest')
        <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
            <p style="font-size: 12px" class="m-0">{{$message}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror
            

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
                            <th class="border-end">...</th>

                            <th class="border-end">Gross Loan</th>

                            <th>MRI</th>
                            <th>Prev. Loan Balance/Refund</th>
                            <th>
                                <p class="text-secondary" style="font-size: 10px">Adjustments</p>
                                Interest Rebate/Refund
                            </th>
                            <th>Penalty</th>
                            <th>Net Proceeds</th>
                            <th class="border-end">...</th>


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
                                @php $color = '' @endphp
                                @if ($loan->loanCategory)
                                        @if ($loan->loanCategory->loan_category_name == 'New')
                                            @php $color = '#ffff60;'@endphp
                                        @elseif ($loan->loanCategory->loan_category_name == 'Renewal')
                                            @php $color = '#26de8c;' @endphp
                                        @elseif ($loan->loanCategory->loan_category_name == 'Additional')
                                            @php $color = '#ce6bbf;'@endphp
                                        @endif 
                                    @endif
                                
                                <td style="background-color: {{$color}} font-size: 10px;" class="fw-bold text-center">
                                    @if ($loan->loanCategory)
                                        @if ($loan->loanCategory->loan_category_name == 'New')
                                            {{$loan->loanCategory->loan_category_name}}
                                        @elseif ($loan->loanCategory->loan_category_name == 'Renewal')
                                            {{$loan->loanCategory->loan_category_name}}
                                        @elseif ($loan->loanCategory->loan_category_name == 'Additional')
                                            {{$loan->loanCategory->loan_category_name}}
                                        @endif 
                                    @endif
                                
                                </td>

                                {{-- name --}}
                                <td>
                                    {{ strtoupper($loan->member->lastname)}},
                                    {{$loan->member->firstname}}
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
                                    {{$loan->interest}}
                                </td>
                            
                                {{-- total payable --}}
                                <td>
                                    {{number_format($loan->principal_amount + $loan->interest, 2, '.',',')}}
                                </td>

                                {{-- loan term --}}
                                <td>
                                    {{$loan->term_years}}
                                </td>
                                {{-- ... --}}
                                <td class="border-end">
                                    <h6>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#editLoanModal{{$loan->id}}"  href="#">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </h6>
                                </td>
                                
                                {{-- gross loan -- principal amount lang to --}}
                                <td class="border-end">
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
                                {{-- ... --}}
                                <td>
                                    <h6>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#adjustmentsModal{{$loan->id}}"  href="#">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </h6>
                                </td>
                                
                                {{-- AMORTIZATION --------------- --}}
                                {{-- prin --}}
                                <td class=" border-start">
                                    @if ($loan->amortization != null)
                                        {{$loan->amortization->amort_principal}}
                                    @endif
                                </td>
                                {{-- int --}}
                                <td>
                                    @if ($loan->amortization != null)
                                        {{$loan->amortization->amort_interest}}
                                    @endif
                                </td>
                                {{-- monthly --}}
                                <td>
                                    @if ($loan->amortization != null)
                                        {{$loan->amortization->amort_principal + $loan->amortization->amort_interest}}
                                    @endif
                                </td>
                                {{-- start --}}
                                <td>
                                    @if ($loan->amortization != null)
                                        @if ($loan->amortization->amort_start != null)
                                            {{date("F j, Y", strtotime($loan->amortization->amort_start))}} 
                                        @endif
                                    @endif
                                </td>
                                {{-- end --}}
                                <td>
                                    @if ($loan->amortization != null)
                                        @if ($loan->amortization->amort_end != null)
                                            {{date("F j, Y", strtotime($loan->amortization->amort_end))}} 
                                        @endif
                                    @endif
                                </td>
                                <td class="border-end">
                                    <h6>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#amortizationModal{{$loan->id}}"  href="#">
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
                            @include('admin-views.admin-loan-applications.modal-adjustments')
                            @include('admin-views.admin-loan-applications.modal-amortization')
                            @include('admin-views.admin-loan-applications.modal-edit-loan')
                            

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