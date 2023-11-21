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

    <div style="height: 90vh;" class="landing-page-height">
        <div style="background-image: url('{{ asset('assets/home-blue-bg.webp') }}'); background-size: cover; background-position: center; height: 85%;" class="home-blue-bg">
            <div class="container home-landing-page">
                <div class="row">
                    <div class="col-md-6 text-light d-flex justify-content-center align-items-center pb-5">
                        <div>
                            <h1 class="fs-1 fw-semibold" style="line-height: 1.2;">
                                Find the Perfect <span style="color: rgb(255, 131, 29)">Loan</span> <br> for your needs
                            </h1>
                            <h5 class="fs-5 mt-3 landing-info-text" style="padding-right: 20px;">
                                Welcome to eBUPF, your trusted resource for financial services.
                            </h5>
                            <div class="mt-4 reveal fade-left active {{ Auth::check() ? 'd-none' : 'active' }}">
                                <a href="/login" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Get Started <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center d-none d-md-block">
                        <img src="{{ asset('assets/home-computer.webp') }}" alt="Landing Page Character" class="amico" style="min-width: 80%; max-width: 95%; height: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="core-feature" class="mb-5 pt-lg-3 border p-3" style="background-image: url({{asset('assets/core-feature.webp')}})">
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

<section class="about-organization">
    <div class="container my-5">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <img src="{{asset('assets/freepik-characters.svg')}}" alt="Characters" width="100%">
            </div>
            <div class="col-md-6 p-4">
                <div style="color: #00638D;" class="fs-5 fw-bold pb-3">
                    Learn about our Organization
                </div>
                <div class="fs-1 fw-bold" style="line-height: 1.2;">
                    <span style="color: #0092D1;">Bicol </span>
                    <span style="color: #FF6F19;">University</span> <br>
                    <span style="color: #000;">Provident Fund Inc.</span>
                </div>
                <div class="fs-6 fw-normal py-4">
                    Discover a world of financial possibilities with Bicol University Provident Fund Inc. where every guest is a potential member on the path to securing a brighter future. Explore our offerings today and embark on your journey toward financial security!"
                </div>
                <div class="pt-2 reveal fade-bottom">
                    <a href="{{route('about-bupf')}}" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Read More <i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="why-become-a-member">
    <div class="container my-5">
        <div class="fs-2 fw-semibold mb-5" style="color: #00638D; margin-top: 100px;">
            Why Become a Member?
        </div>
        <div class="row d-flex justify-content-center align-items-center reasons-gap">
            <div class="col-md-4 reveal fade-left">
                <div class="retirement-savings content-border">
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <img src="{{asset('assets/loans-savings.svg')}}" alt="Retirement Savings" width="60px">
                    </div>
                    <div style="">
                        <div class="fs-6 fw-bold text-center">
                            Loans
                        </div>
                        <div class="fs-7 fw-normal text-center text-justify" style="padding: 0 30px 10px 30px;">
                            Take the first step towards achieving your goals by becoming a member of our financial institution with exclusive loan benefits. Join us to access a wide range of loan options tailored to your needs, offering competitive rates and flexible repayment terms. Let us be your partner in turning your aspirations into reality.                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal fade-bottom">
                <div class="retirement-savings content-border">
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <img src="{{asset('assets/retirement-savings.svg')}}" alt="Retirement Savings" width="60px">
                    </div>
                    <div style="">
                        <div class="fs-6 fw-bold text-center">
                            Retirement Savings
                        </div>
                        <div class="fs-7 fw-normal text-center text-justify" style="padding: 0 30px 10px 30px;">
                            Secure your financial future and retire with confidence – become a member today and unlock the power of retirement savings at our trusted financial institution. Join us in as we support your dreams and aspirations for a worry-free retirement. Your future starts with membership, so take the first step towards a brighter, more secure tomorrow.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal fade-right">
                <div class="retirement-savings content-border">
                    <div class="d-flex justify-content-center align-items-center my-3">
                        <img src="{{asset('assets/life-insurance.svg')}}" alt="Retirement Savings" width="60px">
                    </div>
                    <div>
                        <div class="fs-6 fw-bold text-center">
                            Life Insurance
                        </div>
                        <div class="fs-7 fw-normal text-center text-justify" style="padding: 0 30px 10px 30px;">
                            Empower yourself and ensure your peace of mind by becoming a member of our financial institution with exclusive life insurance benefits tailored for you. Join us to secure your financial future, knowing that you have a safety net in place for any unforeseen circumstances. Your membership with us signifies a commitment to your own well-being and financial security.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-to-be-part d-none d-sm-block">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center pt-5" style="margin-top: 20px;">
            <div style="width: 50%; color:#00638D;" class="fs-3 fw-semibold text-center">
                See how you can be a part of our Organization's Success
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center pt-3">
            <div class="fs-5 text-center" style="width: 80%;">
                Experience the full potential of our platform by becoming a member today, and enjoy access to a host of exclusive features and resources, by following this 5 easy steps.
            </div>
        </div>

        <div class="mt-5 timeline-div">
            <div class="timeline-1">
                <div class="timeline-line"></div>
                <div class="timeline-step">
                    <div class="timeline-content">
                        <div class="timeline-image">
                            <img src="{{asset('assets/accomplish-membership-form.svg')}}" alt="Accomplish form">
                        </div>
                        <div class="timeline-text reveal fade-bottom">Accomplish Membership Form</div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content">
                        <div class="timeline-image">
                            <img src="{{asset('assets/download-print.svg')}}" alt="Download And Print">
                        </div>
                        <div class="timeline-text reveal fade-bottom">Download and Print</div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content">
                        <div class="timeline-image">
                            <img src="{{asset('assets/sign-submit.svg')}}" alt="Sign and submit">
                        </div>
                        <div class="timeline-text reveal fade-bottom">Sign and Submit</div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content">

                        <div class="timeline-image">
                            <img src="{{asset('assets/wait-approval.svg')}}" alt="Wait for Approval">
                        </div>
                        <div class="timeline-text reveal fade-bottom">Wait for Approval</div>
                    </div>
                </div>
                <div class="timeline-step">

                    <div class="timeline-content">
                        <div class="timeline-image">
                            <img src="{{asset('assets/create-account.svg')}}" alt="create account">
                        </div>
                        <div class="timeline-text reveal fade-bottom" style="margin-top: px;">Create Account</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="plan-finance">
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-7">
                <div class="fw-bold my-4 fs-1">
                    Lets Plan your Finances right away
                </div>
                <div style="border-bottom: 4px solid black;" class="fs-5 pb-3">
                    Lending that doesn’t weigh you down. We know how hard is it to start something new, that’s why we have the perfect plan for you.
                </div>
                <div class="row mt-4">
                    <div class="col-6 reveal fade-bottom">
                        <div class="d-flex fw-bold fs-6 my-2 align-items-center">
                            <img src="{{asset('assets/MPL-mini.svg')}}" alt="Multi-Purpose Loan Mini Logo" width="30px"> &nbsp;
                            Multi-Purpose Loan
                        </div>
                        <div class="row">
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                        </div>
                        <a href="{{ route('about-mpl') }}" type="button" class="btn fw-bold more-details-btn" style="color:rgb(255, 131, 29); border: none;">More Details</a>
                    </div>
                    <div class="col-6 reveal fade-bottom">
                        <div class="d-flex fw-bold fs-6 my-2 align-items-center">
                            <img src="{{asset('assets/HSL-mini.svg')}}" alt="Housing Loan Mini Logo" width="30px"> &nbsp;
                            Housing Loan
                        </div>
                        <div class="row">
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                            <div class="col-2 text-end">
                                <i class="bi bi-check-all ml-3 fs-4 fw-bold" style="color: #00638D"></i>
                            </div>
                            <div class="col-10">
                                Horem ipsum dolor sit amet, consectetur adipiscing elit.
                            </div>
                        </div>
                        <a href="{{ route('about-hsl') }}" type="button" class="btn fw-bold more-details-btn" style="color:rgb(255, 131, 29); border: none;">More Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <img src="{{asset('assets/plan-finance-img.svg')}}" alt="Plan Finance Image" width="70%">
            </div>
        </div>
    </div>
