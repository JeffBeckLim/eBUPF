@extends('home-components.home-layout')

@section('content')

<main class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-5 col-sm-12 col-md-8 card shadow-sm px-4 py-3 m-5">

            <!-- CAPSULE -->
            <div class="row  bu-low-gradient-x d-flex justify-content-center p-3 rounded-4">
                <div class="col-9" style="width: 20rem;">
                    <div class="row d-flex ">
                        <img src="{{asset('assets/BU-pill.svg')}}" alt="Bicol University" oncontextmenu="return false;">
                    </div>
                </div>
            </div>
            <!-- CAPSULE -->

            <div class="row justify-content-center pb-1 pt-3">
                <div class="col-lg-6 col-md-9 col-sm-9">
                    <h5 class="text-center fw-bold ">Provident Fund, Inc. Membership Form</h5>
                </div>

            </div>
            <div class="text-center pb-4">
                Let's get you started on your journey to becoming a member!
            </div>

            <form method="POST" action="/member/application/{{Auth::user()->member->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-0">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab g-0">

                        <div class="row g-0" >
                                    <p class="m-0 fw-bold">Your Name</p>
                                    <div class="row g-0 "> 
                                        <div class="col-5 pe-1">
                                            <label for="lname">First name</label>
                                            <input class="form-control mb-1 validate" name="firstname" value="{{Auth::user()->member->firstname}}">
                                        </div>
                                        @error('firstname')
                                            <p class="text-danger mt-1">{{$message}}</p>
                                         @enderror
                                        <div class="col  pe-1 pb-3">
                                            <label for="lname">Lastname</label>
                                            <input id="myForm" class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}">
                                        </div>
                                        @error('lastname')
                                            <p class="text-danger mt-1 ">{{$message}}</p>
                                        @enderror
                                        
                                        <div class="col-2 ">
                                            <div  class="d-none d-md-block"><label for="middle_initial">Mid int.</label></div>
                                            <div class="d-block d-md-none"><label for="middle_initial" >M.I</label></div>
                                            <input class="form-control w-100 validate" name="middle_initial" value="{{old('middle_initial')}}">
                                        </div>
                                        @error('middle_initial')
                                            <p class="text-danger mt-1">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="row g-0 ">
                                        <div class="col-12 pb-1 pb-3">
                                            <label class="fw-bold" for="address">Address</label>
                                            <input class="form-control validate" name="address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                    @error('address')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    
                                    <div class="col-6 pe-1 pb-3">
                                        <label class="fw-bold" for="birthday">Date of Birth</label>
                                        <input class="form-control " type="date" name="date_of_birth" value="{{old('date_of_birth')}}">
                                    </div>
                                    @error('date_of_birth')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6 pb-1">
                                        <label class="fw-bold" for="placeOfBirth">Place of Birth</label>
                                        <input class="form-control validate" name="place_of_birth" value="{{old('place_of_birth')}}">
                                    </div>
                                    @error('place_of_birth')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6 pe-1 pb-3">
                                        <label class="fw-bold" for="civilStatus">Civil Status</label>
                                        <select class="form-select form-control validate" aria-label="Default select example"  id="civilStatus" name="civil_status" onchange="enableSpouseInput()">
                                            <option selected disabled>...</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                    </div>
                                    @error('civil_status')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6 pb-1">
                                        <label class="fw-light" for="spouse">Name of Spouse</label>
                                        <input class="form-control " name="spouse" id="spouseName" value="{{old('spouse')}}" disabled >
                                    </div>
                                    <div class="col-6 pe-1">
                                        <label class="fw-bold" for="contact_num">Contact Number</label>
                                        <input type="number" class="form-control validate" name="contact_num" value="{{old('contact_num')}}">
                                    </div>
                                    {{-- @error('firstname')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror --}}
                                    <div class="col-6 pb-1">
                                        <label class="fw-bold" for="sex">Sex</label>
                                        <select class="form-select form-control validate" aria-label="Default select example" name="sex">
                                            <option selected disabled>...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Prefer not to specify..</option>
                                        </select>
                                    </div>
                                    @error('sex')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    
                                    
                                    
                                </div>
                                

                    </div>
                    <div class="tab fade-in">
                        <div class="row" >
                                    <div class="col-12">
                                        <p class="fw-bold m-0">Department</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label  for="">College / Unit</label>
                                        <select name="units_id" class="form-select form-control validate" >
                                            <option value="">...</option>
                                            <option value="1">Option 1</option>

                                            
                                        </select>
                                        
                                    </div>
                                    @error('units_id')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6">
                                        <label  for="">Campus</label>
                                        <select name="campus_id" class="form-select form-control validate" >
                                            <option value="casual" selected disabled >....</option>
                                            <option value="1">BUCS</option>
                                            
                                        </select>
                                    </div>
                                    @error('campus_id')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                        </div>
                        <div class="row  mb-3  mt-2">
                            <div class="col-12">
                                <p class="fw-bold m-0">Employment</p>
                            </div>

                            <div class="col-6">
                                <label   for="">Position</label>
                                <select name="position" class="form-select form-control validate" >
                                    <option value="">...</option>
                                    <option value="option1">Option 1</option>
                                    
                                </select>
                            </div>
                            @error('position')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                            <div class="col-6">
                                <label  for="salary">Monthly Salary</label>
                                <input class="form-control validate" type="number" name="monthly_salary" value="{{old('monthly_salary')}}">
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-6">
                                <label   for="tin">TIN number</label>
                                <input class="form-control validate" type="number" name="tin_num" value="{{old('tin_num')}}">
                            </div>
                            @error('tin_num')
                                 <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                            <div class="col-6">
                                <label for="salary">Employee Number</label>
                                <input class="form-control validate" type="number" name="employee_num" value="{{old('employee_num')}}">
                            </div>
                            @error('employee_num')
                                    <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row  mb-3">
                            <div class="col-6">
                                <label  for="appointmentStatus">Status of Appointment</label>
                                <select name="appointment_status" class="form-select form-control validate" aria-label="Default select example">
                                    <option value="casual">Casual</option>
                                    <option value="permanent">Permanent</option>
                                </select>
                            </div>
                            @error('appointment_status')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                            <div class="col-6">
                                <label for="salary">Date of Appointment in BU.</label>
                                <input class="form-control validate" type="date" name="bu_appointment_date" value="{{old('bu_appointment_date')}}">
                            </div>
                            @error('bu_appointment_date')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-12  mt-2">  
                            <div class="col-12">
                                <p class="fw-bold m-0">Contribution</p>
                            </div> 
                            <label for="salary">Fixed Monthly Contribution</label>
                            <input class="form-control validate" type="number" name="monthly_contribution" value="{{old('monthly_contribution')}}">
                        </div>
                        @error('monthly_contribution')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                        
                                    

                    </div>
                    <div class="tab">

                        <div class="row border-bottom border-3 pb-3 mb-3">
                                    <p class="fw-bold bu-text-orange">Provide Atleast One</p>
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Name of Benificiary (1)</label>
                                        <input class="form-control validate" type="text" name="beneficiary0" value="{{old('beneficiary0')}}">
                                    </div>
                                    @error('beneficiary0')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                                        <input class="form-control validate" type="date" name="beneficairy_birthday0" value="{{old('beneficiary_birthday0')}}">
                                    </div>
                                    @error('beneficiary_birthday0')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                    <div class="col-6">
                                        <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                                        <select name="beneficiary_relationship0" class="form-select form-control validate" aria-label="Default select example">
                                            <option value="">Select Relationship</option>
                                            <option value="spouse">Spouse</option>
                                            <option value="child">Child</option>
                                            <option value="parent">Parent</option>
                                            <option value="sibling">Sibling</option>
                                            <option value="grandparent">Grandparent</option>
                                            <option value="grandchild">Grandchild</option>
                                            <option value="friend">Friend</option>
                                            <option value="relative">Relative</option>
                                            <option value="partner">Partner</option>
                                            <option value="colleague">Colleague</option>
                                            <option value="other">Other</option>
                                            
                                        </select>
                                    </div>
                                    @error('beneficiary_relationship0')
                                        <p class="text-danger mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="row border-bottom border-3 pb-3 mb-3">
                                    
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Name of Benificiary (2)</label>
                                        <input class="form-control" type="text" name="beneficiary1">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                                        <input class="form-control" type="date" name="beneficairy_birthday1">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                                        <select name="beneficiary_relationship1" class="form-select form-control" aria-label="Default select example">
                                            <option selected disabled>...</option>
                                            <option value="1">Casual</option>
                                            <option value="2">Permanent</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row border-bottom border-3 pb-3 mb-3">
                                    
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Name of Benificiary (3)</label>
                                        <input class="form-control" type="text" name="beneficairy_birthday2">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                                        <input class="form-control" type="date" name="birthday">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                                        <select name="beneficiary_relationship2" class="form-select form-control" aria-label="Default select example">
                                            <option selected disabled>...</option>
                                            <option value="1">Casual</option>
                                            <option value="2">Permanent</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row border-bottom border-3 pb-3 mb-3">
                                    
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Name of Benificiary (4)</label>
                                        <input class="form-control" type="text" name="beneficiary3">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                                        <input class="form-control" type="date" name="beneficairy_birthday3">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                                        <select name="beneficiary_relationship3" class="form-select form-control" aria-label="Default select example">
                                            <option selected disabled>...</option>
                                            <option value="1">Casual</option>
                                            <option value="2">Permanent</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="row border-bottom border-3 pb-3 mb-3">
                                    
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Name of Benificiary (5)</label>
                                        <input class="form-control" type="text" name="beneficiary4">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                                        <input class="form-control" type="date" name="beneficairy_birthday4">
                                    </div>
                                    <div class="col-6">
                                        <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                                        <select name="beneficiary_relationship4" class="form-select form-control" aria-label="Default select example">
                                            <option selected disabled>...</option>
                                            <option value="1">Casual</option>
                                            <option value="2">Permanent</option>
                                            
                                        </select>
                                    </div>
                                </div>
                    </div>

                    <div class="tab">
                        <div class="row">
                            <div class="col-12 mb-4 ">
                                <label for="formFile" class="fw-bold mb-3">Upload Your Profile Picture</label>
                                <input class="form-upload" type="file" id="formFile" name="profile_picture">
                            </div>

                            <div class="col-12 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="agree_to_certify">
                                    <label class="form-check-label fs-6" for="defaultCheck1" >
                                                I hereby certify that all the information given  are true and correct
                                            </label>
                                </div>
                                @error('agree_to_certify')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="agree_to_authorize">
                                    <label class="form-check-label fs-6" for="defaultCheck1" >
                                                Further, I hereby authorize the Administrative/Payroll Section to deduct from my salaries my monthly contribution as member to the bu Provident Fund, Inc.
                                            </label>
                                </div>
                                @error('agree_to_authorize')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                                
                            </div>
                            <div class="col-12 mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="agree_to_terms">
                                    <label class="form-check-label fs-6" for="defaultCheck1" >
                                                I agree to the terms and conditions for collecting and using my data.                                                
                                            </label>
                                </div>
                                @error('agree_to_terms')
                                    <p class="text-danger mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class=" d-flex justify-content-end my-3">

                        <button class="btn btn-secondary fw-bold me-1 text-light" type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                        <button style="width: 11rem;" class="btn bu-orange text-light fw-bold" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div class="text-center">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
            </form>

            <script src="{{asset('js/formWizard.js')}}"></script>
            </div>
        </div>
</main>

@endsection
