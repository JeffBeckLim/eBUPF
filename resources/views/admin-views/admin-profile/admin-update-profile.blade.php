@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-9 bg-white rounded border d-flex justify-content-center m-3 p-4">
            <div class="row w-100">
                @if (session('passed'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('passed')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>    
      @endif
                <div class="col-12 p-3 rounded shadow" style="background-image: url({{ asset('assets/core-feature-bg.png') }}); filter: saturate(160%)">
                    <div class="pb-3 text-white text-center" style="font-size: 14px">
                        Member ID {{ Auth::user()->member->id}}
                    </div>
                    <div class="row">        
                        <div class="col-3  text-center">
                            <img src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="profile picture" class="rounded-circle shadow  img-fluid" width="150" height="150" style="object-fit:cover;">
                        </div>
                        <div class="col  my-auto text-white p-2" style="text-shadow: 2px 1px rgb(48, 48, 48);">
                            <span>
                                <h6 class="fw-bold" style="font-size: 24px; ">
                                {{ Auth::user()->member->firstname}}
                                {{ Auth::user()->member->middle_initial}}.
                                {{ Auth::user()->member->lastname}}
                                </h6>
                            </span>
                            <h6>
                                {{ Auth::user()->email}}
                            </h6>

                        </div>
                    </div>
                </div>
                <style>
                    .form-control{
                        background-color: white;
                        border:1px solid rgb(142, 156, 211);
                    }
                </style>
                
                {{-- {{ route('member.profile.update', ['id' => Auth::user()->member->id]) }} --}}
                <form action="{{ route('admin.update.profile.save', ['member_id' => Auth::user()->member->id]) }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="row  g-2 pt-3" style="color: rgb(51, 51, 51); font-size: 14px;">
                        <div class="col-12 d-flex align-items-center" style="color: rgb(31, 52, 137)">
                            <i style="font-size:  27px;" class="bi bi-person-fill pe-2"></i>
                            Employee Information
                        </div>
                        <div class="col-12 text-end">
                            <span>
                                <a class="btn btn-outline-danger" href="{{route('admin.profile')}}"><i class="bi bi-x"></i></a>
                                
                                <button type="submit" class="btn bu-orange text-light"> <i class="bi bi-check"></i> Save Changes</button>
                            </span>
                            
                        </div>
                        <div class="col-3 fw-bold">
                            Employee Number
                        </div>
                        <div class="col-9">
                            <input  class="form-control w-25" type="number" name="employee_num" id="employee_num" value="{{Auth::user()->member->employee_num}}">

                            @error('employee_num')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                          
                        </div>

                        <div class="col-3 fw-bold">
                            TIN
                        </div>
                        <div class="col-9">
                            <input required class="form-control w-25" type="number" name="tin_num" id="tin_num" value="{{Auth::user()->member->tin_num}}">

                            @error('tin_num')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                        </div>

                        <div class="w-100 border-top mb-3">

                        </div>



                        <div class="col-3 fw-bold ">
                            Address
                        </div>
                        <div class="col-9">
                            <input required class="form-control w-50" type="text" name="address" id="address" value="{{Auth::user()->member->address}}">
                            
                            @error('address')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                        </div>
                        <div class="col-3 fw-bold ">
                            Date of Birth
                        </div>
                        <div class="col-9">
                            <input required class="form-control w-50" type="date" name="date_of_birth" id="date_of_birth" value="{{Auth::user()->member->date_of_birth}}">

                            @error('date_of_birth')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                            
                        </div>


                        <div class="col-3 fw-bold">
                            Date Appointed at BU
                        </div>
                        <div class="col-9">
                            <input required class="form-control w-50" type="date" name="bu_appointment_date" id="bu_appointment_date" value="{{Auth::user()->member->bu_appointment_date}}">
                            @error('bu_appointment_date')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                        </div>

                        <div class="col-3  fw-bold">
                            Sex
                        </div>
                        <div class="col-3  ">
                            <select class="form-select form-control validate" aria-label="Default select example" name="sex">
                                    <option value="male"{{Auth::user()->member->sex == 'male' ? 'selected' : ''}}></option>male</option>
                                    <option value="female" {{Auth::user()->member->sex == 'male' ? 'selected' : ''}}>female</option>
                            </select>

                            @error('sex')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                        
                        </div>

                        <div class="col-2  fw-bold">
                            Contact
                        </div>
                        <div class="col-4 ">
                            <input required class="form-control w-100" type="number" name="contact_num" id="contact_num" value="{{Auth::user()->member->contact_num}}">
                            @error('contact_num')
                                <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i>{{$message}}</h6>
                            @enderror
                            
                        </div>
                        <div class="col-12 mt-3 pt-2 text-secondary text-center" style="font-size: 12px">
                            Kindly double-check and confirm that all the details you provide are both accurate and truthful. Your honesty is greatly appreciated.
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin-components.admin-dataTables')
@endsection