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
                        <label for="lname">Last name</label>
                        <input id="myForm" class="form-control validate"  name="lastname" value="{{Auth::user()->member->lastname}}">
                    </div>
                    @error('lastname')
                        <p class="text-danger mt-1 ">{{$message}}</p>
                    @enderror
                    
                    <div class="col-2 ">
                        <div  class="d-none d-md-block"><label for="middle_initial">Mid int.</label></div>
                        <div class="d-block d-md-none"><label for="middle_initial" >M.I</label></div>
                        <input class="form-control w-100 validate " name="middle_initial" value="{{Auth::user()->member->middle_initial}}" pattern="[A-Z a-z]{1,3}" maxlength="3">
                    </div>
                    @error('middle_initial')
                        <p class="text-danger mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="row g-0 ">
                    <div class="col-12 pb-1 pb-3">
                        <label class="fw-bold" for="address">Address</label>
                        <input class="form-control validate" name="address" value="{{Auth::user()->member->address}}">
                    </div>
                </div>
                @error('address')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                
                <div class="col-6 pe-1 pb-3">
                    <label class="fw-bold" for="birthday">Date of Birth</label>
                    <input class="form-control  validate" type="date" name="date_of_birth" value="{{Auth::user()->member->date_of_birth}}">
                </div>
                @error('date_of_birth')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-bold" for="placeOfBirth">Place of Birth</label>
                    <input class="form-control validate" name="place_of_birth" value="{{Auth::user()->member->place_of_birth}}">
                </div>
                @error('place_of_birth')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6 pe-1 pb-3">
                    <label class="fw-bold" for="civilStatus">Civil Status</label>
                    <select class="form-select form-control validate" aria-label="Default select example"  id="civilStatus" name="civil_status" onchange="enableSpouseInput()">
                        {{-- @if (Auth::user()->member->civil_status)
                            <option selected disabled>{{Auth::user()->member->civil_status}}</option>
                        @endif --}}
                        <option value="single" {{Auth::user()->member->civil_status == "single" ? 'selected' : ''}}>single</option>
                        <option value="married" {{Auth::user()->member->civil_status == "married" ? 'selected' : ''}}>married</option>
                        <option value="divorced" {{Auth::user()->member->civil_status == "divorced" ? 'selected' : ''}}>divorced</option>
                        <option value="widowed" {{Auth::user()->member->civil_status == "widowed" ? 'selected' : ''}}>widowed</option>
                    </select>
                </div>
                @error('civil_status')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6 pb-1">
                    <label class="fw-light" for="spouse">Name of Spouse</label>
                    <input class="form-control " name="spouse" id="spouseName" value="{{Auth::user()->member->spouse}}" 
                    @if (Auth::user()->member->civil_status != 'married')
                        disabled 
                    @endif>
                </div>
                <div class="col-6 pe-1">
                    <label class="fw-bold" for="contact_num">Contact Number</label>
                    <input type="number" placeholder="ex. 09150012457" class="form-control validate" name="contact_num" value="{{Auth::user()->member->contact_num}}">
                </div>
               
                <div class="col-6 pb-1">
                    <label class="fw-bold" for="sex">Sex</label>
                    <select class="form-select form-control validate" aria-label="Default select example" name="sex">
                        <option value="not specified" {{ Auth::user()->member->sex == 'not specified' ? 'selected' : '' }}>prefer not to specify</option>
                        <option value="male"  {{ Auth::user()->member->sex == 'male' ? 'selected' : '' }}>male</option>
                        <option value="female"  {{ Auth::user()->member->sex == 'female' ? 'selected' : '' }}>female</option>
                    </select>
                </div>
                @error('sex')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>
</div>