@extends('member-components.member-layout')

@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col mt-5">
                <div class="container d-flex flex-column align-items-center justify-content-center ">
                    <div class="request-to-coborrower">
                        <p class="fs-4 fw-bold p-4">Outgoing Requests</p>
                        <div class="container d-flex align-items-center " style="padding-left: 20px;">
                            {{-- <p class="">Search</p> --}}
                            <label for="search" class="pe-2">Search</label>
                            <input id="search" type="text" class="search-box" placeholder="Enter your search query">
                        </div>

                        <table class="table caption-top" style="margin-top: 20px; background-color: white;">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding-left: 20px;">Loan</th>
                                    <th scope="col">Co-Borrower</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <div style="padding-left: 15px;">
                                            <p class="fs-7 fw-bold mb-0">Multi-Purpose Loan</p>
                                            <p class="fs-7 mb-0">Php 50,000.00</p>
                                            <p class="fs-7">April 2, 2023</p>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <img src="assets/hooman.png" alt="default picture" width="40px" class="rounded-circle">
                                            <div class="ms-3">
                                                <p class="mb-0 fs-7">Elly Buendia</p>
                                                <p class="mb-0 fs-7">BUCS</p>
                                                <p class="fs-7">ID: 12042</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                            <p style="color: #00B733;" class="fs-7 fw-bold">Accepted</p>
                                            <p class="text-muted fs-7 fw-bold">Pending</p>
                                            <p style="color: #FF0000;" class="fs-7 fw-bold">Rejected</p>
                                    </td>
                                    <td class="align-middle border text-center" style="width: 120px">
                                        <a href="#" type="button" class="btn bu-orange fs-6 text-light fw-bold rounded "> <i class="bi bi-printer-fill"></i> Print</a>
                                    </td>
                                    <td class="align-middle text-center" style="width: 150px">
                                        <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                    </td>
                                </tr>
                              
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
