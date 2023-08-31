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


        <ul class="nav flex-column" style=" scale: 0.9;" >  
            <li class="nav-items py-3 grow-on-hover {{ Route::is('member.profile') ? 'bg-selected  rounded-4':' '}}  ">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="icon" src="{{ asset('storage/' . Auth::user()->member->profile_picture)}}" alt="icon">
                    </div>
                    <div class="col  d-flex align-items-center">
                        <a href="{{ route('member.profile', ['id' => Auth::user()->member->id]) }}" style="text-decoration: none; width: 100%;" class="text-secondary"><span class="fw-bold fs-7">{{ Auth::user()->member->firstname }} {{ Auth::user()->member->lastname }}</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item  py-3 grow-on-hover {{ Route::is('member-dashboard') ? 'bg-selected  rounded-4':' '}} ">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img src="{{asset('icons/home.svg')}}" alt="">
                    </div>
                    <div class="col d-flex">
                        <a href="{{ route('home') }}" style="text-decoration: none; width: 100%;" class="text-secondary"><span class="fw-bold fs-7">Home</span></a>
                    </div>
                </div>
            </li>

            <li class="nav-item grow-on-hover">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">
                    
                        <button style="padding-left: 8px  !important;" class="accordion-button collapsed {{ Route::is('mpl.application','hsl.application','displayAvailableLoans') ? 'bg-selected  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoans" aria-expanded="false" aria-controls="collapseLoans">
                            <div class="row g-0  w-100">
                                <div class="col-3 text-center ">
                                    <i class="fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                                </div>
                                <div class="col-9">
                                    <span class="fw-bold fs-7 text-secondary">Loans</span>
                                </div>
                            </div>
                        </button>
                 
                      <div id="collapseLoans" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">
                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('displayAvailableLoans', 'mpl.application', 'hsl.application') ? 'fw-bold' : ''}}" href="/member/apply/loan">Apply Loan</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary" href="">Multi Purpose</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary" href="">Housing</a>
                                </div>

                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>



            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1 " src="{{asset('icons/calculator.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class=" fw-bold fs-7 text-secondary">Calculator</span>
                    </div>
                </div>
            </li>

            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1" src="{{asset('icons/receipt.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class="fw-bold fs-7  text-secondary">Transactions</span>
                    </div>
                </div>
            </li>


            <li class="nav-item grow-on-hover">
                <div  class="accordion rounded" id="accordionRequests">
                    <div class="accordion-item border-0">
                    
                        <button style="padding-left: 5px !important" class="accordion-button collapsed {{Route::is('incoming.request','outgoing.request') ? 'bg-selected' : ''}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            <div class="row g-0  w-100">
                                <div class="col-3 text-center">
                                    <img src="{{asset('icons/envelope.svg')}}" alt="">
                                </div>
                                <div class="col-9 ">
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

    </div>
