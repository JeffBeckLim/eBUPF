<div class="tab g-0">
    <div class="row g-0" >
                <p class="m-0 fw-bold">Your Name</p>
                <div class="row g-0 ">
                    <div class="col pe-1">
                        <label class="fw-bold" for="lname" >First name</label>
                        <input class="form-control mb-1 validate" name="firstname" value="{{Auth::user()->member->firstname}}">
                    </div>
                    @error('firstname')
                        <p class="text-danger mt-1">{{$message}}</p>
                     @enderror

                    <div class="col ">
                        <div class=""><label for="middlename" >Middle Name</label></div>
                        <input type="text" class="form-control w-100 " name="middlename" value="{{old('middlename')}}" >
                    </div>
                    @error('middlename')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror

                    <div class="col-12  pe-1 pb-3">
                        <label class="fw-bold" for="lname">Last Name</label>
                        <input id="myForm" class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}">
                    </div>
                    @error('lastname')
                        <p class="text-danger mt-1 ">{{$message}}</p>
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
                    <input class="form-control  validate" type="date" name="date_of_birth" value="{{old('date_of_birth')}}">
                </div>
                @error('date_of_birth')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-bold" for="placeOfBirth">Place of Birth</label>
                    <input class="form-control" name="place_of_birth" value="{{old('place_of_birth')}}">
                </div>
                @error('place_of_birth')
                    <p class="text-danger mt-1">{{$message}}</p>
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
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-light" for="spouse">Name of Spouse</label>
                    <input class="form-control " name="spouse" id="spouseName" value="{{old('spouse')}}" disabled >
                </div>
                <div class="col-6 pe-1">
                    <label class="fw-bold" for="contact_num">Contact Number</label>
                    
                    <div class="input-group ">
                    <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>

                    <input type="number" placeholder="ex. 9150012457" class="form-control validate" name="contact_num" value="{{old('contact_num')}}" id="contact_num" pattern="9[0-9]{10}" title="Please enter 10 digits starting with '9'." aria-describedby="inputGroupPrepend">

                    </div>
                </div>
                {{-- @error('firstname')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror --}}
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
</div>
