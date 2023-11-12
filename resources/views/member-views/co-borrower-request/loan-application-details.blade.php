@extends('member-components.member-layout')

@section('content')

<main>
    <div class="container mt-5">
        {{-- this is the navigation --}}

        {{-- THIS CODE CHECKS IF THE LOAN belongs to the User then it is checking the Outgoing Request --}}
        @if($loan->member_id == Auth::user()->member->id)
            <a href="/member/Your/coBorrower/requests/" class="text-decoration-none text-secondary fw-bold">Your Requests <i class="bi bi-chevron-right"></i></a> <span class="fw-bold">Your Application Details</span>

        {{-- Else then it is shown as the co-borrower --}}
        @else
            <a href="/member/coBorrower/requests/" class="text-decoration-none text-secondary fw-bold">Requests <i class="bi bi-chevron-right"></i></a> <span class="fw-bold">Application Details</span>
        @endif



        <div class="border bg-white rounded-4 p-4 mt-2 " >
            <p class="text-center m-0 mt-4 fw-bold fs-5">{{$loan->LoanType->loan_type_description}} Application</p>
            <p class="text-center pb-4 mb-3 fw-bold fs-7" style="border-bottom: 1px solid #DBDBDB; color: #00638D">Application Details</p>
            <div class="row">
                <div class="col-12 text-center border-bottom mb-3">
                    <p class="appdetails-text">Loan code: <span class="text-dark fw-light">{{$loan->loan_code}}</span></p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Principal Borrower</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->firstname}}
                            {{$loan->member->lastname}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Amount Requested</p>
                        </div>
                        <div class="col-6">
                            <i>Php </i>{{number_format($loan->principal_amount, 2, '.',',')}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Permanent Address</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->address}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Years</p>
                        </div>
                        <div class="col-6">
                            {{$loan->term_years}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Date of Birth</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->date_of_birth}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Tin</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->tin_num}}
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Unit</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->units->unit_code}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Contact Number</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->contact_num}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Office</p>
                        </div>
                        <div class="col-6">
                            {{$loan->member->units->campuses->campus_code}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Witness 1</p>
                        </div>
                        <div class="col-6">
                            @if (!empty($witnesses[0]))
                                {{$witnesses[0]->witness_name}}
                            @else
                                <i>No Witness Included</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="appdetails-text">Witness 2</p>
                        </div>
                        <div class="col-6">
                            @if (!empty($witnesses[1]))
                                {{$witnesses[1]->witness_name}}
                            @else
                                <i>No Witness Included</i>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</main>

@endsection
