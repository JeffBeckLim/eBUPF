@extends('member-components.member-layout')

@section('content')

<main >      
    <div class="container-fluid">
            <div class="row  d-flex justify-content-center p-2">
                
                
                    <div class="col-lg-7 bg-white rounded border  mt-2 pb-5">
                        <div class="mx-lg-3 m-1 my-4">
                            <p class=" fs-5 fw-bold">Loan <br> Applications</p>
                        </div>
                        
                        <div class="  d-flex align-items-center  mx-lg-3 m-1">
                            <label>Search</label>
                            <input type="text" class="ms-2 search-box" placeholder="Enter your search query">
                        </div>

                        <div class="d-flex flex-column align-items-center justify-content-center mt-4 mx-lg-3 m-1">
                            <div class="w-100 border rounded px-3 pt-2 pb-4 mb-2 shadow-sm">
                                <div class="row  mt-2 g-0 ">
                                    <div class="col-4 border rounded ps-3 pt-2">
                                        <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: grey"></i><span class="text-muted">Being Processed</span></p>
                                        <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: blue"></i><span class="text-primary">Check Ready</span></p>
                                        
                                        <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: red"></i><span class="text-danger">Denied</span></p>
                                        <p class="text16-design m-0"><i class="bi bi-circle-fill me-1" style="color: green"></i><span class="text-success">Check Picked Up</span></p>
                                        <p class="fw-bold text m-0" style="font-size: small">Multi-purpose Loan</p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <p class="text16-design">April 1, 2023</p>
                                    </div>


                                    <div class="col-4">
                                        <p class=" text15-design m-0">Request</p>
                                        <p class=" fw-bold text17-design "><span class="fw-light">Php </span>200,000.00</p>
                                    </div>


                                    <div class="col-2">
                                        <p class="text15-design m-0"> Years to Pay</p>
                                        <p class="text17-design">1 Year</p>
                                    </div>
                                </div>
                                <div class="row g-0">
                                    <div class="col-6">
                                        <p class="m-0 ps-2 mt-2" style="font-size:small">Co-Borrower</p>
                                        <div class="row g-0">
                                            <div class="col  mt-1 d-flex">
                                                <img class="rounded-circle mx-2" src="{{asset('assets/hooman.png')}}" alt="Default Picture" style="height: 2.5rem;">
                                                <span class="fw-bold fs-7 my-auto">
                                                        Elly Buendia <br> 
                                                    <span class="fw-light">
                                                            BUCS
                                                    </span>
                                                </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end align-items-end">
                                        <a href="#" type="button" class="btn status-btn bu-orange text-light">View Status</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                
            </div>
        </div>

    </div>


</main>

@endsection
