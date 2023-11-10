@extends('admin-components.admin-layout')

@section('content')
<div class="container px-5 pb-4">

   <style>
      .row{
         font-size: 0.9rem;
      }
      .label{
         font-size: 12px;
         color: rgb(74, 74, 74);
      }
      .count{
         font-size: 20px
      }

   </style>
   <div class="row">
      <div class="col-6">
         <div class="d-flex align-items-center">
            <img style="width: 3rem; height: 3rem; object-fit: cover" class="me-1 rounded-circle" src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="icon">
            <h4 class="fw-bold m-0" style="font-size: 24px">
               Hello, {{Auth::user()->member->firstname}}!
            </h4>
         </div>
         <h6 class="mt-2 pb-3" style="font-size: 14px">
            Welcome to eBUPF, your online website for managing BUPF loans.
         </h6>
      </div>
      <div class="col-6 text-end"> 
         <button class="btn btn-outline-secondary rounded-5" disabled style="font-size: 10px">
            Ver. 1
         </button>
      </div>
   </div>
    <div class="row">
      <div class="col-6 mb-2" style="font-size: 12px">
         @if ($latest_user)
            @php
                                                      
            $time = \Carbon\Carbon::parse($latest_user->created_at);
            $now = \Carbon\Carbon::now();
            $diff = $now->shortAbsoluteDiffForHumans($time); 
                                                      
            @endphp
            <i class="bi bi-info-circle"></i> Latest account created was <span class="fw-bold">{{$diff}} ago</span>,
            {{$latest_user->email}}             
         @endif
      </div>

      <div class="col-6" style="font-size: 12px">
         @if ($latest_member_app)
            @php
                                                      
            $time_app = \Carbon\Carbon::parse($latest_member_app->created_at);
            $now = \Carbon\Carbon::now();
            $diff_app = $now->shortAbsoluteDiffForHumans($time_app); 
                                                      
            @endphp
            <i class="bi bi-info-circle"></i> Last membership application recorded in the system <span class="fw-bold">{{$diff_app}} ago</span> 
         @endif
      </div>
       <div class="col-lg-6 ">
         <div class="row g-1">
            <div class="col-3">
               <div class="bg-white rounded border text-center h-100" style="border-color: #00D186 !important">
                  <h6 class="text-end m-0 fw-bold pb-1 pt-3 mx-3">
                     <a href="" class="btn btn-outline">
                        <i class="bi bi-person-check-fill "></i>
                     </a>
                  </h6>
                  <h2 class=" m-0 fw-bold pt-3 count">
                     {{$member_count}}
                  </h2>
                  <a class="text-decoration-none" href="{{route('admin.members.create')}}">
                     <h6 class=" m-0 fw-bold pb-3 pt-3 label">
                        Members  <i class="bi bi-plus-circle"></i>
                     </h6>
                  </a>
                  
               </div>
            </div>
            <div class="col">
               <div class="bg-white border w-100 p-2 rounded h-100">
                  <div class="row  g-0 mx-3 pt-2">
                     <div class="col-9 d-flex align-items-center"> 
                        <h6 class="m-0 fw-bold">
                           Users
                        </h6>
                        <button class="btn mx-2 rounded-5" style="font-size: 12px"  disabled>
                           Total {{$user_total}}
                        </button>
                     </div>  
                     <div class="col-3 text-end"> 
                        <a href="{{route('admin.all.users')}}" class="btn btn-outline-dark">
                           <i class="bi bi-people-fill" style="font-size:12px"></i>
                        </a>
                     </div>  
                  </div>
                  <div class="row g-0 text-center">
                     <div class="col-4">
                        <h2 class=" m-0 fw-bold pt-3 count">
                           {{$admin_count}}
                        </h2>
                        <h6 class=" m-0  pb-3 pt-3 label">
                           <i class="bi bi-person-square"></i>  Admins 
                        </h6>
                     </div>
                     <div class="col-4">
                        <h2 class="text-center m-0 fw-bold pt-3 count">
                           {{$non_member_count}}
                        </h2>
                        <h6 class=" m-0  pb-3 pt-3 label">
                           <i class="bi bi-person"></i> Non-members
                        </h6>
                     </div>
                     <div class="col-4">
                        <h2 class="text-center m-0 fw-bold pt-3 count">
                           {{$restricted_count}}
                        </h2>
                        <h6 class=" m-0  pb-3 pt-3 label text-danger ">
                           <i class="bi bi-slash-circle"></i> Restricted
                        </h6>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
       </div>
       <div class="col-lg-6  ">
         <div class="bg-white border h-100 rounded">
            <div class="row  g-0 mx-3 pt-3">
               <div class="col-6"> 
                  <h6 class="m-0 fw-bold">
                     Membership
                  </h6>
               </div>  
               <div class="col-6 text-end"> 
                  <a href="{{route('admin.membership-application')}}" class="btn btn-outline-dark">
                     <i class="bi bi-file-person-fill"></i>
                  </a>
               </div>  
            </div>


            <div class="row text-center">
               
               <div class="col-3" style="color: #730dbb">
                  <h2 class=" m-0 fw-bold pt-3 count">
                     {{$membership_pending_count}}
                  </h2>
                  <h6 class=" m-0   pb-3 pt-3 label" style="color: #730dbb">
                     <i class="bi bi-clock"></i> Pending
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class=" m-0 fw-bold pt-3 count">
                     {{$membership_approved_count}}
                  </h2>
                  <h6 class=" m-0   pb-3 pt-3 label">
                     <i class="bi bi-check2-all"></i> Approved
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class=" m-0 fw-bold pt-3 count">
                     {{$membership_rejected_count}}
                  </h2>
                  <h6 class=" m-0   pb-3 pt-3 label">
                     <i class="bi bi-x-lg"></i> Rejected
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class=" m-0 fw-bold pt-3 count">
                     {{$membership_total}}
                  </h2>
                  <h6 class=" m-0   pb-3 pt-3 label">
                     Total
                  </h6>
               </div>
            </div>
         </div>
       </div>
    </div>

   

    <div class="row mt-2">
      <div class="col-12 mb-2 mt-2" style="font-size: 12px">
        @if ($latest_loan_app)
            @php
                                                         
            $time_loan_app = \Carbon\Carbon::parse($latest_loan_app->created_at);
            $now = \Carbon\Carbon::now();
            $diff_loan_app = $now->shortAbsoluteDiffForHumans($time_loan_app); 
                                                      
            @endphp
            <i class="bi bi-info-circle"></i> Last loan application was <span class="fw-bold">{{$diff_loan_app}} ago</span>   
        @endif
      </div>

        <div class="col-lg-6">
            <div class="bg-white h-100 border rounded    g-0">
             
               <div class="row  g-0 h-100">
                  
                     <div class="col-8 ps-3 pt-3"> 
                        <h6 class=" fw-bold">
                           Loan Applications
                           <button class="btn mx-2 rounded-5" style="font-size: 12px"  disabled>
                              Total Approved {{array_sum($pie_mpl) + array_sum($pie_hsl) }}
                           </button>
                          
                        </h6>
                        <span class="fw-light m-0 p-0" style="font-size: 12px">
                           <i class="bi bi-info-circle"></i> Loans here are those with APPROVED status.
                        </span>
                     </div>  
                     <div class="col text-end pe-3 pt-3">
                        <h6 style="font-size: 10px">
                           Num. of Approved Application   
                        </h6> 
                        <span>
                           <a href="{{route('admin.loan.applications' , ['loanType' => 1, 'freeze' => 'table-freeze'])}}" class="btn btn-outline-primary">
                              @if(array_sum($pie_mpl) != 0)
                                 {{array_sum($pie_mpl)}}    
                              @endif
                              <i class="bi bi-layers"></i>
                           </a>
                           <a href="{{route('admin.loan.applications' , ['loanType' => 2, 'freeze' => 'table-freeze'])}}" class="btn btn-outline-danger">
                              @if(array_sum($pie_hsl) != 0)
                                 {{array_sum($pie_hsl)}}    
                              @endif
                              <i class="bi bi-house"></i>
                           </a>
                           
                        </span>
                     </div>  
                  
                  <div class="col-6  d-flex justify-content-center">
                     <canvas id="myChart" style="width:100%;max-width:250px;"></canvas>
                  </div>
                  <div class="col-6  d-flex justify-content-center">
                     <canvas id="myChart2" style="width:100%;max-width:250px;"></canvas>
                  </div>
               </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
               <div class="col-10 ps-3 pt-3"> 
                  <h6 class=" fw-bold">
                     Tracking Applications
                     @if ($no_status_mpl > 0)
                     <button class="btn rounded-5 btn-outline-danger" style="font-size: 12px"  disabled>
                        {{$no_status_mpl}} Null status <i class="bi bi-layers"></i>
                     </button>    
                     @endif   
                     @if ($no_status_hsl > 0)
                     <button class="btn rounded-5 btn-outline-danger" style="font-size: 12px;"  disabled>
                        {{$no_status_hsl}} Null status <i class="bi bi-house"></i>
                     </button>    
                     @endif   
                  </h6>
                  <span>
                     <h6 style="font-size: 10px">Num of loan applications</h6>
                     <a href="{{route('admin.loan.applications.tracking', 'mpl')}}" class="btn btn-outline-primary">
                        @if($count_application_mpl > 0)
                           {{$count_application_mpl}}  
                        @endif
                        <i class="bi bi-layers"></i>
                     </a>
                     <a href="{{route('admin.loan.applications.tracking', 'hsl')}}" class="btn btn-outline-danger">
                        @if($count_application_hsl > 0)
                           {{$count_application_hsl}}  
                        @endif
                        <i class="bi bi-house"></i>
                     </a>
                     
                  </span>
               </div>  
               <div class="col-2 text-end pe-3 pt-3"> 
                  <span>
                     <a class="btn bu-orange text-light" href="{{route('admin.loan.applications.tracking', 'mpl')}}">
                        <i class="bi bi-compass"></i>
                     </a>
                  </span>
               </div>
               <div class="col-12">
                  <div class=" h-100">
                     <canvas id="myChart3" style="width:100%;max-width:100%"></canvas>
                  </div>
               </div>
            </div>
        </div>
     </div>


     <div class="row  mt-2">
      <div class="col-12 mb-2 mt-1" style="font-size: 12px">
         @if ($latest_active_loan)
            @php
                                                      
            $time_loan_active = \Carbon\Carbon::parse($latest_active_loan->created_at);
            $now = \Carbon\Carbon::now();
            $diff_loan_active = $now->shortAbsoluteDiffForHumans($time_loan_active); 
                                                      
            @endphp
            <i class="bi bi-info-circle"></i> Latest performing loan was applied <span class="fw-bold">{{$diff_loan_active}} ago</span> 
         @endif
      </div>
        <div class="col-lg-6">
            <div class="bg-white border rounded">
               
               <h6 class="m-0 fw-bold ps-3 pt-3">
                  Performing Loans
                  
               </h6>
               <div class="table-responsive m-3">
               <table class="table table-borderless border-0 overflow-hidden">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col"><i style="color: blue" class="bi bi-layers"></i>
                        Multi-purpose</th>
                      <th scope="col"><i style="color: red" class="bi bi-house"></i>
                        Housing</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td> 
                        Principal
                     </td>
                     <td>{{$performing_mpl_principal}}</td>
                     <td>{{$performing_hsl_principal}}</td>
                    </tr>
                    <tr>
                    
                      <td>
                        Interest
                     </td>
                     <td>{{$performing_mpl_interest}}</td>
                     <td>{{$performing_hsl_interest}}</td>
                    </tr>
                    <tr>
              
                      <td class="fw-bold">Totals</td>
                      <td>{{$performing_mpl_principal + $performing_mpl_interest}}</td>
                      <td>{{$performing_hsl_principal + $performing_hsl_interest}}</td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-white border rounded">
               <div class="row  g-0">
                  <div class="col-6">
                     <h6 class="m-0 fw-bold ps-3 pt-3">
                        Receivables <span class="text-secondary fw-light" style="font-size: 12px">Performing Loans</span>
                     </h6>
                  </div>
                  <div class="col-6 mt-3 px-3 text-end">
                     <a href="{{route('admin.receivables', ['report' => 'quarterly', 'loan_type' => 'mpl'])}}" class="btn btn-outline-primary">
                        <i class="bi bi-hourglass"></i>
                     </a>
                  </div>
               </div>
               
               <div class="table-responsive m-3">
               <table class="table table-borderless border-0 overflow-hidden">
                  <thead>
                  <tr>
                     <th scope="col"></th>
                     <th scope="col"><i style="color: blue" class="bi bi-layers"></i>
                        Multi-purpose</th>
                     <th scope="col"><i style="color: red" class="bi bi-house"></i>
                        Housing</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                     
                     <td> 
                        Principal
                     </td>
                     <td>{{$performing_mpl_principal - $mpl_principal_pay}}</td>
                     <td>{{$performing_hsl_principal - $hsl_principal_pay}}</td>
                  </tr>
                  <tr>
                  
                     <td>
                        Interest
                     </td>
                     <td>{{$performing_mpl_interest - $mpl_interest_pay}}</td>
                     <td>{{$performing_hsl_interest - $hsl_interest_pay}}</td>
                  </tr>
                  <tr>
            
                     <td class="fw-bold">Totals</td>
                     <td>
                        {{ ($performing_mpl_principal - $mpl_principal_pay) + ($performing_mpl_interest - $mpl_interest_pay) }}
                     </td>
                     <td>
                        {{ ($performing_hsl_principal - $hsl_principal_pay) + ($performing_hsl_interest - $hsl_interest_pay) }}
                     </td>
                  </tr>
                  </tbody>
               </table>
               </div>
            </div>
      </div>


      
     </div>

     

