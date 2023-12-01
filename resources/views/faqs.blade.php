@extends('home-components.home-layout')

@section('content')
<div class="text-center d-none d-md-block my-5">
    <img src="{{asset('assets/faqs.svg')}}" alt="Frequently Asked Questions" width="420">
</div>
<section class="faq" style="height: 95vh">
    <div class="container mt-5">
        <div class="d-flex justify-content-center align-items-center">
            <div style="width: 80%; min-width: 250px; color: #00638D;" class="text-center fs-3 fw-bold to-minimize-font">
                Explore our BUPF Frequently Asked Questions: Your quick guide to common queries
            </div>
        </div>
        <div class="faq-container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-md-6">
                    <div class="accordion-wrapper">
                        <div class="accordion reveal fade-left active">
                            <input type="radio" name="radio-a" id="check1" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check1">
                                <div style="width: 90%;">
                                    How much is the Initial Payment for Membership?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>The membership fee cost ₱ 300.00 for teaching staff and ₱ 100.00 for non-teaching staff, you can either choose to pay the membership fee through salary deduction or make a cash payment.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left active">
                            <input type="radio" name="radio-a" id="check2" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check2">
                                <div style="width: 90%;">
                                    What are the requirements to apply as a member
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Submit the fully accomplished membership form and pay the initial payment for membership.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-left active">
                            <input type="radio" name="radio-a" id="check3" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check3">
                                <div style="width: 90%">
                                    Who can apply for a loan?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Only active members of BUPF with  capacity to pay are eligible to apply for a loan.</p>
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
                                <p>A co-borrower is an individual who shares equal responsibility with the primary borrower for repaying a loan and is typically equally liable for the debt.</p>
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
                                <p> The interest rate represents the percentage of the loan amount that a borrower pays in addition to the principal as the cost of borrowing.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="accordion-wrapper">
                        <div class="accordion reveal fade-right active">
                            <input type="radio" name="radio-a" id="check6" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check6">
                                <div style="width:90%;">
                                    What is Additional Loan?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>An additional loan is an extra borrowing obtained on top of an existing loan to address increased financial needs or unforeseen expenses.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right active">
                            <input type="radio" name="radio-a" id="check7" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check7">
                                <div style="width: 90%;">
                                    Is there a service fee or any other deduction from the loan proceeds?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>
                                    Yes,  1% service fee applicable only to Housing Loan.
                                </p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right active">
                            <input type="radio" name="radio-a" id="check8" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check8">
                                <div style="width: 90%;">
                                    How do I pay the monthly amortization of my dept?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>An additional loan is an extra borrowing obtained on top of an existing loan to address increased financial needs or unforeseen expenses.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check9" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check9">
                                <div style="width: 90%;">
                                    Can I temporarily terminate my membership?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Yes, if you withdraw all your personal contributions and dividends will automatically considered inactive.</p>
                            </div>
                        </div>
                        <div class="accordion reveal fade-right">
                            <input type="radio" name="radio-a" id="check10" style="position: absolute; opacity: 0; z-index: -1;">
                            <label class="accordion-label" for="check10">
                                <div style="width: 90%;">
                                    Can a member with a loan balance in BUPF make a withdrawal?
                                </div>
                            </label>
                            <div class="accordion-content">
                                <p>Yes, if you withdraw all your personal contributions and dividends will automatically considered inactive.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('home-components.contact')
@endsection
