<div class="row">

    <!-- Placeholder to prevent overlapping -->
    <div class="d-none d-md-block" style="width: 20%;">
        <span class="placeholder"></span>
    </div>
    <!-- Placeholder to prevent overlapping -->

    <!-- NAVBAR -->
    <div class="   d-none  d-md-block  position-fixed h-100 " style="background-color: #ffffff; width: 20%;">
        <div class="row d-flex   py-3">
            <a href="#">
                <img class="img-fluid ps-2 pt-2" src="{{asset('assets/bu-provident.svg')}}" alt="" style="width: 14rem;">
            </a>
        </div>


        <ul class="nav flex-column" style="margin-bottom: 0; scale: 0.9;" >

            <li class="nav-items py-3 grow-on-hover ">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="icon" src="{{asset('icons/profile-holder.png')}}" alt="">
                    </div>
                    <div class="col  d-flex align-items-center">
                        <span class="fw-bold fs-7 text-secondary">Profile</span>
                    </div>
                </div>
            </li>
            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img src="{{asset('icons/home.svg')}}" alt="">
                    </div>
                    <div class="col ">
                        <span class="fw-bold fs-7 text-secondary">Home</span>
                    </div>
                </div>
            </li>

            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <i class="ps-1 fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                    </div>
                    <div class="col ">
                        <span class="fw-bold fs-7  text-secondary">Loans</span>
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

            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1" src="{{asset('icons/envelope.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class="fw-bold fs-7 text-secondary">Requests</span>
                    </div>
                </div>
            </li>

        </ul>

    </div>