</div>


<script>

      // PIE CHART 1
   var xValues = [ "Performing", "Closed", "Unevaluated"];
   var yValues =  @json($pie_mpl);
   var barColors = [
     "#FF6F19",
     "#E2E2E2",
     "#0092D1",
   ];
   
   new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "MPL"
    },
    responsive: true, // Allow the chart to be responsive
    maintainAspectRatio: false, // Allow the aspect ratio to be determined by CSS
    legend: {
      display: true,
      position: "top", // Position the legend at the top
    },
    scales: {
      y: {
        beginAtZero: true, // Start the Y-axis at zero
      }
    }
  }
});


// PIE CHART 2
var xValues3 = [ "Performing", "Closed", "Unevaluated"];
   var yValues3 = @json($pie_hsl);
   var barColors = [
      "#FF6F19",
     "#E2E2E2",
     "#0092D1",
   ];
   
   new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues3,
    datasets: [{
      backgroundColor: barColors,
      data: yValues3
    }]
  },
  options: {
    title: {
      display: true,
      text: "HL"
    },
    responsive: true, // Allow the chart to be responsive
    maintainAspectRatio: false, // Allow the aspect ratio to be determined by CSS
    legend: {
      display: true,
      position: "top", // Position the legend at the top
    },
    scales: {
      y: {
        beginAtZero: true, // Start the Y-axis at zero
      }
    }
  }
});



