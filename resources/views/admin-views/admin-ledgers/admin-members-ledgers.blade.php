@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row mt-2">
        <div class="container-fluid">
            <div class="adminbox">
                {{-- <div class="row mt-3 g-0 mx-3">
                    <style>
                        .scale-1-active{
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white
                        {{$loan_type == 'mpl' ? 'fw-bold shadow-sm scale-1-active' : ''}} 
                        " href="{{route('admin.loan.applications.tracking', 'mpl')}}">
                        <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        MPL Applications Tracking</a>
                    </div>
                    <div class="col-6">
                        <a 
                        class="btn border rounded-start-0 w-100 h-100 bg-white
                        {{$loan_type == 'hsl' ? 'fw-bold shadow-sm scale-1-active' : ''}}" 
                        href="{{route('admin.loan.applications.tracking', 'hsl')}}">
                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        HSL Applications Tracking
                    </a>
                    </div>
                </div> --}}

                <div class="row mt-3 g-0 mx-3">
                    <style>
                        .scale-1-active{
                            background-color: #e6f3ff !important;
                        }
                    </style>
                    <div class="col-6">
                        <a class="btn border rounded-end-0 w-100 h-100 bg-white
                        " href="">
                        <img src="{{asset('icons/MPL-mini.svg')}}" alt="" style="width: 20px;">
                        MPL Applications Tracking</a>
                    </div>
                    <div class="col-6">
                        <a 
                        class="btn border rounded-start-0 w-100 h-100 bg-white
                        " 
                        href="">
                        <img src="{{asset('icons/HSL-mini.svg')}}" alt="" style="width: 20px;">
                        HSL Applications Tracking
                    </a>
                    </div>
                </div>
                <div class=" d-flex text-dark mt-3">
                        {{-- <div >
                            <img src="{{asset('icons/book.svg')}}" alt="" width="50px" height="58px">
                        </div> --}}
                        <div class="g-0 ps-2 my-auto">
                            <div class="m-0 fw-bold fs-5" >Ledgers <i class="bi bi-chevron-compact-right"></i> Jeff Beck Lim</div>
                            <div style="font-size: small">Individual Member's Ledgers</div>
                        </div>
                </div>

                

                <div class="filter-group gap-3 mt-4">
                    <div class="form-group fg-admin" style="width: 150px; position: relative;">
                        <select id="campusSelect" class="form-control bg-white border-0">
                            <option value="All">All Year</option>
                            <option value="Main">2023</option>
                            <option value="Daraga">2024</option>
                            <option value="East">2025</option>
                        </select>
                    </div>
                    <button id="applyFilterBtn" class="btn btn-primary " style="">Apply Filter</button>
                </div>
    

                <div class="table-responsive ">
                    <div class="custom-table-for-admin">
    
                        <table class="table admin-table table-striped border-top" id="myTable">
                            
                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th>ID</th>
                                    <th>Details</th>
                                    <th class="text-center">. . .</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <td>
                                        
                                    </td>
                                    <td class="text-end">
                                        <a href="" style="font-size: small" class="btn bu-orange text-light fw-bold  me-4 my-1"><i class="bi bi-eye-fill"></i> View</a>
                                    </td>
                                </tr>
                             
                            </tbody>
                        </table>

                        

                    </div>
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