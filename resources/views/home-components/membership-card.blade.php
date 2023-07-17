<div class="card p-5">
    <div class="row"> 
        <div class="col ">
            <div class="row">
                <div class="col-12 ">
                    <h4 class="fw-bolder">
                        Hello {{Auth::user()->member->firstname}}, thank you for signing Up!
                    </h4>
                    <p> 
                        You are now registered and can access our membership application form. Simply fill it up and submit it to BUPF Legazpi Main Campus. For more details, please continue reading below.
                    </p>
                </div>
                <div class="col-lg-5  d-flex align-items-center">
                    <a style="padding-right: 100px" class="grow-on-hover btn bu-orange rounded-pill text-light fw-bold d-flex align-items-center" href=""><i class="fa fa-arrow-circle-right fa-lg pe-4" style="color: #b94703;"></i>See Membership Form</a>

                </div>
                <div class="col-lg-7  d-flex align-items-center">
                    <a style="color: #0092D1" class="btn btn-link text-start" href="">Please review the requirements and the instructions</a>
                </div>
            </div>
            
            
        </div>
        <div class="col-3 d-none d-md-block text-end  ">
            <img src="{{asset('assets/membership-circular-orange.svg')}}" style="height: 10rem">
        </div>
    </div>    
</div>