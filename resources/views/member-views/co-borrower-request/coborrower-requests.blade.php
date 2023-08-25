@extends('member-components.member-layout')

@section('content')

<main>
    
        <div class=" ms-4 mt-2 d-flex justify-content-center">
            <div class="bg-white p-4 col-lg-9">
                <div class="row">
                    <div class="col-12">
                        @if(session('message'))
                        <div style="background-color: rgb(255, 231, 200) " class="alert border alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <p class="fs-4 fw-bold pt-2">Incoming Requests</p>
                        <div class="accordion mb-3" id="accordionExample">
                            <div class="accordion-item border-0">
                              <h5 class="accordion-header">
                                <button class="accordion-button collapsed p-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <p style="font-size: small" class="m-auto text-secondary">
                                        <i class="bi bi-lightbulb"></i> You've received a co-borrower loan application request. Please review the details before accepting or denying.
                                    </p>
                                </button>
                              </h5>
                              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                            <input type="text" class="search-input form-control" placeholder="enter your search query">
                        </div>    
                    </div>
                </div>
                {{-- CHECK IF THEIR ARE CB REQUEST --}}
                @if ($loans)
                    <table class="table table-hover mt-4" style=" background-color: white;">
                        <thead>
                            <tr>
                                <th class="text-center"  scope="col">Loan</th>
                                {{-- THIS WILL SHOW ONLY ON SMALL SCREENS  --}}
                                <th class="text-center d-md-none"  style="font-size: small" scope="col">Principal Borrower</th>
                                {{-- THIS WILL SHOW ONLY ON MEDIUM TO LARGE SCREENS  --}}
                                <th class="text-center d-none d-md-block"  scope="col">Principal Borrower</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                    <tr class="align-middle">
                                        <td > 
                                            <div>
                                                @if (is_null($loan->loan->is_viewed))
                                                    <p style="font-size: small" class=" text-danger"><i class="bi bi-circle-fill"></i> NEW</p>    
                                                @endif
                                                
                                                <p class="fs-7 fw-bold mb-0">{{$loan->loan->loanType->loan_type_name}} 
                                                
                                                <span class="fw-light"> {{$loan->loan->loanType->loan_type_description}}</span>
                                                </p>
                                                <p class="fs-7 mb-0">Php {{number_format($loan->loan->principal_amount, 2, '.',',')}}</p>
                                                <p class="fs-7">{{date('F d, Y - h:i:s A', strtotime($loan->loan->created_at))}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row  g-0">

                                                <div class="col-lg-4 m-0 g-0 d-flex justify-content-center align-items-center">
                                                    <img src="{{asset('storage/'.$loan->loan->member->profile_picture)}}" alt="null" style="width: 3rem; height: 3rem; object-fit: cover;" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="col">
                                                    <p class="mb-0 fs-7 fw-bold">{{$loan->loan->member->firstname}} {{$loan->loan->member->lastname}}</p>
                                                    <p class="mb-0 fs-7">{{($loan->loan->member->units->unit_code)}}</p>
                                                    <p class="fs-7">ID: {{$loan->loan->id}}</p>
                                                </div>
                                            
                                            </div>
            
                                        </td>
                                        <td class="border border-danger">
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
                                        </td>
                                        <td style="width: 4rem;" class="text-center">
                                            <a href="/member/loan-application-details/{{$loan->loan->id}}"><i class="bi bi-info-circle-fill" style="color: #00638D"></i></a>
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

@endsection
