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