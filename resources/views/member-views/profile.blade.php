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
                <img src="{{ asset('assets/hooman.png') }}" alt="profile picture" class="profile-picture">
                <p class="profile-name"><span>Maxima Minima </span><a href=""><i class="bi bi-pencil-square fs-6" style="color: white;"></i></a></p>
                <p class="profile-position"><i class="bi bi-person-fill"></i> &nbsp;Faculty</p>
                <p class="profile-college"><i class="bi bi-building-fill"></i> &nbsp;Bicol University College of Science</p>
            </div>
        </div>

        <div class="row gap-4" style="margin:20px 58px;">
            <div class="col-lg-4" style="height: auto; background-color: white; border-radius: 10px;">
                <div style="border-bottom: 1px solid #E8E8E8; display: flex;">
                    <img width="30" height="30" src="https://img.icons8.com/ios-filled/50/manager.png" alt="employee" style="margin: 15px 10px; color: #393939;"/>
                    <p class="mt-3 fw-bold fs-6" style="color: #393939">Employment Information</p>
                </div>

                <div style="margin: 15px 10px; ">
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Campus :</span> Main</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Unit :</span> BUCS</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Position :</span> Faculty</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Employee No. :</span> 7845-5648-5648</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Date Appointed at BU :</span> 2020-12-21</p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Member Status :</span> <span class="fw-bold" style="color: #00954D;">Active</span></p>
                    <p style="color: #393939" class="fs-7"><span class="fw-bold ">Approved Date :</span> <span class="fw-bold" style="color: #00145B;">2020-12-21</span></p>

                    <div class="d-flex justify-content-center align-items-center">
                        <button style="background-color: #FF6F19; border-radius: 10px; padding: 4px 7px; border: 1px solid white; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
                            <a href="{{ route('generateMembershipForm', ['id' => Auth::user()->member->id]) }}" style="text-decoration: none; color: white;" class="fw-bold fs-7">Download Membership Form</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" style="height: auto; background-color: white; border-radius: 10px;">
                <div style="border-bottom: 1px solid #E8E8E8; display: flex;">
                    <i class="bi bi-person-fill-exclamation" style="margin: 8px 10px; color: #393939; font-size: 30px;"></i>
                    <p class="mt-3 fw-bold fs-6" style="color: #393939">Employment Information</p>
                </div>

                <div class="row fs-7" style="margin: 15px 10px; color: #393939;">
                    <div class="col-5">
                        <p><span class="fw-bold">Name :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>Maxima X. Minima</span></p>
                    </div>

                    <div class="col-5">
                        <p><span class="fw-bold">Email :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>m****************a@bicol-u.edu.ph</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Address :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>Punta Batsan, cawayan, Masbate</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Contact Number :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>*********911</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Sex :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>Male</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Tin :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>784598568455</span></p>
                    </div>
                    <div class="col-5">
                        <p><span class="fw-bold">Birthdate :</span></p>
                    </div>
                    <div class="col-7">
                        <p><span>2021-11-27</span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection
