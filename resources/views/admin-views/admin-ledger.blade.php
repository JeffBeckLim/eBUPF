@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid px-2" style="scale: 0.95;">
    <div class="row">
        <div class="col-md-6 d-flex gap-2">
            <h3 class="pl-head">Personal Ledger</h3>
            <p class="pl-50 d-flex justify-content-center align-items-center">Not Paid 50%</p>
        </div>
        <div class="col-md-6 ">
            <div class="d-flex justify-content-end">
                <span class="badge rounded-pill  w-25 d-flex align-items-center justify-content-center" style="background-color: #0092D1; font-size: 12px;">Primary</span>
                
                <div class="dropdown ms-2">
                    <button  class="btn  fw-bold bu-orange text-white rounded-pill " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span style="font-size: 12px;">Multi-Purpose Loan 3 <img class="ms-3"  src="{{asset('icons/caret-down-white.svg')}}" style="width: 10px;" ></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Multi-Purpose 2</a>
                        <a class="dropdown-item" href="#">Housing loan 1</a>
                        <a class="dropdown-item" href="#">Multi-Purpose 1</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pl-details mt-2">
        <div class="row">
            <div class="col-md-3 ">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size "><span class="fw-bold">Principal: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">200,000</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">36,000</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Amort. Prin.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">3,333.33</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Monthly Interest: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">600</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Loan Grant: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">Dec. 2022</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Amort. Period: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">Dec. 2027</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Term (Year): </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">5</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Term (Month): </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">60</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">3,333.33</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">600</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">3,333.33</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Paid: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Principal Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">196,666.67</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Interest Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">35,400.00</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Total Bal.: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">232,066.67</p>
                    </div>
                    <div class="col-8">
                        <p class="pl-text-size"><span class="fw-bold">Months Left: </span></p>
                    </div>
                    <div class="col-4">
                        <p class="pl-text-size">59</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-container border rounded-3">
        <table class="table fixed-width-table pl-table">
            <thead>
                <tr class="pl-tr">
                    <th></th>
                    <th colspan="2">2027</th>
                    <th colspan="2">2026</th>
                    <th colspan="2">2025</th>
                    <th colspan="2">2024</th>
                    <th colspan="2">2023</th>
                    <th colspan="2">2022</th>
                </tr>
                <tr class="pl-tr" style="border-bottom: 1px solid black">
                    <th>Month</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                    <th class="fw-normal">Principal</th>
                    <th class="fw-normal">Interest</th>
                </tr>
            </thead>
            <tbody>
                <tr class="pl-tr">
                    <td>January</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>3,333.33</td>
                    <td>600.00</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>February</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>March</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>April</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>May</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>June</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>July</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>August</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>September</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>October</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>November</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="pl-tr">
                    <td>December</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-danger fw-bolder">Loan Granted</td>
                </tr>
                <tr class="pl-tr-last">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>3,333.33</td>
                    <td>600.00</td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


@endsection