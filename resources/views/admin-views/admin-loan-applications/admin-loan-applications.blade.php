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
    <div class="adminbox m-4">

        {{-- ERROR MESSAGES --}}
        @include('admin-views.admin-loan-applications.error-displays')
        {{-- ERROR MESSAGES --}}

        <div class="d-flex">
            @if ($loanType == 1)
            <div class="d-flex membership-app-header1-mpl">
                <img src="{{asset('/icons/MPL-mini.svg')}}" alt="" width="50px">
                <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Multi-Purpose Loan</span> <span class="fw-bold fs-7">Applications</span></p>
            </div>
            @elseif ($loanType == 2)
            <div class="d-flex membership-app-header1-mpl">
                <img src="{{asset('/icons/HSL-mini.svg')}}" alt="" width="50px">
                <p style="padding-left: 10px; padding-top: 5px"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Housing Loan</span> <span class="fw-bold fs-7">Applications</span></p>
            </div>
            @endif


            <div class="membership-app-header2">
                <div class="lh-1" style="padding: 15px 0 0 15px;">
                    <p class="fw-bold">{{$null_interest}} w/o Interest</p>
                    <p style="font-size: 12px" class="text-danger">{{$incomplete_amort}} Incomplete Amort. info</p>
                    <div class="d-flex">
                        <div class="row  g-0 w-100">
                            <div class="col-sm-6 ">
                                <p style="margin-right: 20px; font-size: 0.7rem; width: 100%;">{{$no_loanType}} w/o Loan Type</p>
                            </div>
                            {{-- <div class="col-sm-6">
                                <p class="text-danger" style="font-size: 0.7rem; width: 100%">1 Denied</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>        

        
        <form action="{{route('admin.loan.applications.filter' , ['loanType' => $loanType, 'freeze' => $table_freeze])}}">
            <p class="ms-2 pt-2 text-secondary" style="font-size: 12px">Filter by date requested and Unit</p>
        <div class="filter-group gap-2 mt-4">
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="year-filter" class="form-control bg-white border-0 fw-semibold" name="year_filter">
                    <option value="0" {{$year_selected == 0 ? 'selected' : ''}}>All Year</option>
                    @foreach ($years as $year)
                    <option value="{{$year}}" {{$year_selected == $year ? 'selected' : ''}}>{{$year}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="month-filter" class="form-control bg-white border-0 fw-semibold" name="month_filter">
                    <option value="0" {{$month_selected == 0 ? 'selected' : ''}}>All Months</option>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($months as $month)
                        <option  value="{{$i+=1}}" {{$month_selected == $i ? 'selected' : ''}}>{{$month}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group fg-admin" style="width: 150px; position: relative;">
                <select id="unit-filter" class="form-control bg-white border-0 fw-semibold" name="unit_filter">
                    <option value="0" {{$unit_selected == 0 ? 'selected' : ''}}>All Units</option>
                    @foreach ($units as $unit)
                    <option value="{{$unit->id}}" {{$unit_selected == $unit->id ? 'selected' : ''}}>{{$unit->unit_code}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"  class="btn btn-outline-dark fw-bold rounded-5 px-4" style="font-size: 12px">Apply Filter</button>
            <a class="btn btn-outline-primary rounded-5 d-flex align-items-center" style="font-size: 12px" href="{{route('admin.loan.applications' , ['loanType' => $loanType, 'freeze' => $table_freeze])}}">Clear Filter</a>
            
        </div>
        </form>
        <style>
            th, td{
                font-size: 12px !important;
            }
        </style>

        <a class="btn mt-2" style="font-size: 12px; color:#36276b"
        @if ($table_freeze == 'table')
             href="{{route('admin.loan.applications', ['loanType' => $loanType, 'freeze' => 'table-freeze'])}}">Freeze table <i class="bi bi-unlock"></i>
        @else
             href="{{route('admin.loan.applications', ['loanType' => $loanType, 'freeze' => 'table'])}}">Freeze table <i class="bi bi-lock-fill"></i>
        @endif
        </a>


        <div class="table-responsive border rounded">
                <table class="table admin-table table-striped border" id="{{$table_freeze == 'table-freeze' ? 'loanApplicationTable' : 'myTable'}}">
                    <thead style="border-bottom: 2px solid black">
                        <tr class="border">
                            <th class="sticky-header">Loan ID</th>
                            <th class="sticky-header">Loan Type</th>
                            <th class="sticky-header">Name</th>
                            <th class="sticky-header">Unit</th>
                            <th class="sticky-header border-end">Date Requested</th>

                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Total Payable</th>
                            <th>Term</th>
                            <th class="border-end">...</th>

                            <th class="border-end">Gross Loan</th>

                            {{-- for Housing --}}
                            @if ($loanType == 2)
                                <th class="text-primary">Service Fee</th>    
                            @endif
                        
                            <th>Interest <h6 style="font-size: small">1st YR</h6></th>
                            <th>MRI</th>
                            <th>Prev. Loan Balance/Refund</th>
                            <th>
                                <p class="text-secondary" style="font-size: 10px">Adjustments</p>
                                Interest Rebate/Refund
                            </th>
                            <th>Penalty</th>
                            <th>Net Proceeds</th>
                            <th class="border-end ">...</th>


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
                            <th>Check CO.</th>
                            <th>Date</th>
                            <th>Remarks</th>

                            <th>...</th>

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
                                <td class="fw-bold">
                                    {{ strtoupper($loan->member->lastname)}},
                                    {{$loan->member->firstname}}
                                </td>

                                {{-- units --}}
                                <td>
                                    {{$loan->member->units->unit_code}}
                                </td>

                                {{-- date of request --}}
                                <td class="border-end ">
                                    {{date("F j, Y", strtotime($loan->created_at))}}
                                </td>

                                {{-- principla amount --}}
                                <td>
                                    {{number_format($loan->principal_amount, 2, '.',',')}}
                                </td>

                                {{-- interest --}}
                                <td>
                                    {{number_format($loan->interest, 2, '.',',')}}

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
                                        <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#editLoanModal{{$loan->id}}"  href="#">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </h6>
                                </td>

                                {{-- gross loan -- principal amount lang to --}}
                                <td class="border-end">
                                    {{number_format($loan->principal_amount, 2, '.',',')}}
                                </td>


                                @if ($loanType == 2)
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->housing_service_fee != null)
                                        {{number_format($loan->adjustment->housing_service_fee, 2, '.',',')}}
                                    @endif
                                </td>    
                                 @endif


                                {{-- interest 1st year --}}
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->interest_first_yr != null)
                                        {{number_format($loan->adjustment->interest_first_yr, 2, '.',',')}}
                                    @endif
                                </td>
                                {{-- MRI --}}
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->mri != null)
                                        {{number_format($loan->adjustment->mri, 2, '.',',')}}
                                    @endif
                                </td>
                                {{-- Previous Loan Balance --}}
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->previous_loan_balance != null)
                                        {{number_format($loan->adjustment->previous_loan_balance, 2, '.',',')}}
                                    @endif
                                </td>
                                {{-- Interest Rebate/Refund --}}
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->interest_rebate != null)
                                        {{number_format($loan->adjustment->interest_rebate, 2, '.',',')}}
                                    @endif
                                </td>
                                {{-- Penalty --}}
                                <td>
                                    @if ($loan->adjustment != null && $loan->adjustment->previous_penalty != null)
                                        {{number_format($loan->adjustment->previous_penalty, 2, '.',',')}}    
                                    @endif
                                </td>
                                {{-- Net Proceeds --}}
                                <td>
                                    @if ($loan->adjustment != null)
                                    {{
                                        number_format(
                                            $loan->principal_amount -$loan->adjustment->interest_first_yr-$loan->adjustment->housing_service_fee-$loan->adjustment->mri - $loan->adjustment->previous_loan_balance + $loan->adjustment->interest_rebate -$loan->adjustment->previous_penalty 
                                        , 2, '.',',')
                                    }}  
                                    @endif
                                    
                                </td>
                                {{-- ... --}}
                                <td>
                                    <h6>
                                        <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#adjustmentsModal{{$loan->id}}"  href="#">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </h6>
                                </td>

                                {{-- AMORTIZATION --------------- --}}
                                {{-- prin --}}
                                <td class=" border-start">
                                    @if ($loan->amortization != null)
                                        {{number_format($loan->amortization->amort_principal, 2, '.',',')}}
                                    @endif
                                </td>
                                {{-- int --}}
                                <td>
                                    @if ($loan->amortization != null)
                                        {{number_format($loan->amortization->amort_interest, 2, '.',',')}}

                                    @endif
                                </td>
                                {{-- monthly --}}
                                <td>
                                    @if ($loan->amortization != null)
                                    {{number_format($loan->amortization->amort_principal + $loan->amortization->amort_interest, 2, '.',',')}}
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
                                    @if ($loan->interest == null)
                                        <a  class="text-danger text-decoration-none btn" data-bs-toggle="tooltip" data-bs-title="INTEREST column is empty" disabled>
                                            <i class="bi bi-exclamation-circle"></i>
                                        </a>
                                    @else
                                        @if ($loan->amortization_id == null)
                                            <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#addAmortizationModal{{$loan->id}}"  href="#">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        @elseif($loan->amortization)
                                            @if ($loan->amortization->amort_start == null &&
                                                $loan->amortization->amort_start == null)
                                                <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#addAmortizationModal{{$loan->id}}"  href="#">
                                                    <i class="bi bi-plus-circle"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#amortizationModal{{$loan->id}}"  href="#">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                    </h6>

                                </td>
                                {{-- check --}}
                                <td>
                                    @if (count($loan->check) != 0)
                                        {{$loan->check[0]->adjusted_net_pay}}
                                    @endif
                                </td>
                                <td>
                                    @if (count($loan->check) != 0)
                                        {{$loan->check[0]->check_co}}
                                    @endif
                                </td>
                                <td>
                                    @if (count($loan->check) != 0)
                                        {{$loan->check[0]->date}}
                                @endif
                                </td>
                                <td>
                                    @if (count($loan->check) != 0)
                                        {{$loan->check[0]->remarks}}
                                    @endif
                                </td>
                                <td>
                                    <h6>
                                        <a class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#checkModal{{$loan->id}}"  href="#">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </h6>
                                </td>
                            </tr>
                            @include('admin-views.admin-loan-applications.modal-check')
                            @include('admin-views.admin-loan-applications.modal-adjustments')
                            @include('admin-views.admin-loan-applications.modal-amortization')
                            @include('admin-views.admin-loan-applications.modal-addAmortization')
                            @include('admin-views.admin-loan-applications.modal-edit-loan')


                        @endforeach

                    </tbody>
                    @endif
                </table>
        </div>
    </div>
</div>

<script>

    // for Tool Tips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    

</script>

@include('admin-components.admin-dataTables')
@endsection
