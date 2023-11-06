<div class="tab g-0">
    <div class="row g-0" >
                <p class="m-0 fw-bold">Your Name</p>
                <div class="row g-0 ">
                    <div class="col pe-1">
                        <label for="lname" >
                             First name 
                        </label>
                        <input class="form-control mb-1 validate" name="firstname" value="{{Auth::user()->member->firstname}}">
                        @error('firstname')
                            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                   

                    <div class="col ">
                        <div class="">
                            <label for="middlename" >Middle Name</label></div>
                        <input type="text" class="form-control w-100 " name="middlename" value="{{old('middlename')}}" >
                        @error('middlename')
                            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                 

                    <div class="col-12  pe-1 pb-3">
                        <label for="lname">
                             Last Name
                        </label>
                        <input id="myForm" class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}">
                        @error('lastname')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                  
                </div>
                <div class="row g-0 ">
                    <div class="col-12 pb-1 pb-3">
                        <label class="fw-bold" for="address">
                            
                            Address
                        </label>
                        <input class="form-control validate" name="address" value="{{old('address')}}">
                        @error('address')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                    </div>
                </div>
              

                <div class="col-6">
                    <label class="fw-bold" for="birthday">
                         Date of Birth
                    </label>
                    <input class="form-control  validate" type="date" name="date_of_birth" value="{{old('date_of_birth')}}">
                    @error('date_of_birth')
                        <p class="text-danger mt-1 text-wrap"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                </div>
                
                <div class="col-6 ps-1 pb-1">
                    <label class="fw-bold" for="placeOfBirth">Place of Birth</label>
                    <input class="form-control" name="place_of_birth" value="{{old('place_of_birth')}}">
                </div>
                @error('place_of_birth')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror
                <div class="col-6 pe-1 pb-3">
                    <label class="fw-bold" for="civilStatus">Civil Status</label>
                    <select class="form-select form-control validate" aria-label="Default select example"  id="civilStatus" name="civil_status" onchange="enableSpouseInput()">
                        @if (Auth::user()->member->civil_status)
                            <option selected disabled>{{Auth::user()->member->civil_status}}</option>
                        @endif
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                        <option value="separated">Separated</option>
                    </select>
                </div>
                @error('civil_status')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-light" for="spouse">Name of Spouse</label>
                    <input class="form-control " name="spouse" id="spouseName" value="{{old('spouse')}}" disabled >
                </div>
                <div class="col-6 pe-1">
                    <label class="fw-bold" for="contact_num">
                        
                        Contact Number
                    </label>
                    
                    <div class="input-group ">
                    <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>

                    <input type="number" placeholder="ex. 9150012457" class="form-control validate" name="contact_num" value="{{old('contact_num')}}" id="contact_num" pattern="9[0-9]{10}" title="Please enter 10 digits starting with '9'." aria-describedby="inputGroupPrepend">
                    
                    @error('contact_num')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                    </div>
                </div>
               
                <div class="col-6 pb-1">
                    <label class="fw-bold" for="sex">Sex</label>
                    <select class="form-select form-control validate" aria-label="Default select example" name="sex">
                    @if (Auth::user()->member->sex)
                        <option selected disabled>{{Auth::user()->member->sex}}</option>
                    @endif
                        {{-- <option value="not specified" {{ old('sex') == 'not specified' ? 'selected' : '' }}>prefer not to specify</option> --}}
                        <option value="male"  {{ old('sex') == 'male' ? 'selected' : '' }}>male</option>
                        <option value="female"  {{ old('sex') == 'female' ? 'selected' : '' }}>female</option>
                    </select>
                </div>
                @error('sex')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
            
{{-- TESTING ADRESSs --}}


{{-- <div class="col-sm-6 mb-3">
    <label class="form-label">Region *</label>
    <select name="region" class="form-control form-control-md" id="region"></select>
    <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
</div>
<div class="col-sm-6 mb-3">
    <label class="form-label">Province *</label>
    <select name="province" class="form-control form-control-md" id="province"></select>
    <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
</div>
<div class="col-sm-6 mb-3">
    <label class="form-label">City / Municipality *</label>
    <select name="city" class="form-control form-control-md" id="city"></select>
    <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
</div>
<div class="col-sm-6 mb-3">
    <label class="form-label">Barangay *</label>
    <select name="barangay" class="form-control form-control-md" id="barangay"></select>
    <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
</div>

 --}}
 {{-- <button class="btn" type="submit">
    submit
    </button> --}}

</div> {{-- Last Tag --}}  

<script src="{{asset('js/ph_address_selector.js')}}" defer></script>