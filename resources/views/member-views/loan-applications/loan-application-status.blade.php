@extends('member-components.member-layout')

@section('content')

<main >      
    <div class="container-fluid">
        <div class="row">
            <div class="col mt-3 mb-5">
                <div class="d-flex flex-column align-items-center justify-content-center ">
                    <div class="app-status-box bg-white pt-5 border rounded">
                        <p class="fs-5 fw-bold mb-4 text-center">Loan Application Status</p>
                        <div class="lh-1">
                            <p><span class="fs-6 fw-bold">{{$loan->loanType->loan_type_description}}</span> <span class="fs-7">{{$loan->created_at}}</span></p>
                            <div class="row g-0">
                                <div class="col-6 ">
                                    <div class="lh-sm">
                                        <p class="fs-7">Request <br> <span class="fs-6">Php</span> <span class="fs-6 fw-bold">{{$loan->principal_amount}}</span></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="lh-sm">
                                        <p class="fs-7">Years to pay <br><span class="fs-6">{{$loan->term_years}} year{{$loan->term_years > 1? 's': ''}}</span></p>
                                    </div>
                                </div>
                            </div>
                            {{-- {{dd($loan_status)}} --}}
                        @if (count($loan_status) != 0)
                                
                            {{-- =================================================================== --}}
                            @foreach ($loan_status as $status)
                                @if ($status->loan_application_state_id == 6)
                                <div class="status-box-dennied mb-3 ">
                                    <div style="padding-left: 40px;">
                                        <p class="mb-1 fs-7 text-white pt-3">{{
                                            $status->created_at
                                            }}</p>
                                        <p class="fw-bold text-white fs-7 pb-3">Your Loan Application was Declined </p>
                                    </div>
                                </div>
                                @endif    
                            @endforeach
                            
                            @foreach ($loan_status as $status)
                                @if ($status->loan_application_state_id == 6)
                                    
                                @else
                                <div class="status-box border shadow-sm mb-3">
                                    <div class="row p-3">
                                        <div class="col-lg-2 col-3 d-flex justify-content-center align-items-center">
                                            <img class="img-fluid" src="{{asset($status->loanApplicationState->asset_path)}}" alt="check logo" style="max-width: 50px; min-width: 40px">
                                        </div>
                                        <div class="col-lg-10 col-9">
                                            <p class="mb-2 fs-7 text-secondary " style="font-size: 12px">Date Evaluated: {{$status->date_evaluated}}</p>
                                            <p class="mb-2 fw-bold" style="font-size: 14px;">{{$status->loanApplicationState->state_name}}</p>
                                            <p class="fs-7" style="font-size: 12px;">{{$status->loanApplicationState->state_description}}</p>
                                            @if ($status->remarks != null)
                                                <div class="fs-7 border-top">
                                                    <p class="mt-2 fw-bold">Remarks</p>
                                                    {{$status->remarks}}
                                                </div>    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @else
                        <div class="row border text-center p-5 rounded shadow-sm">
                            <h1 class="text-center"><i class="bi bi-patch-question"></i></h1>
                            <p class="fw-bold">No status yet</p>
                            <p style="font-size: 12px">Submit your loan applictions at eBUPF to move forward your loan in the the application process.</p>
                        </div>
                        @endif
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

@endsection
