@extends('admin-components.admin-layout')

@section('content')
@php
    if(!isset($year_selected)){
        $year_selected = 0;
    }
    if(!isset($month_selected)){
        $month_selected = 0;
    }
    if(!isset($unit_selected)){
        $unit_selected = 0;
    }
@endphp
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
            @error('principal_amount')
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">{{$message}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

            @if (session('state_update'))
            <div class="alert alert-primary alert-dismissible fade show mt-3 border border-primary" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('state_update')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('status_error'))
            <div class="alert alert-warning alert-dismissible fade show mt-3 border border-warning" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('status_error')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('status_danger'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0">{{session('status_danger')}}</p>
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
                <p style="font-size: 12px" class="m-0"><i class="bi bi-exclamation-lg"></i> {{session('deleted_status')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('deleted_status_passed'))
            <div class="alert alert-danger alert-dismissible fade show mt-3 border border-danger" role="alert">
                <p style="font-size: 12px" class="m-0"> <i class="bi bi-check-lg"></i> {{session('deleted_status_passed')}}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

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
                " href="{{route('admin.loan.applications.tracking', 'mpl')}}">
                <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 20px;">
                MPL Applications Tracking</a>
            </div>
            <div class="col-6">
                <a 
                class="btn border rounded-start-0 w-100 h-100 bg-white
                {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}" 
                href="{{route('admin.loan.applications.tracking', 'hsl')}}">
                <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 20px;">
                HSL Applications Tracking
            </a>
            </div>
        </div>


        <div class="d-flex px-3 pt-4">
            
            @if ($loan_type == 'hsl')
                <div class="d-flex membership-app-header1-mpl text-dark">
                    <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 50px;">
                    <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold " style="font-size: 1.2rem; margin-right: 20px;">Housing Loan</span> <span class="fw-bold fs-7">Tracking Applications</span></p>
                </div>
            
            @elseif ($loan_type == 'mpl')
                <div class="d-flex membership-app-header1-mpl text-dark">
                    <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 50px;">
                    <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold " style="font-size: 1.2rem; margin-right: 10px;">Multi-Purpose Loan</span> <span class="fw-bold fs-7">Tracking Applications</span></p>
                </div>
            @endif
            

            <div class="membership-app-header2">
                <div class="lh-1" style="padding: 15px 0 0 15px;">
                    <p class="fw-bold">{{$pending}} Pending</p>
                    <div class="d-flex">
                        <div class="row">
                            <div class="col-sm-6">
                                <p style="margin-right: 20px; font-size: 0.7rem; width: 100%;" class="text-success">{{$approved}} Approved</p>
                            </div>
                            <div class="col-sm-6">
                                <p style="margin-right: 20px; font-size: 0.7rem; width: 100%;" class="text-secondary">{{count($loans)-$pending-$approved-$denied}} Processing</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-danger" style="font-size: 0.7rem; width: 100%">{{$denied}} Denied</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{route('admin.loan.applications.tracking', 'mpl')}} --}}
        <form action="{{route('admin.loan.applications.tracking.filter', $loan_type)}}">
        <div class="filter-group px-3 gap-2 mt-4">
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select name="year_filter" class="form-control bg-white border-0 fw-semibold">
                    <option value="0" {{$year_selected == 0 ? 'selected' : ''}}> All Year</option>
                    @foreach ($years as $year)
                        <option value="{{$year}}" {{$year_selected == $year ? 'selected' : ''}}>{{$year}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select name="month_filter" id="monthSelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="0" {{$month_selected == 0 ? 'selected' : ''}}>All Month</option>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($months as $month)
                        <option value="{{$i+=1}}" {{$month_selected == $i ? 'selected' : ''}}>{{$month}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select name="unit_filter" id="typeSelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="0">All Units</option>
                    @foreach ($units as $unit)
                        <option value="{{$unit->id}}" {{$unit_selected == $unit->id ? 'selected' : ''}}>{{$unit->unit_code}}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- <div class="form-group fg-admin" style="width: 175px; position: relative;">
                <select id="typeSelect" class="form-control bg-white border-0 fw-semibold">
                    <option value="">All Applications</option>
                    <option value="">Approved</option>
                    <option value="">Denied</option>
                </select>
            </div> --}}

            <button type="submit"  class="btn btn-outline-dark fw-bold rounded-5 px-4" style="font-size: 12px">Apply Filter</button>
            <a class="btn btn-outline-primary rounded-5 d-flex align-items-center" style="font-size: 12px" href="{{route('admin.loan.applications.tracking', $loan_type)}}">Clear Filter</a>
        </form>
        </div>

        
    
        <div class="table-responsive border m-3 rounded">
            {{-- <div class="custom-table-for-admin"> --}}

                <table class="table admin-table table-striped table-hover" id="myTable">
                    <thead style="border-bottom: 2px solid black">
                        <style>
                            th, td{
                                font-size: 12px !important;
                            }
                        </style>
                        <tr>
                            <th>Loan ID</th>
                            <th>Loan Type</th>
                            <th>State</th>
                            <th>Principal Borrower</th>
                            <th>Unit</th>
                            <th>Date Requested</th>
                            <th>Amt. Requested</th>
                            <th class="text-secondary">Staff</th>
                            <th class="text-secondary">Loan Analyst</th>
                            <th class="text-secondary">Exe. Director</th>
                            <th class="text-secondary">Check</th>
                            <th class="text-secondary">Chk. Picked Up</th>
                            <th>Final</th>
                            <th>Edit Standing</th>
                            <th>More..</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($loans as $loan)
                          <tr class="table-row" data-status="approved">
                            <td class="fw-bold">{{$loan->loan->id}}</td>
                            @php $color = '' @endphp
                            @if ($loan->loan->loanCategory)
                                    @if ($loan->loan->loanCategory->loan_category_name == 'New')
                                        @php $color = '#ffff60;'@endphp
                                    @elseif ($loan->loan->loanCategory->loan_category_name == 'Renewal')
                                        @php $color = '#26de8c;' @endphp
                                    @elseif ($loan->loan->loanCategory->loan_category_name == 'Additional')
                                        @php $color = '#ce6bbf;'@endphp
                                    @endif 
                                @endif
                            
                            <td style="background-color: {{$color}} font-size: 10px;" class="fw-bold">
                                @if ($loan->loan->loanCategory)
                                    @if ($loan->loan->loanCategory->loan_category_name == 'New')
                                        {{$loan->loan->loanCategory->loan_category_name}}
                                    @elseif ($loan->loan->loanCategory->loan_category_name == 'Renewal')
                                        {{$loan->loan->loanCategory->loan_category_name}}
                                    @elseif ($loan->loan->loanCategory->loan_category_name == 'Additional')
                                        {{$loan->loan->loanCategory->loan_category_name}}
                                    @endif 
                                @endif
                            
                            </td>
                            <td>
                                
                                @if ($loan->loan->is_active == 1)
                                    <span class="text-primary">Performing</span>
                                @elseif($loan->loan->is_active == 2)
                                    <span class="text-dark">Closed</span>
                                @elseif($loan->loan->is_active == null)
                                    <i>n/a</i>
                                @endif    
                            </td>
                           

                            <td>
                                <a href="#" class="fw-bold text-dark text-decoration-none">
                                    {{$loan->loan->member->firstname}}
                                    {{$loan->loan->member->lastname}}
                                </a>
                            </td>

                            <td>{{$loan->loan->member->units->unit_code}}</td>

                            <td>{{ date("F j, Y, g:i A", strtotime($loan->loan->created_at))}}</td>

                            <td class="fw-bold">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#adjustModal{{$loan->loan->id}}"  style="color: #9f9f9f;" href=""><i class="bi bi-pencil"></i></a>
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
                     
                            </td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn p-2" data-bs-toggle="modal" data-bs-target="#statusModal{{$loan->loan->id}}">
                                    <h5 class="m-0"><i style="color: #1d85d0" class="bi bi-pencil-square"></i></h5>
                                </button>
                            </td>
                            <td class="text-center">
                                
                                <button class="btn grow-on-hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots fs-4 icon"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    {{-- SEE INCLUDED MODALS BELOW --}}
                                    <li>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#stateModal{{$loan->loan->id}}" class="dropdown-item">
                                            Edit State
                                            <p class="" style="font-size: x-small">Make Loan performing or closed.</p>
                                        </a>
                                        
                                    </li>
                                    <li>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#categoryModal{{$loan->loan->id}}" class="dropdown-item">
                                            Edit Loan Type
                                            <p style="font-size: x-small">Add, New or Renew.</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#adjustModal{{$loan->loan->id}}" class="dropdown-item" href="#">
                                            Adjust
                                            <p style="font-size: x-small">Change amount requested</p>
                                        </a>
                                    </li>
                                  </ul>
                            </td>
                        </tr>
                        
                        @include('admin-views.admin-loan-applications-tracking.modal-loan-category')
                        @include('admin-views.admin-loan-applications-tracking.modal-add-status')
                        @include('admin-views.admin-loan-applications-tracking.modal-change-state')
                        @include('admin-views.admin-loan-applications-tracking.modal-adjust')
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