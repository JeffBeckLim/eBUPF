@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container-fluid">
            <div class="adminbox">
                <div class="row mt-3 g-0 mx-3">
                    <style>
                        .scale-1-active{
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white
                        {{$loan_type == 'mpl' ? 'fw-bold shadow-sm scale-1-active' : ''}}
                        " href="/admin/ledgers/member/mpl/{{$member->id}}">
                        <img src="{{asset('assets/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        MPL Personal Ledgers</a>
                    </div>
                    <div class="col-6">
                        <a
                        class="btn border rounded-start-0 w-100 h-100 bg-white
                        {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}"
                        href="/admin/ledgers/member/hsl/{{$member->id}}">
                        <img src="{{asset('assets/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        HL Personal Ledgers
                    </a>
                    </div>
                </div>

                <div class=" d-flex text-dark mt-3">
                        {{-- <div >
                            <img src="{{asset('assets/book.svg')}}" alt="" width="50px" height="58px">
                        </div> --}}
                        <div class="g-0 ps-2 my-auto">
                            <div class="m-0 fw-bold fs-5" > <a class="text-dark text-decoration-none" href="{{route('admin.ledgers')}}">Ledgers</a> <i class="bi bi-chevron-compact-right"></i>{{$member->firstname}} {{$member->lastname}} <span style="font-size: x-small">{{$member->units->unit_code}} | {{$member->units->campuses->campus_code}}</span></div>
                            <div style="font-size: small">Individual Member's Ledgers</div>
                        </div>
                </div>
                <div class="border mt-2">
                </div>

                <div class="table-responsive ">
                    <div class="custom-table-for-admin">

                        <table class="table admin-table table-striped border-top" id="myTable">

                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th  style="width: 5%">State</th>
                                    <th>Loan ID</th>
                                    <th >LOAN CODE</th>

                                    <th>Details</th>
                                    <th class="text-center">. . .</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td style="width: 5%" class="text-center">
                                            @if ($loan->is_active == 2)
                                        <i data-bs-toggle="tooltip" data-bs-placement="top" title="Closed" style="font-size: 9px;" class="bi bi-circle-fill text-dark"></i>

                                        @elseif ($loan->is_active == 1)
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Permforming Loan" style="font-size: 9px;" class="bi bi-circle-fill text-primary"></i>
                                        @else
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="No state set" style="font-size: 9px;" class="bi bi-circle text-dark"></i>
                                        @endif
                                        </td>
                                        <td>
                                            {{$loan->id}}
                                        </td>
                                        <td>
                                            {{$loan->loan_code}}
                                        </td>

                                        <td>
                                            <h6 class="fw-bold" style="font-size: 14px">
                                                @if ($loan->loanCategory)
                                                    {{$loan->loanCategory->loan_category_name}} <i class="bi bi-caret-right-fill"></i>
                                                @endif
                                                {{$loan->loanType->loan_type_name}} - {{$loan->id}}
                                                <i class="bi bi-caret-right-fill"></i>
                                                Php {{$loan->principal_amount + $loan->interest}}
                                            </h6>
                                            <h6 style="font-size: 12px">
                                                <a class="text-secondary text-decoration-none" data-bs-toggle="tooltip" data-bs-title="Principal Amount" >
                                                    <i class="bi bi-cash-stack"></i>
                                                 Php {{$loan->principal_amount}} <i class="bi bi-dot px-3"></i>
                                                 </a>

                                                 <a class="text-secondary text-decoration-none" data-bs-toggle="tooltip" data-bs-title="Interest" >
                                                    <i class="bi bi-graph-up-arrow"></i>
                                                 Php {{$loan->interest}} <i class="bi bi-dot px-3"></i>
                                                </a>
                                                <a class="text-secondary text-decoration-none fw-bold" data-bs-toggle="tooltip" data-bs-title="Amort. Period" >

                                                    <i class="bi bi-calendar4-event"></i>
                                                    {{-- of amortization period exist --}}
                                                    @if ($loan->amortization->amort_start != null &&
                                                    $loan->amortization->amort_end != null
                                                    )
                                                    {{Carbon\Carbon::parse($loan->amortization->amort_start)->format('M Y')}} -
                                                    {{Carbon\Carbon::parse($loan->amortization->amort_end)->format('M Y')}}

                                                     @else {{--  else display NaN --}}
                                                        NaN
                                                    @endif
                                                </a>
                                                @if ($loan->penalty != null)
                                                <a href="#penalty-div" class="mx-2"  data-bs-toggle="tooltip" data-bs-title="This loan has been penalized" >
                                                    <img style="height: 30px ;" src="{{asset('assets/penalty.svg')}}" alt="">
                                                </a>
                                                @endif
                                                @php
                                                $disable_incomplete = 0;
                                            @endphp
                                                {{-- if has missing amortization details --}}
                                                @if ($loan->amortization->amort_start == null ||
                                                        $loan->amortization->amort_end == null ||
                                                        $loan->amortization->amort_principal == null ||
                                                        $loan->amortization->amort_interest == null
                                                    )
                                                    @php
                                                        // this is for disabling the view button
                                                        $disable_incomplete = 1;
                                                    @endphp

                                                    <a style="font-size: 21px" href="#penalty-div" class="mx-2"  data-bs-toggle="tooltip" data-bs-title="Incomplete amortization details" >
                                                        <i style="color: #b82744" class="bi bi-exclamation-triangle"></i>
                                                    </a>
                                                @endif

                                            </h6>
                                        </td>
                                        <td class="text-end">
                                            @if ($disable_incomplete == 1)
                                                Cannot View: Incomplete amortization details
                                            @else
                                            <a href="{{route('admin.personal.ledger', $loan->id)}}" style="font-size: small" class="btn bu-orange text-light fw-bold  me-4 my-1"><i class="bi bi-eye-fill"></i> View</a>
                                            @endif

                                        </td>
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
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@include('admin-components.admin-dataTables')
@endsection
