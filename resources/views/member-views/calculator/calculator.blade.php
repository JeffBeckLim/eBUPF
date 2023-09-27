@extends('member-components.member-layout')

@section('content')

    <div class="bg-white rounded px-3 pt-2 pb-4 m-3 shadow-sm">
        <div class="d-flex align-items-center p-3 gap-3">
            <img src="{{asset('icons/calculator.svg')}}" alt="calculator logo" width="30px" height="50px">
            <span style="font-size: 20px; font-weight: bold; color: #000834;">Loan Calculator</span>
        </div>
        <div style="margin-left: 100px; margin-top: -15px; font-size: 0.9rem;">
           proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit
        </div>

        <div class="row gap-md-5 mx-4 mt-3">
            <div class="col-md-4 bg-white rounded-3 border bg-white px-2 pt-2 pb-2 mb-2 shadow-sm">
                <form action="#" method="get">
                    <div style="padding: 10px 10px 0 10px;">
                        <span class="fw-bold fs-6">Loan Categoryspan </span><span class="text-danger fw-bold">*</span> <br>
                        <div style="padding: 5px 0 0 13px;">
                            <div class="row pt-1">
                                <div class="col-lg-6">
                                    <input type="radio" id="mpl" name="loan_category" value="mpl">
                                    <label for="mpl" class="fs-7">Multi-Purpose</label>
                                </div>
                                <div class="col-lg-5">
                                    <input type="radio" id="hsl" name="loan_category" value="hsl">
                                    <label for="hsl" class="fs-7">Housing</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-8">
                                <label for="amount" class="fw-bold">Amount <span class="text-danger fw-bold">*</span></label>
                                <div class="d-flex align-items-center">
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount" min="1" max="200000">
                                    <span style="margin-left: 5px;">
                                        <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The principal amount you want to calculate"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="term" class="fw-bold">Year/s <span class="text-danger fw-bold">*</span></label>
                                <select name="term" id="term" class="form-control">
                                    <option value="" disabled selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 pt-2">
                            <label for="prevLoan" class="fw-bold fs-6">Add Previous Loan</label>
                            <input type="number" name="prevLoan" id="prevLoan" class="form-control" placeholder="Enter previous loan">
                        </div>
                        <div class="d-flex justify-content-end mt-3 pt-2">
                            <button type="reset" class="btn btn-outline-secondary me-2 rounded-2 bg-secondary text-white">Clear</button>
                            <button type="submit" class="btn btn-primary rounded-2 text-white" style="background: #FF6F19; border: none;">Calculate</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7 bg-white rounded-3 border bg-white px-2 pt-2 pb-2 mb-2 shadow-sm">
                <div style="padding: 10px 10px 0 10px;">
                    <div class="fw-bold fs-6">
                        Result
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Monthly principal
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Monthly Interest
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Monthly Payable
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Total Interest
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Total Amount
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Total Months
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    0.00
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            Graph
                        </div>
                        <div class="pt-2">
                            <a href="" class="btn d-flex justify-content-center align-items-center fs-7 text-white"><span style="border-radius: 10px;background: #0092D1; padding: 8px 15px;">View Amortization Table</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="fw-bold fs-6">
                Loan Categories
            </div>
            <div class="fs-7 mt-2" style="margin-left: 25px;">
                <span class="fw-bold">Multi-Purpose Loan </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2" style="margin-left: 25px;">
                <span class="fw-bold">Housing Loan </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Principal and Monthly Interest</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Payable</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Amount</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Months</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
        </div>
    </div>

@endsection
