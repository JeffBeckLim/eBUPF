<div id="profileMyModal" class="profile-modal">
    <div class="profile-modal-content">
        <span class="profile-close">&times;</span>
        <p class="modal-profile-text">Update Profile</p>

        <form id="updateForm" action="{{ route('member.profile.update', ['id' => Auth::user()->member->id]) }}" id="profile-update-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-4 ">
                <div class="text-center mb-2">
                    @if (Auth::user()->member->profile_picture != null)
                        <img class="p-2 rounded-5 border" src="{{asset('storage/'.Auth::user()->member->profile_picture)}}" alt=""style="width: 150px; height: 150px; object-fit:cover">
                      <p class="p-1 m-0" style="font-size: small;">Current profile picture</p>
                      @endif
                </div>
                <label for="formFile" class="fw-bold fs-6 mb-2">Change Profile Picture <span class="text-muted fs-7 fw-normal">png/jpg format only</span></label>
                <input class="form-upload" type="file" id="formFile" name="profile_picture" accept=".png, .jpg, .jpeg">

            </div>
            @if($member->is_editable == 1)
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
                <input required type="text" class="form-control" name="position" id="position" value="{{$member->position}}">
              </div>
              {{-- <div class="form-group">
                <label for="email" class="fw-bold fs-7" style="color:#595959;">Email</label>
                <input required type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
              </div> --}}

              <div class="row">
                <div class="col-6 form-group">
                    <label for="monthly_salary" class="fw-bold fs-7" style="color:#595959;">Monthly Salary</label>
                    <input required type="number" name="monthly_salary" class="form-control" id="monthly_salary" value="{{ $member->monthly_salary }}">
                  </div>
                <div class="col-6">
                    <label class="fw-bold fs-7" style="color:#595959;" for="contact_num">Contact Number
                    </label>

                    <div class="input-group ">
                        <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>
                        @php
                            $contact = (int)substr(Auth::user()->member->contact_num,3);
                        @endphp
                        <input required type="number" placeholder="ex. 9150012457" class="form-control validate" name="contact_num" value="{{$contact }}" id="contact_num">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="fw-bold fs-7" style="color:#595959;">Address</label>
                <input required type="text" name="address" class="form-control" id="address" value="{{ $member->address }}">
              </div>
              @else
              <div class="profile-note" style="margin: 10px 0">
                <p class="fs-6" style="text-align: justify;">Hi! You can't edit your profile info again, but you can still change your password and photo. For more details, please visit or contact BUPF Office.</p>
            </div>
              @endif
              <div class="d-flex justify-content-end align-items-end mt-4 gap-3">
                    <button type="button" id="modal-profile-close-button" class="btn btn-outline-secondary">Close</button>
                    <button type="submit" class="btn bu-orange text-light">Update Profile</button>
              </div>
        </form>
    </div>
</div>
<script>

  const contactNumberInput = document.getElementById('contact_num');
  contactNumberInput.addEventListener('input', function(event) {
  const newValue = event.target.value;
  console.log(newValue); // Logs the new value as it changes

    if (newValue.length != 10 || newValue[0] != 9) {
            contactNumberInput.classList.add("is-invalid");
            contactNumberInput.setCustomValidity('Please enter valid PH sim number format');
            contactNumberInput.reportValidity();
            event.preventDefault();
        } else {
            contactNumberInput.classList.remove("is-invalid");
            contactNumberInput.setCustomValidity('');
        }
  });
  </script>
