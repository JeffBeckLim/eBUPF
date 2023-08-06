@extends('home-components.home-layout')

@section('content')
    <section class="container" id="home">

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row pt-lg-2 mb-5 ">

            {{-- MEMBERSHIP CARD --}}
            @if (Auth::user() && Auth::user()->user_type === 'non-member')
            <div class="col-12 ">
                @include('home-components.membership-card')
            </div>                
            @endif
            {{-- MEMBERSHIP CARD --}}

            <div class=" col-lg-6 d-flex justify-content-start align-items-center pt-2 pb-5" style=" margin-top: 15px;">
                <div id="bluebox-content" style="height: 100%; width: 550px; background-color: #0082BA; border-radius: 10px;position: relative;">
                    <h4 class="text5-design" style="font-size: clamp(1.25rem, 1.0357rem + 0.7619vw, 1.75rem);">Bicol University</h4>
                    <h1 class="text5-design" style="margin-top: -10px; font-size: clamp(1.875rem, 1.7143rem + 0.5714vw, 2.25rem);">Provident Fund Inc.</h1>
                    <img class="orange-tag" src="assets/orange-tag.png" alt="tag" width="60px">
                    <div class="row pt-4">
                        <div class="col-2">
                            <i class="bi bi-cash-stack icon1"></i>
                        </div>
                        <div class="col-10">
                            <p class="text6-design pb-2"> Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna. Duis non diam non diam consequat ultrices.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <i class="bi bi-check-all icon1"></i>
                        </div>
                        <div class="col-10">
                            <p class="text6-design pb-2"> Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna. Duis non diam non diam consequat ultrices.</p>
                        </div>
                    </div>
                    @if(!Auth::user())
                    <div class="row  g-0">
                        <div class="col d-flex  justify-content-end">
                            <a class="button grow-on-hover my-auto mx-0 me-3" href="/register" type="button">Sign Up</a>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center pt-2 pb-5" style=" margin-top: 35px;">
                <div style="height: 425px; width: 100%; border-radius: 10px;">
                    <div>
                        <img src="assets/home-art.svg" alt="picture" width="100%" height="350px">
                    </div>
                    <p class="text7-design"> Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna. Duis non diam non diam consequat ultrices.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="core-feature" class="mb-5 pt-lg-5 border " style="background-image: url({{asset('assets/core-feature-bg.png')}})">
        <div id="core-feature-container" class="container justify-content-center border-top border-light">
            <h6 class="text-center text-light mt-1">Core Features</h6>
            <div class="row mt-4 mb-sm-5 d-flex justify-content-center align-items-center">
                <div class="col-md-3 d-flex align-items-center">
                    <i class="bi bi-person-lines-fill icon2 d-flex "></i>
                    <p class="text8-design">Fill up Membership Form</p>
                </div>
                <div class="col-md-3 d-flex align-items-center ">
                    <i class="bi bi-file-text icon2 d-flex"></i>
                    <p class="text8-design">Easily Fill-up Loan Application Form</p>
                </div>
                <div class="col-md-3 d-flex align-items-center ">
                    <i class="bi bi-check-lg icon2 d-flex "></i>
                    <p class="text8-design">Know when your Check is Ready</p>
                </div>
                <div class="col-md-3 d-flex align-items-center  ">
                    <i class="bi bi-phone icon2  d-flex"></i>
                    <p class="text8-design">Track Your Loans</p>
                </div>
            </div>
        </div>
    </section>


    <section id="offer">
        <div class="container">
            <p class="text-center fw-bold fs-5">Apply a loan</p>
            <div class="mb-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-5 card-border pb-4" style="border: 2px solid #0082BA">
                        {{-- <img class="orange-tag" src="assets/blue-tag.png" alt="tag" width="40px" height="45px"> --}}
                        <p class="mt-4 ml-2 text10-design">Housing Loan</p>
                        <p class="ml-3 mr-1 text9-design">Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna.</p>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 card-border card-border2 pb-4" style="border: 2px solid #FF6F19">
                        {{-- <img class="orange-tag" src="assets/orange-tag.png" alt="tag" width="40px" height="45px"> --}}
                        <p class="mt-4 ml-2 text10-design">Multi-Purpose Loan</p>
                        <p class="ml-3 mr-1 text9-design">Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna.</p>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold"></i>
                            </div>
                            <div class="col-11 pl-4">
                                Nam quis sapien vel massa commodo consectetur vel nec urna.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
@endsection
