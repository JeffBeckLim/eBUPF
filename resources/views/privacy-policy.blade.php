@extends('home-components.home-layout')

@section('content')

<div class="container my-5">
    <img src="{{asset('assets/privacy-policy.svg')}}" alt="Terms and Conditions" style="width: 23%; min-width: 200px;">
    <div>
        <p class="fs-6 mt-4">
            This Privacy Policy describes how eBUPF collect, use, store, maintain, and share the personal information of user of this website <a href="/">www.ebupf.com</a> (Site).
        </p>
        <p class="text-muted fs-6" style="border-bottom: 1px solid rgb(184, 184, 184);">
            Last Updated: November 21, 2023
        </p>

        <h5 class="fw-bold mt-5">1. What We Collect</h5>
        <div style="margin-left: 20px;">
            <p class="fw-6">We obtain information about you as follows:</p>
            <p class="fs-6">
                <span class="fw-bold">1.1</span> We collect your full name, address, phone number, email address as well as other information that you provide directly on our website.
            </p>
            <p class="fs-6">
                <span class="fw-bold">1.2</span> We automatically record information about you and your device such as when visiting our website, we record your operating system type, browser type, browser language, the website you visited before browsing our website, the pages you visited, the time you spend on one page and another.
            </p>
            <p class="fs-6">
                <span class="fw-bold">1.3</span> We may register information with cookies. Cookies are small data files that are stored on your hard drive by a website.
            </p>
            <p class="fs-6">
                <span class="fw-bold">1.4</span> We may use Session Cookies which expire after you close your web browser and Persistent Cookies which remain on your computer until you delete them to provide a more personalized and interactive experience on our website.
            </p>
        </div>

        <h5 class="fw-bold mt-5">2. Use of Personal Information</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">We use your personal as follows:</p>
            <p class="fs-6">
                <span class="fw-bold">2.1</span> We use your personal information to operate, maintain and improve our website and services.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.2</span> We use you personal information to respond to comments and questions and provide customer service.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.3</span> We use your personal information to send information, including confirmation, technical notices, updates and security alerts.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.4</span> We use your personal information to link or combine user information with other personal information.
            </p>
            <p class="fs-6">
                <span class="fw-bold">2.5</span> We use your personal information to protect, investigate and prevent fraudulent, unauthorized access or illegal activities.
            </p>
        </div>

        <h5 class="fw-bold mt-5">3. User Responsibilities</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">3.1</span> We may share personal information to comply with the Law.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.2</span> We share information in response to legal requests and legal processes.
            </p>
            <p class="fs-6">
                <span class="fw-bold">3.3</span> We share information in an emergency, including protecting the safety of the employee and the member of the organization.
            </p>
        </div>

        <h5 class="fw-bold mt-5">4. User Rights</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">You may change or delete your information as follows:</p>
            <p class="fs-6">
                <span class="fw-bold">4.1</span>  You may delete or refuse cookies from our Website using your browser settings.
            </p>
            <p class="fs-6">
                <span class="fw-bold">4.2</span> Most browsers are initially set to accept cookies, but you can change these in the settings.
            </p>
        </div>

        <h5 class="fw-bold mt-5">5. Changes to Privacy Policy</h5>
        <div style="margin-left: 20px;">
            <p class="fs-6">
                <span class="fw-bold">5.1</span>  We may modify this Privacy Policy without prior notice. In the event of any changes, we will promptly update the last update date.
            </p>
        </div>

    </div>
</div>

@include('home-components.contact')

@endsection
