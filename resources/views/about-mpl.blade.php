@extends('home-components.home-layout')

@section('content')

<div class="container">
    <div class="text-center mt-4 mb-4">
        <img src="{{asset('assets/about-mpl.svg')}}" alt="MPL" width="300px">
    </div>
    <div class="row mb-5">
        <div class="col-md-5 text-center">
            <img src="{{asset('assets/girl-mpl.svg')}}" alt="Multi-Purpose loan asset" style="min-width: 300px; width: 70%;">
        </div>
        <div class="col-md-7 d-flex justify-content-center align-items-center">
            <p style="font-size: 1.4rem;">
                Your gateway to achieving your financial goals and dreams. The financial solution is designed to meet all your diverse needs and aspirations, offering flexible terms, competitive interest rates, and a streamlined application process for covering medical expenses, renovating your home, or consolidating existing debts.
            </p>
        </div>
    </div>
    <div class="mb-5 p-2" style="background-color: #0092D1; border-radius: 20px;">
        <div class="row my-3">
            <div class="col-md-4" style="border-right: 2px dashed rgba(255, 255, 255, 0.812);" class="remove-border">
                <div class="text-center">
                    <div class="fs-5 text-light fw-bold text-md-center">
                        Interest Rate
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        Enjoy 6% interest rate up to 5 years, ensuring that your financial needs are met with a cost-effective and convenient solution.
                    </div>
                </div>
            </div>
            <div class="col-md-4"  style="border-right: 2px dashed rgba(255, 255, 255, 0.812);" class="remove-border">
                <div class="text-center">
                    <div class="fs-5 text-light fw-bold text-md-center" >
                        Loan Amount Range
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        Borrow up to ₱50,000 to ₱200,000, providing the financial support you need to turn aspirations into reality.
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="remove-border">
                    <div class="fs-5 text-light fw-bold text-md-center" >
                        Fees
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        Our multipurpose loan comes with zero fees for processing your loan application.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h1 class="fs-5 fw-bold" style="color: #00638D;">
            Begin your Online Application Process with these Simple Steps:
        </h1>
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
                            Login to your account
                        </span>
                        <p class="fs-7 mt-3">
                            Upon successful login, complete the application form and request to an existing member to become as your co-borrower.
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
                            Download & Print
                        </span>
                        <p class="fs-7 mt-3">
                            After successfully completing the application form , download and print the document.
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
                            Sign & Submit
                        </span>
                        <p class="fs-7 mt-3">
                            Proceed to sign the printed document, as both your signature and  your co-borrower are required.  Upon completion, submit the application form with the other requirements to the BUPF office.
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
                            Wait for Approval
                        </span>
                        <p class="fs-7 mt-3">
                            Monitor your application status in the system, upon approval the system will inform you of the scheduled date for releasing your check.
                        </p>
                    </div>
                </div>
            </li>

        </ul>
    </div>

    <div class="text-center mt-5" style="margin-bottom: 40px;">
        <p class="fs-3 fw-bold" style="color: #00638D;">Loan Application Requirements </p>
        <div class="d-flex justify-content-center align-items-center">
            <p class="fs-5" style="width: 80%">
                Unlock your financial aspirations today with eBUPF – take the first step towards your goals by applying for a loan and securing the resources you need for a brighter tomorrow.
            </p>
        </div>

    </div>

    <div class="row mb-5">
        <div class="col-md-6 text-light pb-4" style="background-color: #0082BA; border-radius: 10px; position: relative;">
            <img src="{{asset('assets/orange-tag.svg')}}" alt="Tag" class="orange-tag">
            <div class="fw-bold fs-6" style="margin: 30px 50px 0 30px;">
                Two (2) Sets of Application Forms Filled out and Signed By:
            </div>
            <div style="margin: 20px 50px 0 30px;">
                <div class="d-flex" style="margin-top: -15px;">
                    <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                    <p class="mt-3 fs-6">Principal Borrower ( Member of BU Provident Fund )</p>
                </div>
                <div class="d-flex" style="margin-top: -15px;">
                    <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                    <p class="mt-3 fs-6">Co-borrower ( Member of BU Provident Fund )</p>
                </div>
                <div class="d-flex" style="margin-top: -15px;">
                    <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                    <p class="mt-3 fs-6">2 Witnesses ( Member of BU Provident Fund )</p>
                </div>
                <div class="fs-6 fw-bold mt-2" style="text-align:justify;">
                    Under Acknowledgement, Indicate the Name of the Principal Borrower & Co-borrower and provide BU ID No. Under CTO No.
                </div>
                <div class="mt-2 mb-3 fs-6">
                    Attachment of Latest Payslip:
                </div>
                <div class="d-flex" style="margin-top: -15px;">
                    <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                    <p class="mt-3 fs-6">Principal Borrower</p>
                </div>
                <div class="d-flex" style="margin-top: -15px;">
                    <img src="{{asset('assets/tick-box.svg')}}" alt="Check" width="30px">
                    <p class="mt-3 fs-6">Co-Borrower</p>
                </div>
                <div class="fw-bold fs-6 mb-4">
                    BU ID# of Principal Borrower and Co-borrower
                </div>
                <div class="reveal fade-left">
                    <a href="/login" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Apply Loan <i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/mpl-girl-dress.svg')}}" alt="Bicol University Multi-Purpose Loan" width="60%" class="d-none d-md-block" style="min-height: 100%; min-width: 200px">
        </div>
    </div>

    <section class="faq mt-5" style="height: 95vh">
        <div class="container mt-5">
            <div class="text-center fs-4 fw-bold" style="color: #00638D;">
                Frequently Asked Questions
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h1 style="width: 60%; min-width: 250px" class="text-center fs-2 fw-bold">
                    Explore Our Top FAQs: Your Common Question Answered!
                </h1>
            </div>
            <div class="faq-container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="accordion-wrapper">
                            <div class="accordion reveal fade-left">
                                <input type="radio" name="radio-a" id="check1" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check1">
                                    <div style="width: 90%;">
                                        I am new member, can I apply for loan?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Yes, all new members can now apply for a loan. The loanable amount depends on the value of their Member’s Equity, years of service in BU, and the amount of their net pay.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-left">
                                <input type="radio" name="radio-a" id="check2" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check2">
                                    <div style="width: 90%;">
                                        What is Loan Renewal?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Loan renewal is the extension or continuation of an existing loan agreement, typically following the repayment of the initial loan term.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-left">
                                <input type="radio" name="radio-a" id="check3" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check3">
                                    <div style="width: 90%">
                                        What are the requirements for Additional Loan?

                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Approval of letter request  and a recent copy of payslip</p>

                                </div>
                            </div>
                            <div class="accordion reveal fade-left">
                                <input type="radio" name="radio-a" id="check4" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check4">
                                    <div style="width: 90%;">
                                        How can I qualify for Loan Renewal?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Payment of at least 50% of your total loan balance is required; if you do not meet the eligibility criteria, they will provide information on when you can qualify or suggest paying the necessary minimum amount for eligibility.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-left">
                                <input type="radio" name="radio-a" id="check5" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check5">
                                    <div style="width: 90%;">
                                        Can I apply for loan renewal if I am nearing retirement?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Yes, but the years left in service will be a factor to consider in assessing the loanable amount and term of payment that can be availed by the borrower.</p>
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
                                        What is Additional Loan?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Additional loan refers to obtaining supplementary funds, either as an extension of an existing loan or as a separate borrowing, to meet additional financial needs.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-right">
                                <input type="radio" name="radio-a" id="check7" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check7">
                                    <div style="width: 90%;">
                                        Who can apply for loan renewal?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>Members with an existing loan in the provident fund,  paid half (50%) of the outstanding balance of the loan.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-right">
                                <input type="radio" name="radio-a" id="check8" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check8">
                                    <div style="width: 90%;">
                                        What is Amortization
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>The amount of principal and interest paid over the  course of the loan term.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-right">
                                <input type="radio" name="radio-a" id="check9" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check9">
                                    <div style="width: 90%;">
                                        What is a Co-borrower
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>A co-borrower is an individual who shares equal responsibility with the primary borrower for repaying a loan and is typically equally liable for the debt.</p>
                                </div>
                            </div>
                            <div class="accordion reveal fade-right">
                                <input type="radio" name="radio-a" id="check10" style="position: absolute; opacity: 0; z-index: -1;">
                                <label class="accordion-label" for="check10">
                                    <div style="width: 90%;">
                                        What happens if the remaining term for loan repayment is higher than the remaining service at BU before retirement?
                                    </div>
                                </label>
                                <div class="accordion-content">
                                    <p>The balance, including any interest and surcharge if applicable, will be deducted from the benefit claim (equity) to be received.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('home-components.contact')

</div>
@endsection
