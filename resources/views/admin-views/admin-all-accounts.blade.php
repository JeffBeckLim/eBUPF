@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row">
        <div class="container-fluid">
            <div class="adminbox m-4">
                <div class=" d-flex">
                        <div >
                            <img src="{{asset('admin-icons/magnifying-glass.svg')}}" alt="" width="50px" height="58px">
                        </div>
                        <div class="g-0 ps-2 my-auto">
                            <div class="m-0 fw-bold fs-5" >User Accounts</div>
                            <div class="fw-bold">All user accounts in eBUPF</div>
                        </div>
                </div>
                
                <div class="filter-group gap-3">
                    <div class="form-group fg-admin" style="width: 150px; position: relative;">
                        <select id="campusSelect" class="form-control bg-white border-0">
                            <option value="All">Campus</option>
                            <option value="Main">Main</option>
                            <option value="Daraga">Daraga</option>
                            <option value="East">East</option>
                        </select>
                    </div>
                    <div class="form-group fg-admin" style="width: 150px; position: relative;">
                        <select id="unitSelect" class="form-control bg-white border-0">
                            <option value="All">Unit</option>
                            <option value="BUCS">BUCS</option>
                            <option value="CBEM">CBEM</option>
                            <option value="unit3">Unit 3</option>
                        </select>
                    </div>
                    <button id="applyFilterBtn" class="btn btn-primary " style="">Apply Filter</button>
                </div>
    

                <div class="table-responsive ">
                    <div class="custom-table-for-admin p-3">
    
                        <table class="table table-striped border-top" id="myTable">
                            
                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Membership Application</th>
                                    <th>Email</th>
                                    
                                    <th>User Type</th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>102030</td>
                                    <td><a href="#" class="fw-bold text-dark" style="text-decoration: none;">STATIC TEST</a></td>
                                    <td>STATIC TEST</td>
                                    <td>STATIC TEST</td>
                                
                                    <td>STATIC TEST</td>
                                    <td><a href="">STATIC TEST</a></td>
                                    <td class="text-center">
                                        <a href="#" class="fs-6 text-dark">
                                            <select class="form-select border-0" aria-label="Default select example" style="background-color: rgba(255, 255, 255, 0);">
                                                <option selected>User</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                              </select>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    @foreach ($users as $user)
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->member->firstname}} {{$user->member->lastname}}</td>
                                        <td>{{$user->member->membership_id}}</td>
                                        <td>
                                            {{$user->email}}
                                            <label class="text-info">
                                              verfied: {{$user->email_verified_at}}
                                            </label>
                                        </td>
                                        <td>{{$user->user_type}}</td>
                                        <td><a href="">Edit User </a></td>
                                        <td><a href="">Change Account Credential</a></td>
                                        
                                    @endforeach
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin-components.admin-dataTables')
@endsection