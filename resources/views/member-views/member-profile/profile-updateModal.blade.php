<div id="profileMyModal" class="profile-modal">
    <div class="profile-modal-content">
        <span class="profile-close">&times;</span>
        <p class="modal-profile-text">Update Profile</p>
        <div class="profile-note" style="margin: 10px 0">
            Note that you will only be allowed to update your profile once
        </div>
        <form action="{{ route('member.profile.update', ['id' => Auth::user()->member->id]) }}" id="profile-update-form" method="POST">
            @csrf
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
                <select name="position" class="form-select form-control validate" >
                    <option value="faculty" {{ $member->postion == 'faculty' ? 'selected' : '' }}>faculty</option>
                    <option value="dept. head" {{ $member->postion == 'dept. head' ? 'selected' : '' }}>dept. head</option>
                    <option value="chairman" {{ $member->postion == 'chairman' ? 'selected' : '' }}>chairman</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email" class="fw-bold fs-7" style="color:#595959;">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
              </div>
              <div class="form-group">
                <label for="contact_num" class="fw-bold fs-7" style="color:#595959;">Contact Number</label>
                <input type="text" name="contact_num" class="form-control" id="contact_num" value="{{ $member->contact_num }}">
              </div>
              <div class="form-group">
                <label for="address" class="fw-bold fs-7" style="color:#595959;">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $member->address }}">
              </div>

              <div class="d-flex justify-content-end align-items-end mt-4 gap-3">
                    <button type="button" id="modal-profile-close-button" class="btn modal-profile-close">Close</button>
                    <button type="submit" class="btn modal-profile-submit">Update Profile</button>
              </div>
        </form>
    </div>
</div>
