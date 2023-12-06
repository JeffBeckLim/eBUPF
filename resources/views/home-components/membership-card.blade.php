<div class="card p-3">
    <div class="row" style="margin: 20px 10px 0 10px;">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <h4 class="fw-bolder  membership-card-greetings">
                        Hello {{Auth::user()->member->firstname}}, thank you for signing Up!
                    </h4>
                    <p class="membership-card-greetings2 fs-6">
                        Congratulations! You are now registered and can access our membership application form. Simply fill it up and submit it to BUPF Legazpi Main Campus. For more details, click the link below.
                    </p>
                </div>
                <div class="col-lg-5 d-flex align-items-center">
                    <a style="padding-right: 30px;" class="grow-on-hover btn bu-orange rounded-pill text-light fw-bold d-flex align-items-center see-membership-button" href="/member/membership-application/check/{{Auth::user()->member->id}}">
                        <i class="fa fa-arrow-circle-right fa-lg pe-4" style="color: #b94703;"></i>
                        See Membership Form
                    </a>
                </div>
                <div class="col-lg-7">
                    <a style="color: #0092D1" class="btn btn-link text-start review-text-button" href="{{route('requirements.and.instructions')}}">Please review the requirements and the instructions</a>
                </div>
            </div>

        </div>
        <div class="col-3 d-none d-md-block text-end">
            <img src="{{asset('assets/membership-circular-orange.svg')}}" style="height: 10rem">
        </div>
    </div>
</div>
