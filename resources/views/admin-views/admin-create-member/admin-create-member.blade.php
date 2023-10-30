@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container">
            <div class="row border  mx-4 bg-white rounded p-4">
                <div class="col-12">
                    <h5 class="fw-bold p-3"><i style="color: #994ede" class="bi bi-person-plus-fill"></i> Create Member Account</h5>

                    <h6 class="ms-3 text-secondary pb-3" style="font-size: 12px">
                        By creating an account here, the account will automatically become a member of BUPF. The account will be ready to use by any client member in BUPF. 
                    </h6>
                    <form action="{{route('admin.members.save')}}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="row ">


                                <div class="col-6 ">
                                    <label for="firstname">First name</label>
                                    <input class="form-control" type="text" name="firstname" id="firstname">
                                </div>
                                <div class="col-6">
                                    <label for="lastname">Last name</label>
                                    <input class="form-control" type="text" name="" id="">
                                </div>


                                <div class="col-6 ">
                                    <label for="middlename">Midle Name</label>
                                    <input class="form-control" type="text" name="middlename" id="middlename">
                                </div>
                                <div class="col-6">
                                    <label for="date_of_birth">Birth date</label>
                                    <input class="form-control" type="date" name="date_of_birth" id="date_of_birth">
                                </div>


                                <div class="col-6 ">
                                    <label for="middlename">Sex</label></label>
                                    <input class="form-control" type="text" name="sex" id="sex">
                                </div>
                                <div class="col-6 ">
                                    <label for="contact_num">Contact Number</label></label>
                                    <input class="form-control" type="number" name="contact_num" id="contact_num">
                                </div>


                                <div class="col-12">
                                    <label for="date_of_birth">Address</label>
                                    <input class="form-control" type="text" name="address" id="address">
                                </div>
                                
                                <h6 class="pt-3 fw-bold">
                                    Employment Information
                                </h6>

                                <div class="col-4">
                                    <label for="tin_num">Tin</label></label>
                                    <input class="form-control" type="text" name="tin_num" id="tin_num">
                                </div>
                                <div class="col-4 ">
                                    <label for="unit_id">Unit</label></label>
                                    <input class="form-control" type="text" name="unit_id" id="contact_num">
                                </div>
                                <div class="col-4 ">
                                    <label for="position">Position</label></label>
                                    <input class="form-control" type="number" name="position" id="position">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="row">
                            
                                <div class="col-6">
                                    <label for="monthly_salary">Monthly Salary</label></label>
                                    <input class="form-control" type="number" name="monthly_salary" id="contact_num">
                                </div>
                                <div class="col-6">
                                    <label for="employee_num">Employee No.</label></label>
                                    <input class="form-control" type="number" name="employee_num" id="employee_num">
                                </div>
                                <div class="col-6">
                                    <label for="bu_appointment_date">Date Appointed at BU</label></label>
                                    <input class="form-control" type="date" name="bu_appointment_date" id="bu_appointment_date">
                                </div>

                                <h6 class="pt-3 fw-bold">
                                    User Account Credentials
                                </h6>
                                <div class="col-12">
                                    <label for="email">Email</label></label>
                                    <input class="form-control" type="email" name="email" id="email">
                                </div>
                                <div class="col-12">
                                    <label for="passowrd">Password</label></label>
                                    <input class="form-control" type="passowrd" name="passowrd" id="passowrd">
                                </div>
                                <div class="col-12">
                                    <label for="password_confirmation">Confirm Password</label></label>
                                    <input class="form-control" type="password_confirmation" name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 my-4 text-end">
                            <a class="btn btn-outline-secondary rounded-3" style="font-size: 14px" href="">
                                Back
                            </a>
                            <button class="btn bu-orange rounded-3 text-light" style="font-size: 14px">
                                Create Member
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
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
@include('admin-components.admin-dataTables')
@endsection