@extends('member-components.member-layout')

@section('content')

<main >      
    <div class="container-fluid border border-danger">
        <div class="row">
            <div class="col mt-3 mb-5">
                <div class="d-flex flex-column align-items-center justify-content-center ">
                    <div class="app-status-box bg-white pt-5 border rounded">
                        <p class="fs-4 fw-bold mb-4 text-center">Loan Application Status</p>
                        <div class="lh-1  ">
                            <p><span class="fs-6 fw-bold">Multi-Purpose Loan</span> <span class="fs-7">April 1, 2023</span></p>
                            <div class="row g-0">
                                <div class="col-6 ">
                                    <div class="lh-sm">
                                        <p class="fs-7">Request <br> <span class="fs-6">Php</span> <span class="fs-6 fw-bold">50,000.00</span></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="lh-sm">
                                        <p class="fs-7">Years to pay <br><span class="fs-6">1 year</span></p>
                                    </div>
                                </div>
                            </div>

                            {{-- =================================================================== --}}

                            <div class="status-box-dennied mb-3 ">
                                <div style="padding-left: 40px;">
                                    <p class="mb-1 fs-7 text-white pt-3">April 14, 2023</p>
                                    <p class="fw-bold text-white fs-7 pb-3">Your Loan Application was Denied </p>
                                </div>
                            </div>

                            <div class="status-box border shadow-sm mb-3">
                                <div class="row p-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset('assets/check.png')}}" alt="check logo" style="max-width: 90%; min-width: 50px">
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-2 fs-7">April 11, 2023</p>
                                        <p class="mb-2 fw-bold">Check Picked Up</p>
                                        <p class="fs-7">Your check is picked up. See your <a href="#" style="text-decoration: none; color: black" class="fw-bold">loans</a> to stay up to date on your balance and monthly payment</p>
                                    </div>
                                </div>
                            </div>

                            <div class="status-box border shadow-sm mb-3">
                                <div class="row p-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset('icons/status-check-ready.svg')}}" alt="check logo" style="max-width: 90%; min-width: 50px">
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-2 fs-7">April 10, 2023</p>
                                        <p class="mb-2 fw-bold">Your Check is Ready</p>
                                        <p class="fs-7">Your LPB check is ready for pick-up at BUPF. See requirements <a href="#" style="text-decoration: none; color: black" class="fw-bold">Here</a>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="status-box border shadow-sm mb-3">
                                <div class="row p-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset('icons/status-approved-by-director.svg')}}" alt="check logo" style="max-width: 90%; min-width: 50px">
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-2 fs-7">April 7, 2023</p>
                                        <p class="mb-2 fw-bold">Approved by our Executive Director</p>
                                        <p class="fs-7">Forwarded back to our staff for check release</p>
                                    </div>
                                </div>
                            </div>

                            <div class="status-box border shadow-sm mb-3">
                                <div class="row p-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset('icons/status-loan-analyst.svg')}}" alt="check logo" style="max-width: 90%; min-width: 50px">
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-2 fs-7">April 5, 2023</p>
                                        <p class="mb-2 fw-bold ">Reviewed by our Loan Analyst</p>
                                        <p class="fs-7">Checked and Reviewed for Loan Computations </p>
                                    </div>
                                </div>
                            </div>

                            <div class="status-box border shadow-sm">
                                <div class="row p-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset('icons/status-staff.svg')}}" alt="check logo" style="max-width: 90%; min-width: 50px">
                                    </div>
                                    <div class="col-10">
                                        <p class="mb-2 fs-7">April 3, 2023</p>
                                        <p class="mb-2 fw-bold">Received by our BUPF Staff</p>
                                        <p class="fs-7">Your Loan Application now being forwarded to our Loan Analyst
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

@endsection
