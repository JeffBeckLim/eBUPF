@extends('home-components.home-layout')

@section('content')
<div class="container">
    <h1 class="fs-3 my-5" style="width: 50%; min-width: 300px; color: #00638D;">
        Begin your Membership Application Process with these Simple Steps:
    </h1>

    <div class="mb-5">
        <ul class="timeline timeline-vertical" style="margin-top: 60px;">
            <li>
                <span class="timeline--date reveal fade-left">Step 1</span>
                <div class="timeline--circle">
                    <i>
                    </i>
                </div>
                <div class="timeline--description">
                    <div style="border-radius: 25px; background: rgba(217, 217, 217, 0.26);padding: 25px 30px 10px 30px;">
                        <span class="fs-6 fw-bold" style="color: #FF6F18;">
                            Create Account
                        </span>
                        <p class="fs-7 mt-3">
                            Register in the system, and a confirmation email will be sent to your BU email account, once you confirm your identity, proceed to log in to the system.
                        </p>
                    </div>

                </div>
            </li>

            <li>
                <span class="timeline--date reveal fade-left">Step 2</span>
                    <div class="timeline--circle">        <i></i>
                </div>
                <div class="timeline--description">
                    <div style="border-radius: 25px; background: rgba(217, 217, 217, 0.26);padding: 25px 30px 10px 30px;">
                        <span class="fs-6 fw-bold" style="color: #FF6F18;">
                            Accomplish Membership Form
                        </span>
                        <p class="fs-7 mt-3">
                            Fill out  the membership application form by providing the required details.
                        </p>
                    </div>
                </div>
            </li>

            <li>
                <span class="timeline--date reveal fade-left">Step 3</span>
                <div class="timeline--circle">        <i></i>
                </div>
                <div class="timeline--description">
                    <div style="border-radius: 25px; background: rgba(217, 217, 217, 0.26);padding: 25px 30px 10px 30px;">
                        <span class="fs-6 fw-bold" style="color: #FF6F18;">
                            Download & Print
                        </span>
                        <p class="fs-7 mt-3">
                            Upon completion, download and print the application form.
                        </p>
                    </div>
                </div>
            </li>

            <li>
                <span class="timeline--date reveal fade-left">Step 4</span>
                <div class="timeline--circle">        <i></i>
                </div>
                <div class="timeline--description">
                    <div style="border-radius: 25px; background: rgba(217, 217, 217, 0.26);padding: 25px 30px 10px 30px;">
                        <span class="fs-6 fw-bold" style="color: #FF6F18;">
                            Sign & Submit
                        </span>
                        <p class="fs-7 mt-3">
                            Proceed to sign the printed document and upon completion, submit the application form along with the other requirements to the BUPF office.
                        </p>
                    </div>
                </div>
            </li>

            <li>
                <span class="timeline--date reveal fade-left">Step 5</span>
                <div class="timeline--circle">        <i></i>
                </div>
                <div class="timeline--description">
                    <div style="border-radius: 25px; background: rgba(217, 217, 217, 0.26);padding: 25px 30px 10px 30px;">
                        <span class="fs-6 fw-bold" style="color: #FF6F18;">
                            Wait for Approval
                        </span>
                        <p class="fs-7 mt-3">
                            Following the submission of the application form, wait for approval from the BUPF staff. Notification of an approved application will be delivered to you via email or text message.
                        </p>
                    </div>
                </div>
            </li>

        </ul>
    </div>

    <h1 style="color: #00638D; width: 100%; padding-top: 20px;" class="text-center fs-3">
        Membership Application Requirements
    </h1>
    <div class="w-100 text-center d-flex justify-content-center align-items-center">
        <p style="width: 80%; text-align: center;" class="fs-5">
            Experience the full potential of our platform by becoming a member today, and enjoy access to a host of exclusive features and resources, by  providing the specified requirements.
        </p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 text-light pb-4" style="background-color: #0082BA; border-radius: 10px; position: relative;">
            <img src="{{asset('assets/orange-tag.svg')}}" alt="Tag" class="orange-tag">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div>
                    <div class="d-flex" style="margin-top: -15px;">
                        <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                        <p class="mt-3 fs-5">Fully Accomplished Membership Form</p>
                    </div>

                    <div class="fs-3 fw-bold mt-2 mb-3">
                        Initial Payment for Membership:
                    </div>

                    <div class="d-flex" style="margin-top: -15px;">
                        <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                        <p class="mt-3 fs-5">₱300.00 for Teaching Staff</p>
                    </div>
                    <div class="d-flex" style="margin-top: -15px;">
                        <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                        <p class="mt-3 fs-5">₱100.00 for Non-teaching Staff</p>
                    </div>
                    <div class="reveal fade-left mt-3">
                        <a href="/login" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Apply <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/mpl-girl-dress.svg')}}" alt="Bicol University Multi-Purpose Loan" width="60%" class="d-none d-md-block" style="min-height: 100%; min-width: 200px">
        </div>
    </div>

    @include('home-components.contact')
</div>
@endsection
