@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid px-2" >
    <div class="row mt-2">
    
        <div class="container-fluid">
            <div class="adminbox">
                <div class="row mx-3 mt-1 mb-2 pb-1 border-bottom g-0">
                    <p class="m-0 text-secondary" style="font-size: 12px">Note: The Loan account ledger displayed here are those with "Check Picked Up" status only. </p>
                </div>
                <div class=" d-flex text-dark">
                        <div >
                            <img src="{{asset('icons/book.svg')}}" alt="" width="50px" height="58px">
                        </div>
                        <div class="g-0 ps-2 my-auto">
                            <div class="m-0 fw-bold fs-5" >Member Ledgers</div>
                            <div style="font-size: small" class="fw-bold">Ledgers in eBUPF</div>
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
                    <div class="custom-table-for-admin">
    
                        <table class="table admin-table table-striped border-top" id="myTable">
                            
                            <thead style="border-bottom: 2px solid black">
                                <tr>
                                    <th style="width:5%">ID</th>
                                    <th style="width: 20%">Name</th>
                                    <th style="width: 10%">MPL</th>
                                    <th style="width: 10%">HSL</th>
                                    <th class="text-center" style="width: 30%">. . . </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($members) != 0)    
                                    @foreach ($members as $member)
                                    <tr>
                                        <td>
                                            {{$member->id}}
                                        </td>
                                        <td class="fw-bold">
                                            {{$member->lastname}} , {{$member->firstname}}
                                            <h6 class="text-secondary" style="font-size: small">{{$member->user->email}}</h6>
                                            <h6 style="font-size: x-small">{{$member->units->unit_code}} {{$member->units->campuses->campus_code}}</h6>
                                        </td>
                                        <td>
                                            @php
                                                $mpl_count = 0;
                                                foreach ($member->loans as $loan) {
                                                    if($loan->loanType->id == 1 && $loan->amortization != null){
                                                        if (count($loan->loanApplicationStatus)==5 ) {
                                                            $mpl_count++;   
                                                        }
                                                    }
                                                }
                                            @endphp
                                            {{$mpl_count}}
                                        </td>
                                        <td>
                                            @php
                                                $hsl_count = 0;
                                                foreach ($member->loans as $loan) {
                                                    if($loan->loanType->id == 2 && $loan->amortization != null){
                                                        if (count($loan->loanApplicationStatus)==5  ) {
                                                            $hsl_count++;   
                                                        }
                                                    }
                                                }
                                            @endphp
                                        {{$hsl_count}}
                                        </td>
                                        <td class="text-end">
                                            <a href="/admin/ledgers/member/mpl/{{$member->id}}" style="font-size: small" class="btn bu-orange text-light fw-bold  me-4 my-1">View Ledgers</a>
                                        </td>
                                    </tr>
                                    @endforeach 
                                @endif

                             
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