@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="adminbox mt-2">
        <div class="d-flex w-100">
            <div class="d-flex membership-app-header1 text-dark align-items-center">
                <i class="bi bi-clock-history " style="font-size: 40px"></i>
                <p class="text-break m-0" style="padding-left: 10px; padding-top: 5px d-flex"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Logs</span></p>
            </div>
        </div>
        <style>
            #menu-bar a{
                color: grey;
            }
        </style>
        <div class="row g-0">
            <div class="col-12" id="menu-bar">
                <a class="btn mx-1 {{Route::is('loan.logs')? 'fw-bold text-dark':''}}" href="{{route('loan.logs')}}" style="font-size: 12px"><i class="bi bi-bank"></i> Loan</a>

                <a class="btn me-1 {{Route::is('adjustment.logs')? 'fw-bold text-dark':''}}" href="{{route('adjustment.logs')}}" style="font-size: 12px"><i class="bi bi-pen"></i> Adjustments</a>
                
                <a class="btn me-1 {{Route::is('amortization.logs')? 'fw-bold text-dark':''}}" href="{{route('amortization.logs')}}" style="font-size: 12px"><i class="bi bi-calendar-week"></i> Amortization</a>

                {{-- <a class="btn me-1" href="" style="font-size: 12px"><i class="bi bi-envelope-paper"></i> Check</a> --}}
                
                <a class="btn me-1 {{Route::is('session.logs')? 'fw-bold text-dark':''}}" href="{{route('session.logs')}}" style="font-size: 12px"><i class="bi bi-box-arrow-in-right"></i> Session Logs</a>
                
                <a class="btn me-1" href="{{route('logs.remittance')}}" style="font-size: 12px"><i class="bi bi-sticky"></i> 
                    
                    Remittance</a>
            </div>
        </div>
        <div>
            @if (Route::is('loan.logs'))
                @include('admin-views.admin-logs.loan_logs');

            @elseif (Route::is('adjustment.logs'))

                @include('admin-views.admin-logs.adjustment_logs');
            @elseif (Route::is('amortization.logs'))

                @include('admin-views.admin-logs.amortization_logs');
            @elseif (Route::is('session.logs'))

                @include('admin-views.admin-logs.session_logs');
            @endif
            
        

        </div>

    </div>
</div>
<script>
    var table = $('#logs-table').DataTable({
    //  info: false,
     ordering: false,
     
    });
  
 </script>
@include('admin-components.admin-dataTables')
@endsection