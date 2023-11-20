<div class="tab g-0">
    <div class="row g-0" >
        <div id="edit_page" value="1">
        </div>
                <p class="m-0 fw-bold">Your Name</p>
                <div class="row g-0 ">
                    <div class="col pe-1">
                        <label for="lname"></label>
                            First name
                        </label>
                        <input class="form-control mb-1 validate" name="firstname" value="{{Auth::user()->member->firstname}}">
                    </div>
                    @error('firstname')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                     @enderror

                    <div class="col ">
                        <div><label for="middlename">Middlename</label></div>
                        <input type="text" class="form-control w-100" name="middlename" value="{{Auth::user()->member->middlename}}">
                    </div>
                    @error('middle_initial')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror

                    <div class="col-12  pe-1 pb-3">
                        <label for="lname">
                            Last name
                        </label>
                        <input id="myForm" class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}">
                    </div>
                    @error('lastname')
                        <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                </div>
                @php
                    $address_arr = explode(",", Auth::user()->member->address);

                @endphp

                <div class="row g-0 ">
                    <div class="col-12 pb-1 pb-3">
                        <label class="fw-bold" for="address">
                            Your Current Address
                        </label>
                        <input class="form-control validate" name="address" value="{{Auth::user()->member->address}}" readonly style="background-color: white !important">
                        @error('address')
                            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                </div>


                <button type="button" class="btn btn-outline-dark mb-3" onclick="showEditAddress()" id="show_btn">
                    Edit Address
                </button>
                <button type="button" class="btn btn-outline-dark d-none mb-3" onclick="HideEditAddress()" id="hide_btn">
                    Cancel
                </button>

                <div class="row  g-0 d-none" id="edit_address">

                    <div class="col-sm-6 mb-3 pe-1" >
                        <label class="form-label">Region *</label>
                        <select name="region" class="form-control form-control-md " id="region">
                        </select>
                        <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                        @error('region_text')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 ">
                        <label class="form-label">Province *</label>
                        <select name="province" class="form-control form-control-md " id="province" disabled></select>
                        <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                        @error('province_text')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3 pe-1">
                        <label class="form-label">City / Municipality *</label>
                        <select name="city" class="form-control form-control-md " id="city" disabled></select>
                        <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                        @error('city_text')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Barangay *</label>
                        <select name="barangay" class="form-control form-control-md " id="barangay" disabled></select>
                        <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                        @error('<barangay_text></barangay_text>')
                            <p class="text-danger mt-1 "><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                        @enderror
                    </div>

                </div>







                <div class="col-6 pe-1 pb-3">
                    <label class="fw-bold" for="birthday"> Date of Birth
                    </label>
                    <input id="date_of_birth" class="form-control  validate" type="date" name="date_of_birth" value="{{Auth::user()->member->date_of_birth}}">
                    @error('date_of_birth')
                        <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                    @enderror
                </div>

                <div class="col-6 pb-1">
                    <label class="fw-bold" for="placeOfBirth">Place of Birth</label>
                    <input class="form-control validate" name="place_of_birth" value="{{Auth::user()->member->place_of_birth}}">
                </div>
                @error('place_of_birth')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror
                <div class="col-6 pe-1 pb-3">
                    <label class="fw-bold" for="civilStatus">Civil Status</label>
                    <select class="form-select form-control validate" aria-label="Default select example"  id="civilStatus" name="civil_status" onchange="enableSpouseInput()">
                        {{-- @if (Auth::user()->member->civil_status)
                            <option selected disabled>{{Auth::user()->member->civil_status}}</option>
                        @endif --}}
                        <option value="single" {{Auth::user()->member->civil_status == "single" ? 'selected' : ''}}>Single</option>
                        <option value="married" {{Auth::user()->member->civil_status == "married" ? 'selected' : ''}}>Married</option>
                        <option value="divorced" {{Auth::user()->member->civil_status == "divorced" ? 'selected' : ''}}>Divorced</option>
                        <option value="widowed" {{Auth::user()->member->civil_status == "widowed" ? 'selected' : ''}}>Widowed</option>
                        <option value="widowed" {{Auth::user()->member->civil_status == "seperated" ? 'selected' : ''}}>Separated</option>
                    </select>
                </div>
                @error('civil_status')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-light" for="spouse">Name of Spouse</label>
                    <input class="form-control " name="spouse" id="spouseName" value="{{Auth::user()->member->spouse}}"
                    @if (Auth::user()->member->civil_status != 'married')
                        disabled
                    @endif>
                </div>
                <div class="col-6 pe-1">
                    <label class="fw-bold" for="contact_num">Contact Number
                    </label>

                    <div class="input-group ">
                        <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>
                        @php
                                $contact = (int)substr(Auth::user()->member->contact_num,3);
                        @endphp
                    <input type="number" placeholder="ex. 09150012457" class="form-control validate" name="contact_num" value="{{$contact }}" id="contact_num">

                    </div>
                </div>

                <div class="col-6 pb-1">
                    <label class="fw-bold" for="sex">Sex</label>
                    <select class="form-select form-control validate" aria-label="Default select example" name="sex">
                        {{-- <option value="not specified" {{ Auth::user()->member->sex == 'not specified' ? 'selected' : '' }}>prefer not to specify</option> --}}
                        <option value="male"  {{ Auth::user()->member->sex == 'male' ? 'selected' : '' }}>male</option>
                        <option value="female"  {{ Auth::user()->member->sex == 'female' ? 'selected' : '' }}>female</option>
                    </select>
                </div>
                @error('sex')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror


            </div>


{{-- <button class="btn" type="submit">
    submit
    </button> --}}
</div>
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