// bar char 3

var trackingLabels = ["Staff", "Analyst", "Approved Exe.", "Check Ready","Check Picked Up", "Rejected"];
var mplData = @json($bar_mpl); // Sample MPL data for each tracking status
var hslData = @json($bar_hsl); // Sample HSL data for each tracking status
var barColorsMpl = [
      
      "#FF6F19",
      "#FF6F19",
      "#FF6F19",
      "#FF6F19",
      "#FF6F19",

      "#1E1E1E",
      
   ];
var barColorsHsl = [
     
      "#4C7EFF",
      "#4C7EFF",
      "#4C7EFF",
      "#4C7EFF",
      "#4C7EFF",

      "#878787",
   ];
new Chart("myChart3", {
  type: "bar",
  data: {
    labels: trackingLabels,
    datasets: [
      {
        label: "MPL",
      //   backgroundColor: "rgba(255, 99, 132, 0.5)", // You can set specific colors here
        data: mplData,
        backgroundColor: barColorsMpl,
        
      },
      {
        label: "HSL",
        backgroundColor: barColorsHsl,
      //   backgroundColor: "rgba(54, 162, 235, 0.5)", // You can set specific colors here
        data: hslData,
      },
      
    ],

  },
  options: {
    scales: {
      x: {
        stacked: true, // Stack the bars on the x-axis
      },
      y: {
        stacked: true, // Stack the bars on the y-axis
      },
    },
    responsive: true, // Allow the chart to be responsive
    maintainAspectRatio: false, // Allow the aspect ratio to be determined by CSS
    legend: {
      display: true,
      position: "top", // Position the legend at the top
    },
  },
});

   </script>

@endsection