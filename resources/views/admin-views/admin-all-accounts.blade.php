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
                             
                                @foreach ($users as $user)
                                <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->member->firstname}} {{$user->member->lastname}}</td>
                                        <td>
                                            @if($user->member->membershipApplication)
                                            {{$user->member->membershipApplication->created_at}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->email}}
                                            <label class="text-info">
                                              verfied: {{$user->email_verified_at}}
                                            </label>
                                        </td>
                                        <td>
                                            @if ($user->user_type == 'restricted')
                                                <span class="text-danger">{{$user->user_type}}</span>
                                                
                                            @else
                                            {{$user->user_type}}    
                                            
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-link" href=""><i class="bi bi-pencil"></i> Edit</a></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button style="font-size: 12px" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#{{$user->id}}">
                                                Change User Type
                                            </button>
                                        </td>
                                </tr>
                                
                                 <!-- Modal in views/admin-compinents/admin-modalAllUsers -->
                                @include('admin-components.admin-modalAllUsers')
                                
                            @endforeach
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