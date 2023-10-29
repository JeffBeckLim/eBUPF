@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center ">
        @if (session('passed'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('passed')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
      @endif
        <div class="col-lg-9 bg-white rounded border d-flex justify-content-center m-3 p-4">
            <div class="row w-100">    
                <div class="col-12 p-3 rounded shadow" style="background-image: url({{ asset('assets/core-feature-bg.png') }}); filter: saturate(160%)">
                    <div class="pb-3 text-white text-center" style="font-size: 14px">
                        Member ID {{ Auth::user()->member->id}}
                    </div>
                    <div class="row">        
                        <div class="col-3  text-center">
                            <img src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="profile picture" class="rounded-circle shadow img-fluid" style="object-fit:cover; width: 150px; height: 150px">
                        </div>
                        <div class="col  my-auto text-white p-2" style="text-shadow: 2px 1px rgb(48, 48, 48);">
                            <span>
                                <h6 class="fw-bold" style="font-size: 24px; ">
                                {{ Auth::user()->member->firstname}}
                                {{ Auth::user()->member->middle_initial}}.
                                {{ Auth::user()->member->lastname}}
                                <a class="text-decoration-none text-white" href="{{route('admin.update.profile')}}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                </h6>
                            </span>
                            <h6>
                                {{ Auth::user()->email}}
                            </h6>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row  g-2 pt-3" style="color: rgb(51, 51, 51); font-size: 14px;">
                        <div class="col-12 d-flex align-items-center" style="color: rgb(31, 52, 137)">
                            <i style="font-size:  27px;" class="bi bi-person-fill pe-2"></i>
                            Employee Information
                            
                        </div>
                        <div class="col-3 fw-bold">
                            Employee Number
                        </div>
                        <div class="col-9">
                            {{Auth::user()->member->employee_num}}
                        </div>

                        <div class="col-3 fw-bold">
                            TIN
                        </div>
                        <div class="col-9">
                            {{Auth::user()->member->tin_num}}
                        </div>

                        <div class="w-100 border-top mb-3">

                        </div>



                        <div class="col-3 fw-bold ">
                            Address
                        </div>
                        <div class="col-9">
                            {{Auth::user()->member->address}}
                        </div>
                        <div class="col-3 fw-bold ">
                            Date of Birth
                        </div>
                        <div class="col-9">
                            {{Auth::user()->member->date_of_birth}}
                        </div>


                        <div class="col-3 fw-bold">
                            Date Appointed at BU
                        </div>
                        <div class="col-9">
                            {{Auth::user()->member->bu_appointment_date}}
                        </div>

                        <div class="col-3  fw-bold">
                            Sex
                        </div>
                        <div class="col-3  ">
                            {{Auth::user()->member->sex}}
                        </div>

                        <div class="col-2  fw-bold">
                            Contact
                        </div>
                        <div class="col-4 ">
                            {{Auth::user()->member->contact_num}}
                        </div>
                        <div class="col-12 pt-2 text-secondary pt-3">
                            <a href="" class="btn bu-orange w-50 fw-bold text-white" style="font-size: 14px"
                            data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                Change Password
                            </a>  
                        @include('admin-views.admin-profile.modal-change-password')
                        
                    </div>

                        <div class="col-6 text-secondary" style="font-size: 12px">
                            Account Created: {{Auth::user()->created_at}}
                        </div>       
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@include('admin-components.admin-dataTables')
@endsection