</section>

<section class="faq" style="height: 95vh">
    <div class="container mt-5">
        <div class="text-center fs-4 fw-bold" style="color: #00638D;">
            Frequently Asked Questions
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div style="width: 60%;" class="text-center fs-2 fw-bold">
                Explore Our Top FAQs: Your Common Question Answered!
            </div>
        </div>
        <div class="faq-container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="accordion-wrapper">
                        <div class="accordion reveal fade-left">
                            <input type="radio" name="radio-a" id="check1" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check1">
                                <div style="width: 90%;">
                                    What are the requirements to apply as a member?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>I hope you are enjoying the video; don't forget to give your feedback in the comment section.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left">
                            <input type="radio" name="radio-a" id="check2" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check2">
                                <div style="width: 90%;">
                                    How much is the initial payment for membership?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>The membership fee cost  ₱ 100.00 , you can either choose to pay the membership fee through salary deduction or make a cash payment.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left">
                            <input type="radio" name="radio-a" id="check3" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check3">
                                <div style="width: 90%">
                                    Who can apply for a loan?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam harum nesciunt tenetur quas, accusantium numquam, dignissimos doloremque alias ullam debitis fugit quis modi? Rem ducimus natus nulla dicta autem vero. </p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left">
                            <input type="radio" name="radio-a" id="check4" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check4">
                                <div style="width: 90%;">
                                    What is a Co-Borrower?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem asperiores ducimus illum quas, sit dicta tenetur. Impedit dolores quisquam earum nihil enim alias, magnam velit, dolorem voluptate ex necessitatibus corporis.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left">
                            <input type="radio" name="radio-a" id="check5" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check5">
                                <div style="width: 90%;">
                                    What is Interest Rate?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eius magnam porro tempora? Inventore, consequatur dignissimos? Alias, consequuntur, aspernatur omnis ratione, eum dicta voluptatum reiciendis voluptatem rem incidunt perspiciatis ea!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="accordion-wrapper">
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check6" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check6">
                                <div style="width:90%;">
                                    What is Interest
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ex vitae illum dignissimos atque esse eligendi nemo suscipit! Ratione tenetur fuga dolores maxime repellendus repellat quia rem ad ducimus perferendis.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check7" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check7">
                                <div style="width: 90%;">
                                    What is Additional Loan?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed officiis suscipit voluptatibus harum aliquam, sunt at quod consequatur, saepe voluptas quis mollitia ducimus non itaque dignissimos commodi distinctio iusto repellat?</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check8" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check8">
                                <div style="width: 90%;">
                                    How do I pay the monthly amortization of my dept?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia debitis adipisci beatae quisquam facere reprehenderit, dolores illum veritatis recusandae repudiandae quas cumque. Doloremque quibusdam fugiat possimus distinctio quos sequi consectetur!</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check9" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check9">
                                <div style="width: 90%;">
                                    What will happen if I miss a loan payment?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis expedita deserunt vel hic provident nihil consequatur voluptate culpa, excepturi laborum sunt nam ullam nostrum magni soluta ex? Eos, ullam quos.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check10" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check10">
                                <div style="width: 90%;">
                                    Is it possible to make a partial or full payment of the loan balance?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates, odit harum nesciunt eveniet cum error aliquam culpa illo fugit nam modi nulla cupiditate minima ipsa sunt, delectus blanditiis excepturi voluptate!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="hear-from-you">
    <div class="container mb-5">
        <div style="background-color: #0092D1; border-radius: 50px;">
            <div class="row">
                <div class="col-md-7">
                    <div class="fs-1 fw-bold text-light" style="padding: 30px 0 20px 45px">
                        We'd love to hear from you.
                    </div>
                    <div style="padding: 0 0 30px 45px" class="text-light fw-6">
                        Got a query? Contact us using any of the details below and we will be happy to answer your questions!
                    </div>
                    <div style="margin: 0 0 0 100px;" class="d-flex">
                        <i class="bi bi-send-fill text-white"></i>
                        <div style="margin-left: 15px;">
                            <a href="mailto:bupf@bicol-u.edu.ph" style="color: white;">
                                bupf@bicol-u.edu.ph
                            </a>
                        </div>
                    </div>
                    <div style="margin: 20px 0 20px 100px;" class="text-white d-flex">
                        <i class="bi bi-telephone-fill"></i>
                        <div style="margin-left: 15px;">
                            (209) 555-0104
                        </div>
                    </div>
                </div>
                <div class="col-md-5 fade-right reveal mt-3">
                    <img src="{{asset('assets/girl-computer.svg')}}" alt="Computer" width="80%">
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
