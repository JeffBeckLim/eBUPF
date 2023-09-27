<div class="row">

    <!-- Placeholder to prevent overlapping -->
    <div class="d-none d-lg-block" style="width: 20%;">
        <span class="placeholder"></span>
    </div>
    <!-- Placeholder to prevent overlapping -->

    <!-- NAVBAR -->
    <div class="   d-none  d-lg-block  position-fixed h-100 " style="background-color: #ffffff; width: 20%;">
        <div class="row d-flex   py-3">
            <a href="{{route('home')}}">
                <img class="img-fluid ps-2 pt-2" src="{{asset('assets/bu-provident.svg')}}" alt="" style="width: 14rem;">
            </a>
        </div>


        <ul class="nav flex-column" style=" scale: .9" >  

            <a class="text-decoration-none" href="{{ route('member.profile') }}">
                <li class="nav-items py-3 grow-on-hover {{ Route::is('member.profile') ? 'bg-selected fade-in  rounded-4':' '}}  ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="icon" src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="icon">
                        </div>
                        <div class="col d-flex align-items-center text-secondary">
                            <span class="fw-bold fs-7">{{ Auth::user()->member->firstname }} {{ Auth::user()->member->lastname }}</span>
                        </div>
                    </div>
                </li>
            </a>   


            <a class="text-decoration-none" href="{{ route('home') }}">
                <li class="nav-item  py-3 grow-on-hover {{ Route::is('member-dashboard') ? 'bg-selected fade-in  rounded-4':' '}} ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img src="{{asset('icons/home.svg')}}" alt="">
                        </div>
                        <div class="col-9">
                            <span class="fw-bold fs-7 text-secondary">Home</span>
                        </div>
                    </div>
                </li>
            </a>
                

            <li class="nav-item grow-on-hover">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">
                    
                        <button style="padding-left: 13px  !important;" class="accordion-button collapsed {{ Route::is('mpl.application','hsl.application','displayAvailableLoans', 'loan.applications', 'member.loans') ? 'bg-selected fade-in  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoans" aria-expanded="false" aria-controls="collapseLoans">
                            <div class="row g-0 w-100">
                                <div class="col-3 text-center pe-2">
                                    <i class="fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                                </div>
                                <div class="col-9 ">
                                    <span class="fw-bold fs-7 text-secondary">Loans</span>
                                </div>
                            </div>
                        </button>
                 
                      <div id="collapseLoans" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12 p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('member.loans') ? 'fw-bold' : ''}}" href="{{route('member.loans')}}">Your Loans</a>
                                </div>
                                
                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('loan.applications') ? 'fw-bold' : ''}} " href="{{ route('loan.applications')}}">Loan Applications</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is( 'mpl.application') ? 'fw-bold' : ''}}" href="{{route('mpl.application')}}">Apply for MPL</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is( 'hsl.application') ? 'fw-bold' : ''}}" href="{{route('hsl.application')}}">Apply for HSL</a>
                                </div>




                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>



            <a class="text-decoration-none" href="{{route('calculator')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('calculator') ? 'bg-selected fade-in fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center  ">
                            <img src="{{asset('icons/calculator.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class=" fw-bold fs-7 text-secondary">Calculator</span>
                        </div>
                    </div>
                </li>
            </a>


            <a class="text-decoration-none" href="{{route('member.transactions')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('member.transactions') ? 'bg-selected fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="mb-1" src="{{asset('icons/receipt.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class="fw-bold fs-7  text-secondary">Transactions</span>
                        </div>
                    </div>
                </li>
            </a>

            <li class="nav-item grow-on-hover">
                <div  class="accordion rounded" id="accordionRequests">
                    <div class="accordion-item border-0">
                    
                        <button style="padding-left: 5px !important" class="accordion-button collapsed {{Route::is('incoming.request','outgoing.request') ? 'bg-selected fade-in rounded-4' : ''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            <div class="row g-0  w-100">
                                <div class="col-3 text-center">
                                    <img src="{{asset('icons/envelope.svg')}}" alt="">
                                </div>
                                <div class="col-9 ps-1">
                                    <span class="fw-bold fs-7 text-secondary">Requests</span>
                                </div>
                            </div>
                        </button>
                  
                      <div id="collapseRequests" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('outgoing.request')? 'fw-bold': ''}}" href="/member/Your/coBorrower/requests/">Your Requests</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('incoming.request')? 'fw-bold': ''}}" href="/member/coBorrower/requests/">Incoming Requests</a>
                                </div>

                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>

        </ul>

        <div class="ms-3 d-flex align-items-end mt-1">
            <div class="row g-0  w-100">
                <div class="col-12 border-top">
                    {{--  <i class="bi bi-list pe-4" style="color: #1030DA"></i> --}}
                    <div class="dropdown">
                    <a class="btn dropdown w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list pe-4" style="color: #1030DA"></i>More
                    </a>
                    
                    <ul class="dropdown-menu border p-2" style="width: 110%">
                        <li><a class="dropdown-item rounded" href="/logout">Log out</a></li>
                    </div>
                </div>
            </div>
        </div>

    </div>
