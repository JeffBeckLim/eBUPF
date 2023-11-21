<div class="tab g-0">
    <div class="row g-0" >
                <label class="m-0 fw-bold">Your Name</label>
                <div class="row g-0 ">
                    <div class="col pe-1">
                        <label for="lname" >
                             First name
                        </label>
                        <input class="form-control mb-1 validate rounded-0 rounded-start" id="firstname" name="firstname" value="{{Auth::user()->member->firstname}}" title="Please enter a valid name">
                        @error('firstname')
                            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>


                    <div class="col ">
                        <div class="">
                        <label for="middlename" >Middle Name</label></div>
                        <input type="text" class="form-control w-100 rounded-0 rounded-end" name="middlename" value="{{old('middlename')}}" id="middlename">
                        @error('middlename')
                            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>


                    <div class="col-12  pe-1 pb-3">
                        <label for="lname">
                             Last Name
                        </label>
                        <input class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}" id="lastname">
                        @error('lastname')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>

                </div>




                {{-- Adress Selector --}}
                <div class="row g-0 border-bottom" id="edit_address">
                    {{-- <div class="col-12 pb-1 pb-3">
                        <label class="fw-bold" for="address">
                            Address
                        </label>
                        <input class="form-control validate" name="address" value="{{old('address')}}">
                        @error('address')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                    </div> --}}
                    <label class="fw-bold" for="address">
                        Address
                    </label>
                        <div class="col-sm-6 mb-3 pe-1" >
                            <label class="form-label">Region *</label>
                            <select name="region" class="form-control form-control-md validate" id="region"></select>
                            <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                            @error('region_text')
                                <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 ">
                            <label class="form-label">Province *</label>
                            <select name="province" class="form-control form-control-md validate" id="province" disabled></select>
                            <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                            @error('province_text')
                                <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3 pe-1">
                            <label class="form-label">City / Municipality *</label>
                            <select name="city" class="form-control form-control-md validate" id="city" disabled></select>
                            <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                            @error('city_text')
                                <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label">Barangay *</label>
                            <select name="barangay" class="form-control form-control-md validate" id="barangay" disabled></select>
                            <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                            @error('<barangay_text></barangay_text>')
                                <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                            @enderror
                        </div>
                </div> {{-- last row tag for address--}}




                <div class="col-6 pe-1">
                    <label class="fw-bold" for="birthday">
                         Date of Birth
                    </label>
                    <input class="form-control  validate" type="date" name="date_of_birth" value="{{old('date_of_birth')}}" id="date_of_birth">
                    @error('date_of_birth')
                        <p class="text-danger mt-1 text-wrap"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                </div>

                <div class="col-6 pb-1">
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

                {{-- TESTING ADRESSs --}}

    </div>{{-- row - last tag --}}



{{--
 <button class="btn" type="submit">
    submit
    </button>
 --}}
</div> {{-- Last Tag --}}
<script>
const regionSelector = document.getElementById('region');
const provinceSelector = document.getElementById('province');
const citySelector = document.getElementById('city');
const barangaySelector = document.getElementById('barangay');

regionSelector.addEventListener('change', function() {

    if(regionSelector.value != ''){
        provinceSelector.disabled = false;
    }
});
provinceSelector.addEventListener('change', function() {
        citySelector.disabled = false;
});
citySelector.addEventListener('change', function() {
        barangaySelector.disabled = false;
});
</script>
<script src="{{asset('js/ph_address_selector.js')}}" defer></script>
