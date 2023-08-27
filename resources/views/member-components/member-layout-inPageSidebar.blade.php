<div class="row">

    <!-- Placeholder to prevent overlapping -->
    <div class="d-none d-md-block" style="width: 20%;">
        <span class="placeholder"></span>
    </div>
    <!-- Placeholder to prevent overlapping -->

    <!-- NAVBAR -->
    <div class="   d-none  d-md-block  position-fixed h-100 " style="background-color: #ffffff; width: 20%;">
        <div class="row d-flex   py-3">
            <a href="{{route('home')}}">
                <img class="img-fluid ps-2 pt-2" src="{{asset('assets/bu-provident.svg')}}" alt="" style="width: 14rem;">
            </a>
        </div>


        <ul class="nav flex-column" style="margin-bottom: 0; scale: 0.9;" >

            <li class="nav-items py-3 grow-on-hover ">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="icon" src="{{ asset('storage/' . Auth::user()->member->profile_picture)}}" alt="icon">
                    </div>
                    <div class="col  d-flex align-items-center">
                        <a href="{{ route('member.profile', ['id' => Auth::user()->member->id]) }}" style="text-decoration: none; width: 100%;" class="text-secondary"><span class="fw-bold fs-7">{{ Auth::user()->member->firstname }} {{ Auth::user()->member->lastname }}</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img src="{{asset('icons/home.svg')}}" alt="">
                    </div>
                    <div class="col d-flex">
                        <a href="{{ route('home') }}" style="text-decoration: none; width: 100%;" class="text-secondary"><span class="fw-bold fs-7">Home</span></a>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <i class="ps-1 fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                    </div>
                    <div class="col ">
                        <span class="fw-bold fs-7  text-secondary">Loans</span>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item grow-on-hover">
                <div class="accordion rounded" id="accordionRequests">
                    <div class="accordion-item border-0">
                      <h5 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoans" aria-expanded="false" aria-controls="collapseLoans">
                            <div class="row g-0">
                                <div class="col-3 text-center ps-1">
                                    <i class="ps-1 fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                                </div>
                                <div class="col-9 ps-2">
                                    <span class="fw-bold fs-7 text-secondary ps-3">Loans</span>
                                </div>
                            </div>
                        </button>
                      </h5>
                      <div id="collapseLoans" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="">Multi Purpose</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="">Housing</a>
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

            {{-- <a class="text-decoration-none" href="/member/coBorrwer/requests/"> --}}
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
            {{-- </a> --}}

            {{-- <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1" src="{{asset('icons/envelope.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class="fw-bold fs-7 text-secondary">Requests</span>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item grow-on-hover">
                <div class="accordion rounded" id="accordionRequests">
                    <div class="accordion-item border-0">
                      <h5 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            <div class="row g-0">
                                <div class="col-3 text-center ">
                                    <img class="pe-5 ms-1" src="{{asset('icons/envelope.svg')}}" alt="">
                                </div>
                                <div class="col-9 ps-2">
                                    <span class="fw-bold fs-7 text-secondary">Requests</span>
                                </div>
                            </div>
                        </button>
                      </h5>
                      <div id="collapseRequests" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="/member/Your/coBorrwer/requests/">Your Requests</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="/member/coBorrwer/requests/">Incoming Requests</a>
                                </div>

                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>

        </ul>

    </div>
