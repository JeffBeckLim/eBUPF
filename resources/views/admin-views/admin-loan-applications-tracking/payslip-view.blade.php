<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>eBUPF</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <div class="container">
        <div>
            <h4 class="fw-bold">PAY SLIP</h4>
            Loan Application
            <h6>{{$loan->loan_code}}</h6>
        </div>
        <div class="d-flex justify-content-center">
            <img style="width: 600px" src="{{asset('storage/'.$loan->payslip)}}" alt="No imgage" class="img-fluid border border-dark"> 
        </div>
    </div>
  </body>
</html>