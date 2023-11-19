@extends('home-components.home-layout')

@section('content')

<div class="container">
    <div class="text-center mt-5 mb-4">
        <img src="{{asset('assets/about-hsl.svg')}}" alt="MPL" width="250px">
    </div>
    <div class="row mb-5">
        <div class="col-md-5 text-center">
            <img src="{{asset('assets/man-hsl.svg')}}" alt="Multi-Purpose loan asset" style="min-width: 300px; width: 70%;">
        </div>
        <div class="col-md-7 d-flex justify-content-center align-items-center">
            <p style="font-size: 1.4rem;">
                The Bicol University Provident  Fund Multi-Purpose Loan or MPL is a cash loan designed to provide our members with any immediate financial need and supplementary benefits.
            </p>
        </div>
    </div>
    <div class="mb-5 p-2" style="background-color: #0092D1; border-radius: 20px;">
        <div class="row my-3">
            <div class="col-md-4">
                <div style="border-right: 2px dashed rgba(255, 255, 255, 0.812);" class="remove-border">
                    <div class="fs-5 text-light fw-bold text-md-center">
                        Interest Rate
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        9%
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="border-right: 2px dashed rgba(255, 255, 255, 0.812);" class="remove-border">
                    <div class="fs-5 text-light fw-bold text-md-center" >
                        Loan Amount Range
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        Php 50,000.00 - Php 200,000.00
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="remove-border">
                    <div class="fs-5 text-light fw-bold text-md-center" >
                        Fees
                    </div>
                    <div class="fs-7 fw-bold text-md-center" style="color: #ffffffcb;">
                        Php 1,000.00
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="fs-5 fw-bold" style="color: #00638D;">
            Begin your Online Application Process with these Simple Steps:
        </div>
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
        <p class="fs-4 fw-bold" style="color: #00638D;">Summary of  Requirements for your Loan Application</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 text-light" style="background-color: #0082BA; border-radius: 10px; position: relative;">
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
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/man.svg')}}" alt="Man" width="50%" class="d-none d-md-block" style="min-height: 100%; min-width: 200px">
        </div>
    </div>

    <section class="faq" style="height: 95vh; margin-top: 100px;">
        <div class="container mt-5">
            <div class="text-center fs-4 fw-bold mb-2" style="color: #00638D;">
                Frequently Asked Questions
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h1 style="width: 60%;" class="text-center fs-2 fw-bold">
                    Explore Our Top FAQs: Your Common Question Answered!
                </h1>
            </div>
            <div class="faq-container mt-5">
                <div class="row">
                    <div class="col-md-6 reveal fade-left">
                        <div class="accordion-wrapper">
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                    <div class="col-md-6 reveal fade-right">
                        <div class="accordion-wrapper">
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                            <div class="accordion">
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
                            Ready to get Started?
                        </div>
                        <div style="padding: 0 0 30px 45px" class="text-light fw-6">
                            Unlock your financial aspirations today with eBUPF – take the first step towards your goals by applying for a loan and securing the resources you need for a brighter tomorrow.
                        </div>
                        <div style="margin: 0 0 0 35px;" class="d-flex">
                            <div style="margin-left: 15px;">
                                <a href="/login" type="button" class="btn bu-orange text-light" style="filter: drop-shadow(0px 4px 0px rgba(0, 0, 0, 0.25));">Apply Loan <i class="bi bi-chevron-right"></i></a>
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

</div>
@endsection
