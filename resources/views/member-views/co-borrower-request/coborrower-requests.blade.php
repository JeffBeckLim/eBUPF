@extends('member-components.member-layout')

@section('content')

<main>
    
        <div class=" mx-1 mt-2 d-flex justify-content-center ">
            <div class="bg-white p-2 col-lg-9 rounded border">
                <div class="row ">
                    <div class="col-12">
                        @if(session('message'))
                        <div style="background-color: rgb(255, 231, 200) " class="alert border alert-dismissible fade show" role="alert">
                            {!!session('message')!!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <p class="fs-5 fw-bold my-3 p-3">Incoming Requests</p>
                        <div class="accordion mb-3 border p-1" id="accordionExample">
                            <div class="accordion-item border-0">
                              <h5 class="accordion-header">
                                <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIncomingRequest" aria-expanded="false" aria-controls="collapseIncomingRequest">
                                    <p style="font-size: small" class="m-auto text-secondary">
                                        <i class="bi bi-lightbulb"></i> You've received a co-borrower loan application request. Please review the details before accepting or denying.
                                    </p>
                                </button>
                              </h5>
                              <div id="collapseIncomingRequest" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-secondary" style="font-size: small">
                                    <ul>
                                        <li>Accept: If you're comfortable, click "Accept" to allow them to use your information for their loan application.</li>
                                        <li>Deny: If you'd rather not, click "Deny."</li>
                                    </ul>
                                    <p>Your decision ensures transparency and consent in the loan application process.</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="col-lg-1 col-md-2 p-1 d-flex align-items-center">
                            <label for="searh-input">Search</label>
                        </div>
                        <div class="col flex-grow-1">
                            <input id="myInput" type="text" class="search-input form-control" placeholder="enter your search query">
                        </div>    
                    </div>
                </div>
                {{-- CHECK IF THEIR ARE CB REQUEST --}}
                @if (count($loans) != 0)
                    <table id="incoming-request-table" class="table table-borderless mt-4" style=" background-color: white;">
                        <thead >
                            <tr style="font-size: 12px">
                                <th class="text-center">Info</th>
                                <th class="text-start"  scope="col">Loan</th>
                                <th class="text-center"  scope="col">Principal Borrower</th>
                                <th class="text-center">...</th>
                                
                            
                                
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($loans as $loan)
                                    {{-- USED ON COLUMN 1 -NEW indicator and COLUMN 3 --}}
                                    @php
                                        $try = App\Models\CoBorrower::findorfail($loan->loan->id)
                                    @endphp

                                    <tr class="align-middle">
                                        <td style="" class="text-center ">
                                            @if ($try->accept_request != '0')
                                                <a href="/member/loan-application-details/{{$loan->loan->id}}"><i class="bi bi-info-circle-fill" style="color: #00638D"></i></a>
                                            @endif
                                        </td>
                                        
                                        <td class="text-start">  
                                                @if (is_null($loan->loan->is_viewed && $try->accept_request >= 0))
                                                    <span style="font-size: x-small; background-color: #fccad2;" class=" text-danger fw-bold fade-in p-1 rounded"><i class="bi bi-circle-fill"></i> NEW</span>    
                                                @endif
                                                
                                                <p class=" fw-bold mb-0 mt-1" style="font-size: 14px">
                                                 {{$loan->loan->loanType->loan_type_description}}
                                                </p>
                                                <p class=" mb-1" style="font-size: 12px">
                                                    Code: <span class="fw-bold">{{$loan->loan->loan_code}}</span>
                                                </p>

                                                <p style="font-size: 12px">ID: {{$loan->loan->id}}</p>

                                                <p class="fs-7 mb-0">Php {{number_format($loan->loan->principal_amount, 2, '.',',')}}</p>
                                                <p class="m-0" style="font-size: 10px">{{date('M d, Y - h:i:s A', strtotime($loan->loan->created_at))}}</p>
                                            
                                        </td>
                                        <td>
                                            <div class="row  g-0"  >

                                                <div class="col-lg-4 m-0 g-0 d-flex justify-content-center align-items-center">
                                                    <img src="{{ asset(($loan->loan->member->profile_picture ? 'storage/'.$loan->loan->member->profile_picture : 'assets/no_profile_picture.jpg')) }}" alt="default picture" 
                                                    style="height: 40px; width: 40px; object-fit: cover;"  class="rounded-circle">

                                                </div>
                                                <div class="col" style="font-size: 12px">
                                                    <p class="mb-0  fw-bold">{{$loan->loan->member->firstname}} {{$loan->loan->member->lastname}}</p>
                                                    <p class="mb-0 ">{{($loan->loan->member->units->unit_code)}}</p>
                                                    
                                                </div>
                                            
                                            </div>
            
                                        </td>
                                        <td class="text-center">

                                            @if ($try->accept_request == '0')
                                                <h6 style="font-size: 12px">You <strong>Declined</strong></h6>
                                                    @php
                                                
                                                    $time = \Carbon\Carbon::parse($try->updated_at);
                                                    $now = \Carbon\Carbon::now();
                                                    $diff = $now->shortAbsoluteDiffForHumans($time); 
                                                                                                
                                                    @endphp
                                                    <h6 style="font-size: 10px">
                                                    {{$diff}} ago
                                                    </h6>

                                            @elseif ($try->accept_request == '1')
                                                    <h6  style="font-size: 12px" class="text-success">You <strong>Accepted</strong></h6>
                                                    @php
                                                    
                                                    $time = \Carbon\Carbon::parse($try->updated_at);
                                                    $now = \Carbon\Carbon::now();
                                                    $diff = $now->shortAbsoluteDiffForHumans($time); 
                                                                                                
                                                    @endphp
                                                    <h6 style="font-size: 10px">
                                                    {{$diff}} ago
                                                    </h6>                                             
                                            @else

                                                <div class=" g-0 row d-flex justify-content-center align-items-center">
                                                    <div class="p-1 col-lg-6 col-md-12  col-sm-12" >
                                                        <a href="#" type="button" class=" btn bu-orange w-100 fs-7 text-light fw-bold p-2 rounded-4" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#myModal{{$loan->loan->id}}">Accept</a>
                                                    </div>
                                                    {{-- MODAL CONFIRMATION ACCEPT --}}
                                                    @include('member-views.co-borrower-request.modal-accept')

                                                    <div class="p-1 col-lg-6 col-md-12 col-sm-12 ">
                                                        <a href="#" type="button" class="btn btn-outline-bu2 w-100 fs-7 fw-bold p-2 rounded-4" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#myModalDecline{{$loan->loan->id}}">Decline</a>
                                                    </div>
                                                    {{-- MODAL CONFIRMATION ACCEPT --}}
                                                    @include('member-views.co-borrower-request.modal-decline')
                                                    
                                                </div>

                                            @endif  

                                        </td>
                        
                                       
                                        
                                    </tr>     

                                         
                            @endforeach     
                        </tbody>
                    </table>
                @else
                    <div class="border text-center p-5 mt-3 text-secondary">
                         No Requests Found.
                    </div>
                @endif
                
            </div>
        </div>
    
</main>
<style>
    #incoming-request-table_filter{
        display: none;
    }

    input[type="text"]
    {
        font-size:12px;
    }
</style>
<script>
   var table = $('#incoming-request-table').DataTable({
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
