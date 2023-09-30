@extends('member-components.member-layout')

@section('content')

<main >
    <div class="container-fluid">
            <div class="row  d-flex justify-content-center p-2">
                <div class="col-lg-7 bg-white rounded border  mt-2 pb-5">
                    <div class="mx-lg-3 m-1 my-4">
                        <p class=" fs-5 fw-bold">Loan <br> Applications</p>
                    </div>

                    <div class="border rounded mx-3 mb-3 p-2">
                        <p class="m-0 text-secondary" style="font-size: small">
                            <i class="bi bi-lightbulb-fill"></i>
                            Below, you'll find a list of loan applications that have been accepted by co-borrowers.
                        </p>
                    </div>

                    {{-- <div class="d-flex align-items-center  mx-lg-3 m-1">
                        <label>Search</label>
                        <input type="text" class="ms-2 search-box" placeholder="Enter your search query">
                    </div> --}}
                        
                    <div class="mx-3 mt-2">
                        <a class="px-3 btn fw-bold text-secondary {{Route::is('loan.applications')? 'bu-orange text-light rounded-5': ''}}" href="{{Route('loan.applications')}}">New</a>
                        <a class="px-3 btn fw-bold text-secondary {{Route::is('loan.applications.evaluated')? 'bu-orange text-light rounded-5': ''}}" href="{{Route('loan.applications.evaluated')}}">Evaluated</a>
                        <a class="px-3 btn fw-bold text-secondary {{Route::is('loan.applications.all')? 'bu-orange text-light rounded-5': ''}}" href="{{Route('loan.applications.all')}}">All</a>
                    </div>
                    
                    <div class="d-flex flex-column align-items-center justify-content-center mt-4 mx-lg-3 m-1">
                        
                        @if ($loans)

                        @foreach ($loans as $loan)
                            @php
                                $status_array=[];
                                foreach ($loan->loan->loanApplicationStatus as $status) {
                                    array_push($status_array, $status->loan_application_state_id);
                                }

                            @endphp
                            @if(in_array(4,$status_array) && !in_array(5,$status_array) && !in_array(6,$status_array))
                                <div class="border w-100 rounded mb-2 p-2 row">
                                    <i class="bi bi-circle-fill my-3" style="color: #b700ff"></i>
                                    <div class="col-12 " style="font-size: 12px">
                                        Since your check is now ready for claiming, you can proceed to print the insurance form. This form is one of the necessary documents you'll need when claiming your check
                                    </div>
                                    <div class="col-12 pt-3 text-end p-0">
                                        <a href="#" class="btn text-light fw-bold grow-on-hover" style="background-color: #b700ff; font-size: 14px">Print Insurance Form</a>
                                    </div>
                                </div>
                            @endif
                            {{-- CARD --}}
                            <div class="w-100 border bg-white rounded px-3 pt-2 pb-4 mb-2 shadow-sm">
                                <div class="row  mt-2 g-0 ">
                                    <div class="col-4 border rounded ps-3 pt-2">

                                        @if ($loan->loan->is_active == 1)
                                            <span style="font-size: small;" class="fw-bold text-primary">Performing</span>
                                        @elseif($loan->loan->is_active == 2)
                                            <span style="font-size: small;" class="fw-bold">Non-performing</span>
                                        @endif
                                     
                                        @if ($loan->loan->is_active == null)
                                            
                                            @if(in_array(6,$status_array))
                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1"  style="color: red"></i><span class="text-danger">Denied</span></p>
                                            @elseif(in_array(5,$status_array))
                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: #0092D1"></i><span class="text-primary">Check Picked Up</span></p>
                                            @elseif(in_array(4,$status_array))
                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: #b700ff"></i><span style="color: #77028f">Check Ready</span></p>
                                            @elseif(in_array(3,$status_array))
                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: green"></i><span class="text-success">Approved</span></p>
                                            @elseif(count($status_array) == 0)
                                                <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: rgb(0, 0, 0)"></i><span class="text-success">Not yet submitted</span></p>
                                            @else
                                                <p class="text16-design m-0 text-secondary"><i class="bi bi-circle-fill me-1"></i><span class="text-secondary">Being Processed</span></p>
                                            @endif
                                            
                                        @endif

                                        <p class="fw-bold text m-0" style="font-size: small">{{$loan->loan->loanType->loan_type_description}}</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p class="text16-design">{{ date("F j, Y, g:i A", strtotime($loan->loan->created_at))}}</p>
                                    </div>


                                    <div class="col-4">
                                        <p class=" text15-design m-0">Request</p>
                                        <p class="text17-design ">
                                            <span class="fw-light fw-bold">
                                                Php{{number_format($loan->loan->principal_amount, 2, '.',',')}}
                                            </span>
                                        </p>
                                    </div>


                                    <div class="col-2">
                                        <p class="text15-design m-0"> Year{{$loan->loan->term_years > 1 ? 's': ''}} to Pay</p>
                                        <p class="text17-design">{{$loan->loan->term_years}} Year{{$loan->loan->term_years > 1 ? 's': ''}}</p>
                                    </div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-6">
                                        <p class="m-0 ps-2 mt-2" style="font-size:small">Co-Borrower</p>
                                        <div class="row g-0">
                                            <div class="col  mt-1 d-flex">
                                                <img class="rounded-circle mx-2" src="
                                                {{$loan->member->profile_picture != null ? asset('storage/'.$loan->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="Default Picture" style="height: 2.5rem; width: 2.5rem; object-fit: cover;">
                                                <span class="fw-bold fs-7 my-auto">
                                                    {{$loan->member->firstname}}
                                                    {{$loan->member->lastname}}
                                                    <br>
                                                    <span class="fw-light">
                                                        BU - {{$loan->member->units->unit_code}}
                                                    </span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-end">
                                        <a href="{{route('loan.application.status', $loan->loan->id)}}" type="button" class="btn status-btn bu-orange text-light">View Status</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- CARD --}}
                        @else

                         You haven't submitted a loan application yet.


                        @endif

                    </div>
                </div>
        </div>

    </div>


</main>

@endsection
