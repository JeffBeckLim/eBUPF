@extends('home-components.home-layout')

@section('content')

<div class="container my-5">
    <img src="{{asset('assets/terms-and-conditions.svg')}}" alt="Terms and Conditions" style="width: 35%; min-width: 300px;">
    <div>
        <p class="fs-6 mt-4">
            By signing up for eBUPF, you agree to the Terms of Use below, here in after referred to as the Terms and Conditions. Please read these Terms and Conditions carefully. If you do not accept these Terms and Conditions, please do not access or use the application.
        </p>
        <p class="text-muted fs-6" style="border-bottom: 1px solid rgb(184, 184, 184);">
            Last Updated: November 21, 2023
        </p>

        <h5 class="fw-bold mt-5">1. General Information</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">1.1</span> Before using the application, the User must carefully read and understand the Terms and Conditions.
            </p>
            <p class="fs-6">
                <span class="fw-bold">1.2</span> By providing personal information to the application, the User agrees to accept the Terms and Conditions. If the User does not agrees to the Terms and Conditions, the User shall not use the application.
            </p>
            <p class="fs-6">
                <span class="fw-bold">1.3</span> The eBUPF reserves the right to change or amend these Terms and Conditions at any time without prior notice to the User.
            </p>
        </div>

        <h5 class="fw-bold mt-5">2. Processing of Personal Data</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">2.1</span> To provide personal information on the application, it is necessary to enter User’s personal data. By accepting the Terms and Conditions, the User confirms the request of processing of his personal data in order to complete the membership form, loan application form, and insurance form.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.2</span> The Co-borrower(User) confirms his consent to transfer his personal data at the request of the User so that the User can process his loan application.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.3</span> The User is hereby informed that eBUPF retains and maintains the collection of personal data within it’s database.
            </p>
        </div>

        <h5 class="fw-bold mt-5">3. User Responsibilities</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">3.1</span> The User is obliged to answer questions on the application in order to use the service.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.2</span> The User is obliged not to share his account with a third party.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.3</span> The User suspects that his account is compromised by a third party, the User must immediately notify the eBUPF staff by sending an email to ebupf.lms@bicol-u.edu.ph.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.4</span> Before applying for membership and loan, the User has confirmed that he or she has read and understood the eBUPF’s Terms and Condition and Privacy Policy.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.5</span>  The User’s data will be deleted upon the User’s request by contacting eBUPF.
            </p>
        </div>

        <h5 class="fw-bold mt-5">4. User Rights</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">4.1</span> The User has the right to use the services of the application for free.
            </p>
        </div>

        <h5 class="fw-bold mt-5">5. Limitation of Liability</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">5.1</span> The eBUPF is not responsible for the user’s choice to receive a loan or the term of the selected loan type.
            </p>
            <p class="fs-6">
                <span class="fw-bold">5.2</span> The eBUPF shall not be liable for any damage arising from the following situation: user’s equipment malfunction, use of inappropriate or unlicensed equipment or software, power failures or other related incidents.
            </p>
        </div>

        <h5 class="fw-bold mt-5">6. Privacy Terms</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">6.1</span> All user data entered into the eBUPF will be processed in accordance with the organization’s Privacy Policy.
            </p>
            <p class="fs-6">
                <span class="fw-bold">6.2</span> We will not provide your personal data to any party unless that party agrees to or complies with terms that mandate a level of personal data protection equivalent to the standards required by the Personal Data (Privacy) Regulation.
            </p>
        </div>

        <h5 class="fw-bold mt-5">7. Intellectual Property Rights</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">7.1</span> Users are prohibited from using services or products for any unintended purpose, including entering false information in the application.
            </p>
        </div>
    </div>
</div>

@include('home-components.contact')

@endsection
