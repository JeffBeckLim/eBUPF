@extends('admin-components.admin-layout')

@section('content')
<div class="container-fluid border border-danger vh-100 " >

    <div class="row border border-primary mt-3">
       <div class="col-lg-6 border">
         <div class="row">
            <div class="col-3 border">
               <div class="bg-white rounded border">
                  <h2 class="text-center m-0 fw-bold">
                     10
                  </h2>
                  <h6 class="text-start m-0 pt-2">
                     Members
                  </h6>
               </div>
            </div>
            <div class="col border">
               <div class="bg-white border h-100">
                  <div class="row">
                     <div class="col-4">
                        <h2 class="text-center m-0 fw-bold">
                           10
                        </h2>
                        <h6 class="text-start m-0 pt-2">
                           Admins
                        </h6>
                     </div>
                     <div class="col-4">
                        <h2 class="text-center m-0 fw-bold">
                           10
                        </h2>
                        <h6 class="text-start m-0 pt-2">
                           Non-members
                        </h6>
                     </div>
                     <div class="col-4">
                        <h2 class="text-center m-0 fw-bold">
                           10
                        </h2>
                        <h6 class="text-start m-0 pt-2">
                           Restricted
                        </h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
       </div>
       <div class="col-lg-6 border ">
         <div class="bg-white border m-1">
            <div class="row">
               <div class="col-3">
                  <h2 class="text-center m-0 fw-bold">
                     10
                  </h2>
                  <h6 class="text-start m-0 pt-2">
                     Total
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class="text-center m-0 fw-bold">
                     10
                  </h2>
                  <h6 class="text-start m-0 pt-2">
                     Pending
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class="text-center m-0 fw-bold">
                     10
                  </h2>
                  <h6 class="text-start m-0 pt-2">
                     Approved
                  </h6>
               </div>
               <div class="col-3">
                  <h2 class="text-center m-0 fw-bold">
                     10
                  </h2>
                  <h6 class="text-start m-0 pt-2">
                     Rejected
                  </h6>
               </div>
            </div>
         </div>
       </div>
    </div>

   

    <div class="row border border-primary ">
        <div class="col-lg-6 border border-danger">
            <div class="bg-white h-100 border rounded  g-0">
               <div class="row border g-0 h-100">
                  <div class="col-6 border d-flex justify-content-center">
                     <canvas id="myChart" style="width:100%;max-width:250px;"></canvas>
                  </div>
                  <div class="col-6  d-flex justify-content-center">
                     <canvas id="myChart2" style="width:100%;max-width:250px;"></canvas>
                  </div>
               </div>
            </div>
        </div>
        <div class="col-lg-6 border">
            <div class="bg-white rounded border h-100">
               <canvas id="myChart3" style="width:100%;max-width:100%"></canvas>
            </div>
        </div>
     </div>


     <div class="row border mt-2">
        <div class="col-lg-6 border ">
            <div class="bg-white border">
               <div class="table-responsive m-3">
               <table class="table table-borderless border-0 overflow-hidden">
                  <thead>
                    <tr>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                    
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
              
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 border ">
            <div class="bg-white border m-1 rounded">
               <div class="table-responsive m-3">
                  <table class="table table-borderless border-0 overflow-hidden">
                     <thead>
                       <tr>
                         <th scope="col">First</th>
                         <th scope="col">Last</th>
                         <th scope="col">Handle</th>
                       </tr>
                     </thead>
                     <tbody>
                       <tr>
                         
                         <td>Mark</td>
                         <td>Otto</td>
                         <td>@mdo</td>
                       </tr>
                       <tr>
                       
                         <td>Jacob</td>
                         <td>Thornton</td>
                         <td>@fat</td>
                       </tr>
                       <tr>
                 
                         <td colspan="2">Larry the Bird</td>
                         <td>@twitter</td>
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
     "#b91d47",
     "#00aba9",
     "#2b5797",
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
     "#b91d47",
     "#00aba9",
     "#2b5797",
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

var trackingLabels = ["Received by Staff", "Under Evaluation", "Approved", "Released"];
var mplData = [10, 8, 15, 12]; // Sample MPL data for each tracking status
var hslData = [10, 12, 10, 14]; // Sample HSL data for each tracking status

new Chart("myChart3", {
  type: "bar",
  data: {
    labels: trackingLabels,
    datasets: [
      {
        label: "MPL",
        backgroundColor: "rgba(255, 99, 132, 0.5)", // You can set specific colors here
        data: mplData,
        
      },
      {
        label: "HSL",
        backgroundColor: "rgba(54, 162, 235, 0.5)", // You can set specific colors here
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