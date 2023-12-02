@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container">
            <div class="row border  mx-4 bg-white rounded p-4">
                
                @if (session('passed'))
                <div class="col-12">
                    <div class="alert alert-dismissible fade show" role="alert" style="background-color: #cfffd6; border: 1px solid #4ede68">
                        {{session('passed')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>    
                @endif
                @if (session('failed'))
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('failed')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>    
                @endif
                
                <div class="col-12">
                    <h5 class="fw-bold p-3"> 
                        <i style="color: #4ede8a" class="bi bi-person-check-fill"></i>
                        Update Member Account
                    </h5>

                    <h6 class="ms-3 text-secondary pb-3" style="font-size: 12px">
                        Please make sure any changes is valid and true as this will be seen by the member.
                    </h6>
                    <form action="{{route('admin.members.update.save', $member->id)}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="row ">


                                <div class="col-6 ">
                                    <label for="firstname">First name <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" type="text" name="firstname" id="firstname" value="{{$member->firstname}}">
                                    @error('firstname')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="lastname">Last name <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" value="{{$member->lastname}}" >
                                    @error('lastname')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>


                                <div class="col-6 ">
                                    <label for="middlename">Midle Name <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" type="text" name="middlename" id="middlename" value="{{$member->middlename}}" >
                                    @error('middlename')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="date_of_birth">Birth date <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" type="date" name="date_of_birth" id="date_of_birth"  value="{{$member->date_of_birth}}">
                                    @error('date_of_birth')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>


                                <div class="col-6 ">
                                    <label for="middlename">Sex <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-select form-control" aria-label="Default select example" name="sex">
                                        <option value="male" {{ $member->sex == 'male'? 'selected' : '' }}>male</option>
                                        <option value="female" {{ $member->sex == 'female'? 'selected' : '' }}>female</option>
                                    </select>
                                      @error('sex')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-6 ">
                                    <label for="contact_num">Contact Number <span class="text-danger fw-bold">*</span></label>
                                    <div class="input-group ">
                                    @php
                                        $contact = (int)substr($member->contact_num,3);
                                     @endphp
                                    <span class="input-group-text" id="inputGroupPrepend" style="background-color: #ffffff">+63</span>
                                    <input class="form-control" type="number" name="contact_num" id="contact_num" aria-describedby="inputGroupPrepend"  pattern="9[0-9]{10}" title="Please enter 10 digits starting with '9'."  value="{{$contact}}" required>
                                    @error('contact_num')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                     @enderror
                                    </div>
                                </div>


                                <div class="col-12">
                                    <label for="address">Address <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" value="{{$member->address}}" type="text" name="address" id="address">
                                    @error('address')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                
                                <h6 class="pt-3 fw-bold">
                                    Employment Information
                                </h6>

                                <div class="col-4">
                                    <label for="tin_num">Tin <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" value="{{$member->tin_num}}" type="number" name="tin_num" id="tin_num">
                                    @error('tin_num')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-4 ">
                                    <label for="unit_id">Unit <span class="text-danger fw-bold">*</span></label>
                                    <select class="form-control form-select" name="unit_id" id="unit_id">
                                        <option selected>ex. BUCS</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->id}}" {{$member->unit_id == $unit->id? 'selected' : ''  }}>{{$unit->unit_code}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-4 ">
                                    <label for="position">Position</label>
                                    <input class="form-control" type="text" name="position" id="position" value="{{$member->position}}">
                                    @error('position')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="row">
                            
                                <div class="col-6">
                                    <label for="monthly_salary">Monthly Salary <span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control" type="number" name="monthly_salary" id="monthly_salary" value="{{$member->monthly_salary}}"> 
                                    @error('monthly_salary')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="employee_num">Employee No.</label>
                                    <input class="form-control" type="number" name="employee_num" id="employee_num" value="{{$member->employee_num}}">
                                    @error('employee_num')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>


                                <div class="col-6">
                                    <label for="bu_appointment_date">Date Appointed at BU</label>
                                    <input class="form-control" type="date" name="bu_appointment_date" id="bu_appointment_date" value="{{$member->bu_appointment_date}}">
                                    @error('bu_appointment_date')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label  for="appointment_status">Status of Appointment</label>
                                    <select name="appointment_status" class="form-select form-control validate" aria-label="Default select example" value="{{old('appointment_status')}}">
                                        <option value="casual">Casual</option>
                                        <option value="permanent">Permanent</option>
                                    </select>
                                    @error('appointment_statu')
                                        <h6 style="font-size: 14px" class="text-danger pt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</h6>
                                    @enderror
                                </div>

                                

                                <h6 class="pt-3 fw-bold">
                                    User Account Credentials <span class="text-primary fw-bold" style="font-size: 12px">Read only.</span>
                                </h6>
                                <div class="col-12">
                                    <label for="email">BU. Email</label>
                                    <input class="form-control-plaintext" type="email" name="email" id="email" value="{{$member->user->email}}" readonly>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 my-4 text-end">
                            {{-- <p style="font-size: 12px" class="text-secondary text-start">
                                By clicking Create, this member account created agrees to the terms and conditions of Bicol University Provident Fund and online terms of use of eBUPF website.
                            </p> --}}
                            <a class="btn btn-outline-secondary rounded-3" style="font-size: 14px" href="{{route('admin.members')}}">
                                Back
                            </a>
                            <button class="btn bu-orange rounded-3 text-light" style="font-size: 14px">
                                Save Changes
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    
    
    </div>
</div>
<script>
    const numericInput = document.getElementById('contact_num');
  
    numericInput.addEventListener('input', function () {
      const value = numericInput.value;
      if (!/9[0-9]{0,10}/.test(value) || value.length != 10 || value[0] != 9) {
        numericInput.setCustomValidity('Please enter valid PH sim number format');
      } else {
        numericInput.setCustomValidity('');
      }
    });
  </script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@include('admin-components.admin-dataTables')
@endsection