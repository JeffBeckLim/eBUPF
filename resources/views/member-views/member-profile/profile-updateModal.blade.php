<div id="profileMyModal" class="profile-modal">
    <div class="profile-modal-content">
        <span class="profile-close">&times;</span>
        <p class="modal-profile-text">Update Profile</p>
        <div class="profile-note" style="margin: 10px 0">
            Note that you will only be allowed to update your profile once
        </div>
        <form action="{{ route('member.profile.update', ['id' => Auth::user()->member->id]) }}" id="profile-update-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-4 ">
                <div class="text-center mb-2">
                    @if (Auth::user()->member->profile_picture != null)
                        <img class="p-2 rounded-5 border" src="{{asset('storage/'.Auth::user()->member->profile_picture)}}" alt=""style="width: 150px; height: 150px; object-fit:cover">
                      <p class="p-1 m-0" style="font-size: small;">Current profile picture</p>
                      @endif
                </div>
                <label for="formFile" class="fw-bold">Change Profile Picture</label>
                <input class="form-upload" type="file" id="formFile" name="profile_picture">
            </div>
            <div class="form-group">
                <label for="campus-unit" class="fw-bold fs-7" style="color:#595959;">Campus & Unit</label>
                <select name="unit_id" class="form-select form-control validate" >

                    @foreach ($units as $units_item)
                        @if($unit->id == $units_item->id)
                            <option value="{{$units_item->id}}" selected>{{$units_item->unit_code}} : {{$units_item->campuses->campus_code}}</option>
                        @else
                            <option value="{{$units_item->id}}" >{{$units_item->unit_code}} : {{$units_item->campuses->campus_code}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

              <div class="form-group">
                <label for="position" class="fw-bold fs-7" style="color:#595959;">Position</label>
                <input type="text" class="form-control" name="position" id="position" value="{{$member->position}}">
              </div>
              <div class="form-group">
                <label for="email" class="fw-bold fs-7" style="color:#595959;">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
              </div>
              {{-- <div class="form-group">
                <label for="contact_num" class="fw-bold fs-7" style="color:#595959;">Contact Number</label>
                <input type="number" name="contact_num" class="form-control" id="contact_num" value="{{ $member->contact_num }}">
              </div> --}}
              <div class="row">
                <div class="col-6 form-group">
                    <label for="monthly_salary" class="fw-bold fs-7" style="color:#595959;">Monthly Salary</label>
                    <input type="number" name="monthly_salary" class="form-control" id="monthly_salary" value="{{ $member->monthly_salary }}">
                  </div>
                <div class="col-6">
                    <label class="fw-bold fs-7" style="color:#595959;" for="contact_num">Contact Number
                    </label>

                    <div class="input-group ">
                        <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>
                        @php
                            $contact = (int)substr(Auth::user()->member->contact_num,3);
                        @endphp
                        <input type="number" placeholder="ex. 9150012457" class="form-control validate" name="contact_num" value="{{$contact }}" id="contact_num">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="fw-bold fs-7" style="color:#595959;">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $member->address }}">
              </div>

              <div class="d-flex justify-content-end align-items-end mt-4 gap-3">
                    <button type="button" id="modal-profile-close-button" class="btn btn-outline-secondary">Close</button>
                    <button type="submit" class="btn bu-orange text-light">Update Profile</button>
              </div>
        </form>
    </div>
</div>
