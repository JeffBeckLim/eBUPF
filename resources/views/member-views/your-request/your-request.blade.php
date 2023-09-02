@extends('member-components.member-layout')

@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col mt-3">
                <div class="container d-flex flex-column align-items-center justify-content-center ">
                    <div class="request-to-coborrower">
                        <p class="fs-4 fw-bold p-4">Outgoing Requests</p>
                        <div class="container d-flex align-items-center " style="padding-left: 20px;">
                            {{-- <p class="">Search</p> --}}
                            <label for="search" class="pe-2">Search</label>
                            <input id="search" type="text" class="search-box" placeholder="Enter your search query">
                        </div>
                        @if (count($cb_withLoans) != 0)

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
                                @foreach ($cb_withLoans as $cb_withLoan )
                                <tr>
                                    <td class="align-middle " >
                                        <div class="ps-3">
                                            <p class="fs-7 fw-bold mb-0">{{$cb_withLoan->loan->loanType->loan_type_description}}</p>
                                            <p class="fs-7 mb-0"> Php {{number_format($cb_withLoan->loan->principal_amount, 2, '.',',')}}</p>
                                            <p class="fs-7">{{date('F d, Y - h:i:s A', strtotime($cb_withLoan->loan->created_at))}}</p>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset(($cb_withLoan->member->profile_picture ? 'storage/'.$cb_withLoan->member->profile_picture : 'assets/no_profile_picture.jpg')) }}" alt="default picture" width="50px" class="rounded-circle">


                                            <div class="ms-3">
                                                <p class="mb-0 fs-7">{{$cb_withLoan->member->firstname}} {{$cb_withLoan->member->lastname}}</p>
                                                <p class="mb-0 fs-7">{{$cb_withLoan->member->units->unit_code}}</p>
                                                <p class="fs-7">ID: {{$cb_withLoan->member->id}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($cb_withLoan->accept_request == '1')
                                            <p style="color: #00B733;" class="fs-7 fw-bold">Accepted</p>
                                        @elseif($cb_withLoan->accept_request == '0')
                                            <p style="color: #FF0000;" class="fs-7 fw-bold">Rejected</p>
                                        @else
                                            <p class="text-muted fs-7 fw-bold">Pending</p>
                                        @endif
                                        {{-- =============================================================== --}}
                                        @if ($cb_withLoan->loan->is_viewed != null)
                                        <p class="text-secondary m-0" style="font-size: small"><i class="bi bi-eye"></i> {{$cb_withLoan->loan->is_viewed}}</p>
                                        @endif

                                    </td>
                                    <td class="align-middle  text-center">
                                        @if ($cb_withLoan->loan->loanType->loan_type_name == "MPL")
                                            <a href="{{route('generateMulti-PurposeLoanApplicationForm')}}" type="button" class=" btn w-100 bu-orange fs-6 text-light rounded-1 {{$cb_withLoan->accept_request != '1' ? 'disabled' : ''}}"> <i class="bi bi-printer-fill"></i> Print</a>
                                        @elseif ($cb_withLoan->loan->loanType->loan_type_name == "HSL")
                                            <a href="{{ route('generateHousingLoanApplicationForm', ['id' => $cb_withLoan->loan->id]) }}" type="button" class="btn w-100 bu-orange fs-6 text-light rounded-1 {{ $cb_withLoan->accept_request != '1' ? 'disabled' : '' }}">
                                                <i class="bi bi-printer-fill"></i> Print
                                            </a>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="/member/loan-application-details/{{$cb_withLoan->loan->id}}"><i class="bi bi-info-circle-fill" style="color: #00638D"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @else
                        <div class="border text-center p-5 mt-3 m-3 text-secondary">
                            No Requests Found.
                       </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
