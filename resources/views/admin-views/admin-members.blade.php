@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="row g-0">
        <div class="container-fluid">
            <div class="adminbox m-2 mb-5">
                <div class="d-flex">
                    <div class="d-flex membership-app-header1">
                        <img src="../icons/admin-icons/members.svg" alt="" width="50px" height="58px">
                        <p style="padding-left: 10px; padding-top: 5px;" class="d-flex justify-content-center align-items-center"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Members</span></p>
                    </div>
                </div>
                <div class="filter-group gap-3">
                    <div class="form-group" style="width: 150px; position: relative;">
                        <select id="campusSelect" class="form-control bg-white border-0">
                            <option value="All">Campus</option>
                            <option value="Main">Main</option>
                            <option value="Daraga">Daraga</option>
                            <option value="East">East</option>
                        </select>
                    </div>
                    <div class="form-group" style="width: 150px; position: relative;">
                        <select id="unitSelect" class="form-control bg-white border-0">
                            <option value="All">Unit</option>
                            <option value="BUCS">BUCS</option>
                            <option value="CBEM">CBEM</option>
                            <option value="unit3">Unit 3</option>
                        </select>
                    </div>
                    <button id="applyFilterBtn" class="btn btn-primary " style="">Apply Filter</button>
                </div>
    
                <div>
                    <div class="row mt-4 ">
                        <div class="col-md-6 d-flex">
                            <span class="show-entries d-flex "> Show 
                                <div class="input-container">
                                    <input class="show-entries-application" type="text">
                                </div> 
                              entries</span>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end ma-search">
                            <span class="search-text" style="margin-right: 20px; padding-top: 2px;">Search:</span>
                            <input type="text" class="membership-application-search-input">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="custom-table-for-admin">
                        <table class="table admin-table table-striped ">
                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th>ID <i class="fw-light">member</i> </th>
                                    <th>Name</th>
                                    <th>Campus</th>
                                    <th>Unit</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($memberUsers) != 0)
                                     @foreach ($memberUsers as $user)
                                <tr>
                                    <td>{{$user->member->id}}</td>
                                    <td>
                                        <a href="#" class="fw-bold text-dark" style="text-decoration: none;">
                                            {{$user->member->firstname}} {{$user->member->lastname}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$user->member->units->campuses->campus_code}}
                                    </td>
                                    <td>
                                        {{$user->member->units->unit_code}}
                                    </td>
                                    <td>
                                        {{$user->member->address}}
                                    </td>
                                    <td>
                                        {{$user->member->contact_num}}
                                    </td>
                                    <td><a href="#" class="fs-6 text-dark"><i class="bi bi-three-dots"></i></a></td>
                                </tr>    
                                @endforeach
                                
                                @else
                                    <td>
                                        no member found.
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                                
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#applyFilterBtn").click(function() {
                    var campusValue = $("#campusSelect").val();
                    var unitValue = $("#unitSelect").val();
    
                    $(".admin-table tbody tr").each(function() {
                        var campus = $(this).find("td:nth-child(4)").text();
                        var unit = $(this).find("td:nth-child(5)").text();
    
                        if ((campusValue === "All" || campusValue === campus) && (unitValue === "All" || unitValue === unit)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
       
       
    </div>
</div>
@endsection