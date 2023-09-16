@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid mt-2">
    
    <div class="adminbox p-0 pb-3 mb-5">
        
        <div class="row mx-3 mt-3 pb-3 border-bottom g-0">
            <p class="m-0 text-secondary" style="font-size: 12px">Note: The loan applications you see here are those only approved by the co-borrower. This is to avoid uncessesarry applications being displayed.</p>

            @error('loan_application_state_id')
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">Please select a status, it can't be empty.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

            @if (session('status_error'))
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('status_error')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 border border-success" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('success')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('deleted_status'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('deleted_status')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

        </div>
        <div class="d-flex px-3 pt-4">
            
            <div class="d-flex membership-app-header1-mpl text-dark">
                <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 50px;">
                <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold " style="font-size: 1.2rem; margin-right: 10px;">Multi-Purpose Loan</span> <span class="fw-bold fs-7">Applications</span></p>
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
        
        <div class="filter-group px-3 gap-2 mt-4">
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
        <div class="row g-0 mt-2 mx-3">
            <div class="col d-flex justify-content-end gap-3">
                <span class="filter-option active" data-filter="all">All Applications</span>
                <span class="filter-option" data-filter="approved">Approved</span>
                <span class="filter-option" data-filter="denied">Denied</span>
            </div>
        </div>
        
        

        <div class="table-responsive border m-3 rounded">
            {{-- <div class="custom-table-for-admin"> --}}

                <table class="table admin-table table-striped" id="myTable">
                    <thead style="border-bottom: 2px solid black">
                        <style>
                             th{
                                font-size: 12px !important;
                            }
                        </style>
                        <tr>
                            <th>Loan ID</th>
                            <th>Principal Borrower</th>
                            <th>Unit</th>
                            <th>Date of Request</th>
                            <th>Amt. Requested</th>
                            <th class="text-secondary">Staff</th>
                            <th class="text-secondary">Loan Analyst</th>
                            <th class="text-secondary">Exe. Director</th>
                            <th class="text-secondary">Check</th>
                            <th class="text-secondary">Chk. Picked Up</th>
                            <th>Final</th>
                            <th>Edit Status</th>
                            <th>More..</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                            
                        
                        <tr class="table-row" data-status="approved">
                            <td>{{$loan->loan->id}}</td>

                            <td>
                                <a href="#" class="fw-bold text-dark text-decoration-none">
                                    {{$loan->loan->member->firstname}}
                                    {{$loan->loan->member->lastname}}
                                </a>
                            </td>

                            <td>{{$loan->loan->member->units->unit_code}}</td>

                            <td>{{ date("F j, Y, g:i A", strtotime($loan->loan->created_at))}}</td>

                            <td>
                                {{number_format($loan->loan->principal_amount, 2, '.',',')}}    
                            </td>
                            <td class="text-center">
                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                    @if ($status->loan_application_state_id == 1)
                                        <i class="bi bi-check-circle-fill text-primary"></i>
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                @if ($status->loan_application_state_id == 2)
                                <i class="bi bi-check-circle-fill text-primary"></i>
                                    @break
                                @endif
                            @endforeach
                            
                            </td>
                            <td class="text-center">
                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                @if ($status->loan_application_state_id == 3)
                                    <i class="bi bi-check-circle-fill text-primary"></i>
                                    @break
                                @endif
                            @endforeach
                            </td>
                            <td class="text-center">
                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                    @if ($status->loan_application_state_id == 4)
                                        <i class="bi bi-check-circle-fill text-primary"></i>
                                        @break
                                    @endif
                                @endforeach
                            </td>

                            <td class="text-center">
                                
                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                    @if ($status->loan_application_state_id == 5)
                                        <i class="bi bi-check-circle-fill text-primary"></i>
                                        @break
                                    @endif
                                @endforeach
                            </td>

                            <td class="text-center">
                                @php
                                $array = [];
                                foreach ($loan->loan->LoanApplicationStatus as $status) {
                                    array_push($array, $status->loan_application_state_id);
                                }
                                @endphp  
                                @if(count($array)==0)
                                    <p class="text-secondary">Pending</p>
                                @elseif (in_array(6,$array))
                                    <span class="final-denied">Denied</span>
                                @elseif(in_array(5,$array))
                                    <p class="fw-bold text-primary">Picked up</p>  
                                @elseif(in_array(3,$array))
                                    <span class="final-approved">Approved</span>
                                @else
                                    <p class="">Being Processed</p>
                                @endif
                                {{-- @foreach ($loan->loan->LoanApplicationStatus as $status)
                                    @if ($status->loan_application_state_id == 5)
                                        <p class="fw-bold text-primary">Picked up</p>                            
                                    @elseif($status->loan_application_state_id == 3)
                                        <span class="final-approved">Approved</span>
                                    @elseif($status->loan_application_state_id == 6)
                                        <span class="final-denied">Denied</span>     
                                    @endif
                                @endforeach --}}

                                {{-- @if ($loan->loan->is_approved == 0)
                                    <p class="text-secondary">Pending</p>
                                @elseif($loan->loan->is_approved == '1')
                                    <span class="final-approved">Approved</span>
                                @elseif($loan->loan->is_approved == '2')
                                    <span class="final-denied">Denied</span>
                                @endif --}}
                            </td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn p-2" data-bs-toggle="modal" data-bs-target="#statusModal{{$loan->loan->id}}">
                                    <h5 class="m-0"><i style="color: #1d85d0" class="bi bi-pencil-square"></i></h5>
                                </button>
                                @include('admin-views.admin-loan-applications.modal-add-status')

                                {{-- <button type="button" class="btn btn-add-status" data-bs-toggle="modal" data-bs-target="#statusModal{{$loan->loan->id}}">
                                    Add Status
                                </button>
                                @include('admin-views.admin-loan-applications.modal-add-status') --}}
                            </td>
                            <td class="text-center">
                                
                                <button class="btn grow-on-hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots fs-4 icon"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <button class="approve-btn w-100 grow-on-hover">Approve</button>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <button class="deny-btn w-100 grow-on-hover">Deny</button>
                                        </a>
                                    </li>
                                  </ul>
                            </td>
                            {{-- <td class="text-center">
                                <div class="three-dots">
                                    <i class="bi bi-three-dots fs-4 icon"></i>
                                    <div class="three-dots-buttons">
                                        <button class="approve-btn">Approve</button>
                                        <button class="deny-btn">Deny</button>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>

                        @endforeach
                   
                    </tbody>
                </table>
            {{-- </div> --}}
            
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