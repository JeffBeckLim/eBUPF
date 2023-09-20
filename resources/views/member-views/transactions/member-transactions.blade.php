@extends('member-components.member-layout')

@section('content')

<div class="container-fluid">

        <div class="col pt-3">
            <div class="card border col-lg-6 col-sm-12 mx-auto shadow-sm p-4">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-12  d-flex justify-content-center">
                            <img src="{{asset('icons/receipt-history.svg')}}" alt="history" style="width: 3rem;">
                            <p class="text-center fw-bolder m-0">
                                Transaction
                                <br>
                                History
                            </p>
                        </div>

                        <div class="col-12 border-bottom pt-4">
                            <span class=" d-flex justify-content-center align-items-center">
                                <a href="#" class="px-3 text-decoration-none text-muted fw-bold"><p class="fs-7 btn bu-orange text-light fw-bold rounded-pill">All Activity</p></a>
                                <a href="#" class="px-3 text-decoration-none text-muted fw-bold"><p  class="fs-7">MPL</p></a>
                                <a href="#" class="px-3 text-decoration-none text-muted fw-bold "><p  class="fs-7">Housing</p></a>
                            </span>
                        </div>

                        <div class="col-12 border-bottom pt-3">

                            <div class="row  py-3">
                                <div class="col-8 my-1">
                                    <p class="fs-7 fw-bold m-0">Loan Payment</p>
                                    <p class="fs-7 m-0">April 01, 2023, 10:01 AM</p>
                                </div>
                                <div class="col-3 my-1">
                                    <p class="fs-7 fw-bold m-0">19,000.00</p>
                                </div>
                                <div class="col-1 my-1">
                                    <a href="#"><i class="bi bi-info-circle-fill" style="color: #00638D"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
