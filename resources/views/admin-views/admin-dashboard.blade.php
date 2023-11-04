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
    <div class="row">
       <div class="col-lg-6 ">
         <div class="row">
            <div class="col-3">
               <div class="bg-white rounded border text-center" style="border-color: #00D186 !important">
                  <h6 class="text-end m-0 fw-bold pb-1 pt-3 mx-3">
                     <i class="bi bi-person-check-fill "></i>
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
               <div class="bg-white border  rounded h-100">
                  <div class="row  g-0 mx-3 pt-3">
                     <div class="col-6 d-flex align-items-center"> 
                        <h6 class="m-0 fw-bold">
                           Users
                        </h6>
                        <button class="btn mx-2 rounded-5" style="font-size: 12px"  disabled>
                           Total {{$user_total}}
                        </button>
                     </div>  
                     <div class="col-6 text-end"> 
                        <i class="bi bi-people-fill"></i>
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
                  <i class="bi bi-file-person-fill"></i>
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
        <div class="col-lg-6">
            <div class="bg-white h-100 border rounded    g-0">
               <div class="row  g-0 h-100">
                  
                     <div class="col-6 ps-3 pt-3"> 
                        <h6 class=" fw-bold">
                           Loan Applications
                        </h6>
                     </div>  
                     <div class="col-6 text-end pe-3 pt-3"> 
                        <span>
                           <a href="{{route('admin.loan.applications' , ['loanType' => 1, 'freeze' => 'table-freeze'])}}" class="btn btn-outline-primary">
                              <i class="bi bi-layers"></i>
                           </a>
                           <a href="{{route('admin.loan.applications' , ['loanType' => 2, 'freeze' => 'table-freeze'])}}" class="btn btn-outline-danger">
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
               <div class="col-6 ps-3 pt-3"> 
                  <h6 class=" fw-bold">
                     Tracking Applications
                  </h6>
               </div>  
               <div class="col-6 text-end pe-3 pt-3"> 
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
        <div class="col-lg-6">
            <div class="bg-white border rounded">
               <h6 class="m-0 fw-bold ps-3 pt-3">
                  Performing Loans
               </h6>
               <div class="table-responsive m-3">
               <table class="table table-borderless border-0 overflow-hidden">
                  <thead>
                    <tr>
                      <th scope="col">Loan Type</th>
                      <th scope="col">Interest</th>
                      <th scope="col">Principal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td> 
                        <i style="color: blue" class="bi bi-layers"></i>
                        Multi-purpose
                     </td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                    
                      <td><i style="color: red" class="bi bi-house"></i>
                        Housing
                     </td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
              
                      <td class="fw-bold">Totals</td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
         <div class="bg-white border rounded">
            <h6 class="m-0 fw-bold ps-3 pt-3">
               Receivables
            </h6>
            <div class="table-responsive m-3">
            <table class="table table-borderless border-0 overflow-hidden">
               <thead>
                 <tr>
                   <th scope="col">Loan Type</th>
                   <th scope="col">Interest</th>
                   <th scope="col">Principal</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   
                   <td> 
                     <i style="color: blue" class="bi bi-layers"></i>
                     Multi-purpose
                  </td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr>
                 
                   <td><i style="color: red" class="bi bi-house"></i>
                     Housing
                  </td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr>
           
                   <td class="fw-bold">Totals</td>
                   <td></td>
                   <td></td>
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
   var yValues = [55, 49, 44];
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
   var yValues3 = [55, 49, 44];
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

var trackingLabels = ["Received by Staff", "Under Evaluation", "Approved", "Released", "Rejected"];
var mplData = [10, 8, 10, 12, 10]; // Sample MPL data for each tracking status
var hslData = [10, 12, 10, 10, 10]; // Sample HSL data for each tracking status
var barColorsMpl = [
      
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