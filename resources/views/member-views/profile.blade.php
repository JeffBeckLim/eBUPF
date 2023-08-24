@extends('member-components.member-layout')

@section('content')

<main style="margin: 40px;">

    <div style="background-color: #f5f5f5; border-radius: 10px; padding-bottom: 10px;">

        <div class="profile-note">
            Note that you will only be allowed to update your profile once. Subsequent changes can only be made in person at the BUPF (BUPF Office) for verification purposes. <br>We value the security of your data and want to ensure the accuracy of the information associated with your account.
        </div>

        <div class="profile-tag">
            <img src="{{ asset('assets/core-feature-bg.png') }}" alt="tag" height="190px" width="100%">

            <div class="profile-tag-details">
                <img src="{{ asset('storage/' . $member->profile_picture) }}" alt="profile picture" class="profile-picture" width="100" height="120">
                <p class="profile-name"><span>{{ $member->firstname }} {{ $member->middle_initial }}. {{ $member->lastname }}&nbsp;</span><a href="#" id="profileOpenModalLink"><i class="bi bi-pencil-square fs-6" style="color: white;"></i></a></p>
                <p class="profile-position"><i class="bi bi-person-fill"></i> &nbsp;{{ ucfirst($member->position) }}</p>
                <p class="profile-college"><i class="bi bi-building-fill"></i> &nbsp;BU{{$unit->unit_code}}</p>
            </div>
        </div>

        <div class="row gap-4" style="margin:20px 58px;">
            <div class="col-lg-4" style="height: auto; background-color: white; border-radius: 10px;">
                <div style="border-bottom: 1px solid #E8E8E8; display: flex;">
                    <img width="30" height="30" src="https://img.icons8.com/ios-filled/50/manager.png" alt="employee" style="margin: 15px 10px; color: #393939;"/>
                    <p class="mt-3 fw-bold fs-6" style="color: #393939">Employment Information</p>
                </div>

                <div style="margin: 15px 10px; ">
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Campus :</span> {{$campus->campus_code}}&nbsp;Campus</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Unit :</span> BU{{$unit->unit_code}}</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Position :</span> {{ ucfirst($member->position) }}</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Employee No. :</span> {{ $member->employee_num }}</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Date Appointed at BU :</span> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $member->bu_appointment_date)->format('F j, Y') }}</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Member Status :</span> <span class="fw-bold"  style="color: {{ $member->disabled_at ? 'red' : 'green' }}">{{ $member->disabled_at ? 'Inactive' : 'Active' }}</span></p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Approved Date :</span> <span class="fw-bold" style="color: #00145B;">
                        @if ($member->verified_at)
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $member->verified_at)->startOfDay()->format('F j, Y') }}
                        @else
                        Not verified
                    @endif
                    </span></p>

                    <div class="d-flex justify-content-center align-items-center">
                        <button class="download-membership-pdf-profile">
                            <a href="{{ route('generateMembershipForm', ['id' => Auth::user()->member->id]) }}" class="pdf-membership-download-link fw-bold fs-7 text-white">Download Membership Form</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" style="height: auto; background-color: white; border-radius: 10px;">
                <div style="border-bottom: 1px solid #E8E8E8; display: flex;">
                    <i class="bi bi-person-fill-exclamation" style="margin: 8px 10px; color: #393939; font-size: 30px;"></i>
                    <p class="mt-3 fw-bold fs-6" style="color: #393939">Personal Information</p>
                </div>

                <div class="row fs-7" style="margin: 15px 10px; color: #393939;">
                    <div class="col-5">
                        <p><span class="fw-bold">Name :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ $member->firstname }} {{ $member->middle_initial }}. {{ $member->lastname }}</span></p>
                    </div>

                    <div class="col-5">
                        <p><span class="fw-bold">Email :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ substr($user->email, 0, 1) . str_repeat('*', strpos($user->email, '@') - 2) . substr($user->email, strpos($user->email, '@') - 1) }}</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Address :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ $member->address }}</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Contact Number :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ str_repeat('*', strlen($member->contact_num) - 3) . substr($member->contact_num, -3) }}</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Sex :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ $member->sex }}</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Tin :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ $member->tin_num }}</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Birthdate :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $member->date_of_birth)->format('F j, Y') }}</span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="profileMyModal" class="profile-modal">
        <div class="profile-modal-content">
            <span class="profile-close">&times;</span>
            <p class="modal-profile-text">Update Profile</p>
            <form action="" id="profile-update-form" method="POST">
                @csrf
                <div>
                    <img src="" alt="">
                </div>
                <div class="form-group">
                    <label for="campus-unit">Campus & Unit</label>
                    <select name="unit_id" class="form-select form-control validate" >
                        <option class="text-secondary" value="" selected disabled>{{$unit->unit_code}} : {{$campus->campus_code}}</option>

                        @foreach ($units as $unit)
                            <option value="{{$unit->id}}"  {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{$unit->unit_code}} : {{$unit->campuses->campus_code}}</option>
                        @endforeach

                    </select>
                </div>

                  <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" class="form-control" id="position" value="{{ $member->position }}">
                  </div>
                  <div class="form-group">
                    <label for="position">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}">
                  </div>
                  <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="text" class="form-control" id="contact-number" value="{{ $member->position }}">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" value="{{ $member->position }}">
                  </div>

                  <div class="d-flex justify-content-end align-items-end mt-4 gap-3">
                        <button type="" id="modal-profile-close-button" class="btn modal-profile-close">Close</button>
                        <button type="submit" class="btn modal-profile-submit">Update Profile</button>
                  </div>
            </form>
        </div>
      </div>
</main>

@endsection
