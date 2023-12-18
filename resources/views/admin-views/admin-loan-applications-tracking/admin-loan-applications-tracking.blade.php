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
            <p class="m-0 text-secondary" style="font-size: 12px">Note: The loan applications you see here are those only approved by the co-borrower. This is to avoid unnecessary applications being displayed.</p>
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

        <div class="row mt-3 g-0 mx-3 border">
            <style>
                .scale-1-active{
                    background-color: #e6f3ff !important;
                }
            </style>
            <div class="col-6">
                <a class="btn border rounded-end-0 w-100 h-100 bg-white
                {{$loan_type == 'mpl' ? 'fw-bold shadow-sm scale-1-active' : ''}}
                " href="{{route('admin.loan.applications.tracking', 'mpl')}}">
                <img src="{{asset('assets/MPL-mini.svg')}}" alt="" style="width: 20px;">
                MPL Applications Tracking</a>
            </div>
            <div class="col-6">
                <a
                class="btn border rounded-start-0 w-100 h-100 bg-white
                {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}"
                href="{{route('admin.loan.applications.tracking', 'hsl')}}">
                <img src="{{asset('assets/HSL-mini.svg')}}" alt="" style="width: 20px;">
                HL Applications Tracking
            </a>
            </div>
        </div>


        <div class="d-flex align-items-center px-3 pt-4 ">

            <div class=" membership-app-header1-mpl text-dark d-none d-md-block ">
                <div class="row">
                    <div class="col-2">
                        <img src="{{$loan_type == 'hsl'?  asset('assets/HSL-mini.svg') : asset('assets/MPL-mini.svg')}}" alt="" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h6 style="padding-left: 10px; padding-top: 5px"><span class="fw-bold " style="font-size: 1.2rem; margin-right: 20px;">{{$loan_type == 'hsl'?  'Housing Loan' : 'Multi-purpose Loan'}}</span> <span class="fw-bold fs-7">Tracking Applications</span></h6>
                    </div>
                </div>
                
                
               
                
            </div>
            


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
            <a class="btn btn-outline-primary rounded-5 d-md-flex align-items-center" style="font-size: 12px;" href="{{route('admin.loan.applications.tracking', $loan_type)}}">Clear Filter</a>
        </form>
        </div>



        <div class="table-responsive border m-3 rounded">
            {{-- <div class="custom-table-for-admin"> --}}

                <table class="table admin-table table-striped table-hover" id="myTable">
                    <thead style="border-bottom: 2px solid black">
                        <style>
                            th, td{
                                font-size: 11px !important;
                            }
                        </style>
                        <tr>
                            <th>Loan ID</th>
                            <th>State</th>

                            <th >LOAN CODE</th>
                            <th>Loan Type</th>
                            <th>Principal Borrower</th>
                            <th>Unit</th>
                            <th>Date Requested</th>
                            <th>Amt. Requested</th>
                            <th class="text-secondary"><i class="bi bi-1-circle"></i> Staff</th>
                            <th class="text-secondary"><i class="bi bi-2-circle"></i> Loan Analyst</th>
                            <th class="text-secondary"><i class="bi bi-3-circle"></i> Exe. Director</th>
                            <th class="text-secondary"><i class="bi bi-4-circle"></i> Check</th>
                            <th class="text-secondary"><i class="bi bi-5-circle"></i> Chk. Picked Up</th>
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
                            <td class="text-center">
                                @if ($loan->loan->is_active == 2)
                                    <i data-bs-toggle="tooltip" data-bs-placement="top" title="Closed" style="font-size: 9px;" class="bi bi-circle-fill text-dark"></i>

                                @elseif ($loan->loan->is_active == 1)
                                    <i data-bs-toggle="tooltip" data-bs-placement="top" title="Permforming Loan" style="font-size: 9px;" class="bi bi-circle-fill text-primary"></i>
                                @else
                                    <i data-bs-toggle="tooltip" data-bs-placement="top" title="No state set" style="font-size: 9px;" class="bi bi-circle text-dark"></i>
                                @endif

                            </td>


                            <td class="border-end fw-bold">
                                {{$loan->loan->loan_code}}
                            </td>

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
                                <a href="#" class="fw-bold text-dark text-decoration-none">
                                    {{$loan->loan->member->firstname}}
                                    {{$loan->loan->member->lastname}}
                                </a>
                            </td>

                            <td>{{$loan->loan->member->units->unit_code}}</td>

                            <td>{{ date("M j, Y", strtotime($loan->loan->created_at))}}</td>

                            <td class="fw-bold">
                                <a class="{{$loan->loan->deleted_at ? 'disabled' : ''}}" type="button" data-bs-toggle="modal" data-bs-target="#adjustModal{{$loan->loan->id}}"   style="color: #9f9f9f;" href=""><i class="bi bi-pencil"></i></a>
                                {{number_format($loan->loan->principal_amount, 2, '.',',')}}
                            </td>
                            <td class="text-center border-start" >
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

                            <td class="text-center border-end">

                                @foreach ($loan->loan->LoanApplicationStatus as $status)
                                    @if ($status->loan_application_state_id == 5)
                                        <i class="bi bi-check-circle-fill text-primary"></i>
                                        @break
                                    @endif
                                @endforeach
                            </td>

                            <td class="text-center">
                                @if ($loan->loan->deleted_at)
                                    <span class="final-denied">Cancelled</span>
                                    @if ($loan->loan->reason_for_cancel != null)
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#reasonModal{{$loan->loan->id}}" style="font-size: 11px" href="" class="btn btn-link">See Reason</a>
                                    @endif

                                    @include('admin-views.admin-loan-applications-tracking.modal-reason')
                                @else
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
                                @endif

                            </td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#statusModal{{$loan->loan->id}}" {{$loan->loan->deleted_at ? 'disabled' : ''}}>
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                {{-- <img src="{{asset('storage/'.$loan->loan->payslip)}}" alt=""> --}}
                                <button class="btn grow-on-hover" type="button" data-bs-toggle="dropdown" aria-expanded="false" {{$loan->loan->deleted_at ? 'disabled' : ''}}>
                                    <i class="bi bi-three-dots fs-4 icon"></i>
                                  </button>
                                  <ul class="dropdown-menu">
                                    {{-- SEE INCLUDED MODALS BELOW --}}
                                    <li>
                                        @if ($loan->loan->payslip == null)
                                        <a type="button" href="#" class="dropdown-item disabled">
                                            No Payslip Included  
                                        </a>                
                                        @else 
                                            <a type="button" href="{{route('admin.loan.applications.tracking.payslip', $loan->loan->id)}}" class="dropdown-item" target="_blank">
                                                View Pay Slip
                                            </a>
                                        @endif
                                    </li>
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
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
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
<style>
    .disabled {
    cursor: not-allowed; /* Change cursor to indicate not allowed */
    opacity: 0.6; /* Reduce opacity to indicate disabled state */
    pointer-events: none; /* Ignore pointer events - doesn't receive mouse clicks */
    /* Additional styling to visually indicate the disabled state */

    color: #999; /* Change text color */

}

</style>
@include('admin-components.admin-dataTables')
@endsection
