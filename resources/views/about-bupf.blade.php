@extends('home-components.home-layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="fw-bold my-4 fs-1" style="color: #00638D;">
                        Discover more about our Organization
                    </h1>
                    <div style="border-bottom: 2px solid black;text-align:justify;" class="fs-6 pb-3">
                        Bicol University Provident Fund Inc. is a reputable financial institution dedicated to empowering the Bicol University Faculty Members and with their financial goals. With a steadfast commitment, they offer a comprehensive range of financial solutions, prominently featuring multipurpose and housing loans. With a customer-centric approach, they provide accessible and flexible loan options, ensuring that dreams of homeownership, education, and other financial aspirations become a reality. Bicol University Provident Fund Inc. stands as a trusted partner in the journey towards financial stability and prosperity.
                    </div>
                    <div class="row mt-4 reveal fade-bottom active">
                        <div class="col-6">
                            <div class="d-flex fw-bold fs-6 my-2 align-items-center">
                                <img src="{{asset('assets/check-icon.svg')}}" alt="Check Icon" width="32px"> &nbsp;
                                Mission
                            </div>
                            <div class="fs-6">
                                The Bicol University shall give professional and technical training, and provide advanced and specialized instruction in literature, philosophy, the sciences and arts, besides providing for the promotion of scientific and technological researches (RA 5521, Sec. 3.0).
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex fw-bold fs-6 my-2 align-items-center">
                                <img src="{{asset('assets/check-icon.svg')}}" alt="Check Icon" width="32px"> &nbsp;
                                Vision
                            </div>
                            <div class="fs-6">
                                A University for Humanity characterized by productive scholarship, transformative leadership, collaborative service, and distinctive character for sustainable societies.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5">
                    <img src="{{asset('assets/BUBG-new.png')}}" alt="Check Icon" width="100%">
                </div>
            </div>
        </div>
    </section>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/about-bupf-man.svg')}}" alt="Check Icon" width="80%">
        </div>
        <div class="col-md-6">
            <p style="color:#00638D;" class="fs-5 fw-bold">Why Choose Us</p>
            <p class="fs-4">BUPF: Your Trusted Partner for Financial Stability and Success</p>
            <div class="row">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    BUPF commits to help BU employee maximize their hard-earned salary.
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    We empower our members to invest for their future.
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    All with the goal of helping BUPF Members achieve a life of financial support.
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    Low interest rate and borrow up to ₱50,000
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    Be able to re-loan after paying a minimum of three (3) months. MPL  Amortization
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1 text-end">
                    <img src="{{asset('assets/check-icon.svg')}}" alt="check" width="32px">
                </div>
                <div class="col-11 reveal fade-right">
                    Access to BUPF Loan Products
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-5">
    <span style="color: #0092D1;" class="fs-3 fw-bold">
        BICOL
    </span>
    <span style="color: #FF6F19;" class="fs-3 fw-bold">
        UNIVERSITY
    </span>
    <div>
        <span style="color: rgb(0, 0, 0); width: 70%;" class="fs-4 fw-bold">
            Provident Fund Inc. Organizational Structure
        </span>
    </div>
    <div class="row">

    </div>
</div>

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
