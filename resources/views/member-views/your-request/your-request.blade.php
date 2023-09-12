@extends('member-components.member-layout')

@section('content')

<main>
    <div class="container-fluid">
        <div class="row  d-flex justify-content-center">
            <div class="col-lg-8 col-md-10 ">
                <div class="bg-white rounded border mx-1 mt-2 p-2">
                    <div class="row my-3 g-0 p-3">
                        <p class="fs-5 fw-bold">Outgoing Requests</p>
                    </div>
                    <div class="mx-2">
                        <div class="accordion mb-3" id="accordionExample">
                            <div class="accordion-item border-0">
                              <h5 class="accordion-header">
                                <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <p style="font-size: small" class="my-auto text-secondary">
                                        <i class="bi bi-lightbulb"></i> This is where you can see the loan application form you have sent to your co-borrower
                                    </p>
                                </button>
                              </h5>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-secondary" style="font-size: small">
                                    <ul>
                                        <li><strong>If co-borrower accepts</strong>: You will be able to print the loan application form with the co-borrowers detail ready for them to sign</li>
                                        <li><strong>If co-borrower denies</strong>: You cannot print the form</li>
                                    </ul>
                                    <p>Your decision ensures transparency and consent in the loan application process.</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class=" d-flex align-items-center mx-2">
                        <label for="search" class="pe-2">Search</label>
                        <input id="search" type="text" class="search-box" placeholder="Enter your search query">
                    </div>
                    <div class="row g-0">
                        @if (count($cb_withLoans) != 0)
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Loan</th>
                                    <th scope="col">Co-Borrower</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cb_withLoans as $cb_withLoan )
                                <tr>
                                    <td class="align-middle" style="width: 20%">
                                        <div class="p-1">
                                            <p class="fs-7 fw-bold mb-0">{{$cb_withLoan->loan->loanType->loan_type_description}}</p>
                                            <p class="fs-7 mb-0"> Php {{number_format($cb_withLoan->loan->principal_amount, 2, '.',',')}}</p>
                                            @php
                                            
                                            $time = \Carbon\Carbon::parse($cb_withLoan->loan->created_at);
                                            $now = \Carbon\Carbon::now();
                                            $diff = $now->shortAbsoluteDiffForHumans($time); 
                                                                                        
                                            @endphp
                                            <p class="fw-bold" style="color: #00638D; font-size: 12px;">{{$diff}} ago</p>
                                            {{-- <p class="fs-7">{{date('F d, Y - h:i:s A', strtotime($cb_withLoan->loan->created_at))}}</p> --}}
                                        </div>
                                    </td>
                                    <td class="align-middle" style="width: 30%">
                                        <div class="d-flex align-items-center">
                                            <div class="row  w-100 m-0 p-0">
                                                <div class="col-lg-3  m-0 p-0 text-center">
                                                    <img src="{{ asset(($cb_withLoan->member->profile_picture ? 'storage/'.$cb_withLoan->member->profile_picture : 'assets/no_profile_picture.jpg')) }}" alt="default picture" width="50px" class="rounded-circle img-fluid"> 
                                                </div>
                                                <div class="col-lg-9 ps-lg-2  m-0 p-0">
                                                    <p class="mb-0 fs-7">{{$cb_withLoan->member->firstname}} {{$cb_withLoan->member->lastname}}</p>
                                                    <p class="mb-0 fs-7">{{$cb_withLoan->member->units->unit_code}} | {{$cb_withLoan->member->units->campuses->campus_code}}</p>
                                                    {{-- <p class="fs-7">ID: {{$cb_withLoan->member->id}}</p> --}}
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </td>
                                    <td class="align-middle" style="width: 15%">
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
                                    <td class="align-middle  text-center" style="width: 20%">
                                        @if ($cb_withLoan->loan->loanType->loan_type_name == "MPL")
                                            <a href="{{route('generateMulti-PurposeLoanApplicationForm', ['id' => $cb_withLoan->loan->id])}}" type="button" class=" btn w-100 bu-orange fs-6 text-light rounded-1 {{$cb_withLoan->accept_request != '1' ? 'disabled' : ''}}"> <i class="bi bi-printer-fill"></i> Print</a>
                                        @elseif ($cb_withLoan->loan->loanType->loan_type_name == "HSL")
                                            <a href="{{ route('generateHousingLoanApplicationForm', ['id' => $cb_withLoan->loan->id]) }}" type="button" class="btn w-100 bu-orange fs-6 text-light rounded-1 {{ $cb_withLoan->accept_request != '1' ? 'disabled' : '' }}">
                                                <i class="bi bi-printer-fill"></i> Print
                                            </a>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center" style="width: 15%">
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
    
    {{-- <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script> --}}

</main>
{{-- <style>
    #myTable{
        width: ;
    }
    .dataTables_length{
        display: none !important; 
    }
    .dataTables_filter{
        display: flex !important;
        justify-content: flex-start !important;
        width: 100% !important;
        display: flex;
        border: 1px solid green;
        padding: 1rem;
        
    }
    .dataTables_filter input{
        width: auto !important;
    }
    th.sorting{
        pointer-events: none !important;
    }
    /* th.sorting.sorting_asc::before{
        display: none !important;
       
    }
    th.sorting.sorting_asc::after{
        display: none !important;

    } */
    th.sorting::before{
        display: none !important;
    }
    th.sorting::after{
        display: none !important;
    }

</style> --}}
@endsection