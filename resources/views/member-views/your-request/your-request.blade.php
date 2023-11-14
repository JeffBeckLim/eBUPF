@extends('member-components.member-layout')

@section('content')

<main>

    <div class="container-fluid">
        
        <div class="row  d-flex justify-content-center">

            <div class="col-lg-8 ms-2">

                

                <div class="bg-white rounded border mt-2 p-2">

                    @if (session('fail'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('fail')}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>    
                    @endif

                    @if (session('passed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('passed')}}
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>    
                    @endif
                    

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

                                        <li><strong>Accepted request can not be cancelled</strong></li>
                                    </ul>
                                    <p>Your decision ensures transparency and consent in the loan application process.</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class=" d-flex align-items-center mx-2 mb-4">
                        <label for="search" class="pe-2">Search</label>
                        <input id="myInput" type="text" class="search-box " placeholder="Enter your search query">
                    </div>
                    <div class="row g-0 table-responsive">
                        @if (count($cb_withLoans) != 0)
                        
                        <table id="outgoing-request-table" class="table table-borderless">
                            <thead>
                                <tr style="font-size: 14px">
                                    <th>Info</th>
                                    <th scope="col">Loan</th>
                                    <th scope="col">Co-Borrower (CB)</th>
                                    <th scope="col">CB Status</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cb_withLoans as $cb_withLoan )
                                <tr>
                                    <td class="align-middle text-center" style="width: 10%">
                                        <a href="/member/loan-application-details/{{$cb_withLoan->loan->id}}">
                                            <i class="bi bi-info-circle-fill" style="color: #00638D"></i>
                                        </a>
                                    </td>
                                    
                                    <td class="align-middle" style="width: 25%">
                                        <div class="p-1" >
                                            <p class=" fw-bold mb-0" style="font-size: 12px">{{$cb_withLoan->loan->loanType->loan_type_name}}</p>
                                            <p class=" mb-1" style="font-size: 12px">Code: <span class="fw-bold">{{$cb_withLoan->loan->loan_code}}</span></p>
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
                                    <td class="align-middle" style="width: 25%">
                                        <div class="d-flex align-items-center">
                                            <div class="row  w-100 m-0 p-0">
                                                <div class="col-lg-3  m-0 p-0 text-center">
                                                    <img src="{{ asset(($cb_withLoan->member->profile_picture ? 'storage/'.$cb_withLoan->member->profile_picture : 'assets/no_profile_picture.jpg')) }}" alt="default picture"  style="height: 40px; width: 40px; object-fit: cover;"  class="rounded-circle img-fluid"> 
                                                </div>
                                                <div class="col-lg-9 ps-lg-2  m-0 p-0">
                                                    <p class="mb-0 fs-7 fw-bold">{{$cb_withLoan->member->firstname}} {{$cb_withLoan->member->lastname}}</p>
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
                                            <p style="color: #ff4141;" class="fs-7 fw-bold">Declined</p>
                                        @else
                                            <p class="text-muted fs-7 fw-bold">Pending</p>
                                        @endif
                                        {{-- =============================================================== --}}
                                        @if ($cb_withLoan->loan->is_viewed != null)
                                        <p class="text-secondary m-0" style="font-size: x-small"><i class="bi bi-eye"></i> 
                                        
                                            {{ Carbon\Carbon::parse($cb_withLoan->loan->is_viewed)->format('F j, Y g:i A') }}
                                        </p>
                                        @endif

                                    </td>
                                    <td class="align-middle  text-center" style="width: 20%">
                                        @if($cb_withLoan->loan->deleted_at != null)
                                             <p style="font-size: 12px">Loan Application Cancelled.</p>
                                        @elseif ($cb_withLoan->accept_request == 1)
                                            {{-- Display print if co borrower accepts --}}
                                            @if ($cb_withLoan->loan->loanType->loan_type_name == "MPL")
                                                <a style="font-size: 14px" href="{{route('generateMulti-PurposeLoanApplicationForm', ['id' => $cb_withLoan->loan->id])}}" type="button" class=" btn w-100 bu-orange text-light rounded-4 fw-bold {{$cb_withLoan->accept_request != '1' ? 'disabled' : ''}}">  Print</a>
                                            @elseif ($cb_withLoan->loan->loanType->loan_type_name == "HSL")
                                                <a style="font-size: 14px" href="{{ route('generateHousingLoanApplicationForm', ['id' => $cb_withLoan->loan->id]) }}" type="button" class="btn w-100 bu-orange text-light rounded-4 fw-bold {{ $cb_withLoan->accept_request != '1' ? 'disabled' : '' }}">
                                                    Print
                                                </a>
                                            @endif
                                            <div class="dropdown mt-2 ">
                                                <button class="btn  rounded-5 w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                >
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cancelModal{{$cb_withLoan->loan->id}}">
                                                    Cancel Application</a>
                                                </li>

                                                </ul>
                                              </div>
                                        @elseif($cb_withLoan->loan->deleted_at)
                                            <p style="font-size: 12px">Loan Application Cancelled.</p>
                                        @else 
                                            <a style="font-size: 14px" data-bs-toggle="modal" data-bs-target="#cancelModal{{$cb_withLoan->loan->id}}" href="" type="button" class="btn w-100 btn-outline-bu2 fw-bold rounded-4 mt-2 {{ $cb_withLoan->accept_request == '1' ? 'disabled' : '' }}">
                                                Cancel
                                            </a>
                                        @endif
                                        
                                    </td>
                                   
                                </tr>
                                @include('member-views.your-request.modal-cancel-request')


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
<style>
    #outgoing-request-table_filter{
        display: none;
    }

    input[type="text"]
    {
        font-size:12px;
    }
</style>
<script>
   var table = $('#outgoing-request-table').DataTable({
    info: false,
    ordering: false,
    paging: false
   });
 
 // #myInput is a <input type="text"> element
 $('#myInput').on( 'keyup', function () {
     table.search( this.value ).draw();
 } );
</script>

@endsection
