@extends('home-components.home-layout')

@section('content')
<section class="landing-page" style="position: relative;">
    {{-- MEMBERSHIP CARD --}}
    <div class="membership-card-container d-flex justify-content-center align-items-center" style="position: absolute; top: 25%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 100%; filter: drop-shadow(30px 30px 7px rgba(0, 0, 0, 0.25));">
        @if (Auth::user() && Auth::user()->user_type === 'non-member')
            <div style="width: 80%;">
                @include('home-components.membership-card')
            </div>
        @endif
    </div>

    <div style="height: 90vh;">
        <div style="background-image: url('{{ asset('assets/home-blue-bg.svg') }}'); background-size: cover; background-position: center; height: 85%;" class="home-blue-bg">
            <div class="container home-landing-page">
                <div class="row">
                    <div class="col-md-6 text-light d-flex justify-content-center align-items-center pb-5">
                        <div>
                            <div class="fs-1 fw-semibold" style="line-height: 1.2;">
                                Find the Perfect <span style="color: rgb(255, 131, 29)">Loan</span> <br> for your needs
                            </div>
                            <div class="fs-5 mt-3 landing-info-text" style="padding-right: 20px;">
                                Welcome to eBUPF, your trusted resource for financial services.
                            </div>
                            <div class="mt-4 reveal fade-left active">
                                <a href="/login" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Get Started <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center d-none d-md-block">
                        <img src="{{ asset('assets/home-computer.svg') }}" alt="Human" class="amico" style="min-width: 80%; max-width: 95%; height: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="core-feature" class="mb-5 pt-lg-3 border p-3" style="background-image: url({{asset('assets/core-feature.svg')}})">
    <div id="core-feature-container" class="container justify-content-center border-top border-light mt-2">
        <h6 class="text-center text-light mt-2 fw-bold">Core Features</h6>
        <div class="row mt-4 mb-sm-5 d-flex justify-content-center align-items-center">
            <div class="col-md-3 d-flex align-items-center reveal fade-bottom">
                <i class="bi bi-person-lines-fill icon2 d-flex "></i>
                <p class="text8-design">Fill up Membership Form</p>
            </div>
            <div class="col-md-3 d-flex align-items-center reveal fade-bottom">
                <i class="bi bi-file-text icon2 d-flex"></i>
                <p class="text8-design">Easily Fill-up Loan Application Form</p>
            </div>
            <div class="col-md-3 d-flex align-items-center reveal fade-bottom">
                <i class="bi bi-check-lg icon2 d-flex "></i>
                <p class="text8-design">Know when your Check is Ready</p>
            </div>
            <div class="col-md-3 d-flex align-items-center reveal fade-bottom">
                <i class="bi bi-phone icon2  d-flex"></i>
                <p class="text8-design">Track Your Loans</p>
            </div>
        </div>
    </div>
</section>

<section>

</section>


<div class="my-5">

    {{-- MEMBERSHIP CARD --}}
{{--     <div class="border border-danger">
        <h5 class="text-center text-danger">TEMPORARY DIV - REMOVE AFTER DEVELOPMENT</h5>
        <h6>LOGIN TO DEVELOPER ACCOUNT</h6>
        <h6>email: developer@ebupf.com</h6>
        <h6>password: qwerty123</h6>
        <h5 class="text-center text-danger">TEMPORARY DIV - REMOVE AFTER DEVELOPMENT</h5>
    </div> --}}

    <div class="border border-danger">
        <div class="fs-4 text-center text-danger">TEMPORARY DIV - REMOVE AFTER DEVELOPMENT</div>
        <div class="fs-5 text-center text-danger">LOGIN TO DEVELOPER ACCOUNT</div>
        <div class="fs-5 text-center text-danger">email:
            <span class="text-dark">
                developer@ebupf.com
            </span>
        </div>
        <div class="fs-5 text-center text-danger">password:
            <span class="text-dark">
                qwerty123
            </span>
        </div>
    </div>
</div>

<script>
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);
</script>

@endsection
