<!doctype html>
<html lang="en">
  <head>
  	<title>eBUPF</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ asset('assets/BU-logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Jquery - used by: datatables, select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Data tables -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
     <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

    {{-- STICKY COLUMNS FOR DATA TABLES --}}
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

  </head>


  {{-- HIDE NAV BAR WHEN SCROLLING UP --}}
  <style>

    #fixedTopElement {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #f5f5f5;
      padding: 10px;
      transition: transform 0.3s;
      z-index: 999;
    }

    .hide {
      transform: translateY(-100%);
    }



  </style>

  @php
      if(!isset($loanType)){
        $loanType = 0; 
      }
  @endphp
  {{-- HIDE NAV BAR WHEN SCROLLING UP --}}
  <body>

    <div id="fixedTopElement" class=" row  py-3 bg-white vw-100 fixed-top ">
      <span class="d-flex">
        <button type="button" id="sidebarCollapse" class="btn ms-3 d-none d-sm-block" style="background-color: #EEF6F8;">
          <img src="{{asset('../icons/bars.svg')}}" alt="menu" style="width: 1rem">
        </button>

        {{-- THE OFF CANVAS BUTTON ---- Show only on small screen --}}
        <button class="btn ms-3 d-block d-sm-none border" style="background-color: #EEF6F8;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          <img src="{{asset('../icons/bars.svg')}}" alt="menu" style="width: 1rem">
        </button>


        <img class="ms-1" src="{{asset('assets/bu-provident.svg')}}" style="width: 11rem;" alt="eBUPF">

      </span>
    </div>
    <style>
      #sidebar a{
        text-decoration: none !important;
      }
    </style>
		<div class="wrapper d-flex align-items-stretch">

      <style>
         li a{
          font-size: 14px ;
          color: rgb(48, 28, 98) !important ;
         }
         .accordion-sidebar p{
          font-size: 14px ;
          color: rgb(48, 28, 98) !important ;
          
         }
  
         .hover-menu{
          transition: background-color 500ms ease
          
         }
          .hover-menu:hover{
            background-color: #eef2ff !important;
          
          }
          
      </style>
      <nav id="sidebar" style="padding-top: 60px" class="d-none d-sm-block">
        <ul class="list-unstyled components mb-5 " style="scale: 0.93;" >
          <li class="hover-menu">

            <a href="#"><img src="{{asset('../icons/profile-holder.png')}}" class="rounded-5" style="width: 1.5rem;">
              {{ Auth::user()->member->firstname }}
              {{-- {{ Auth::user()->member->lastname }}--}}</a> 

          </li>
          
          <li class="active hover-menu">
            <a class="{{Route::is('admin-dashboard')? 'fw-bold' : ''}}" href="{{route('admin-dashboard')}}">
              <i style="font-size: 18px; color: #0082BA" class="bi bi-grid-1x2{{Route::is('admin-dashboard')? '-fill' : ''}} me-1"></i>
              Dashboard
            </a>
          </li>
          <li>

            <div class="accordion accordion-flush" id="accordionFlushExample" >

              <div class="accordion-item">
                <p class="accordion-header fw-7">
                  <button class="accordion-sidebar accordion-button text-start collapsed hover-menu" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseMember" aria-expanded="false" aria-controls="flush-collapseMember">

                    {{-- <img src="{{asset('../icons/admin-icons/members.svg')}}" style="width: 1.1rem; margin-left: 10px;"> --}}
                      <i style="font-size: 20px; color: #C066DF; margin-left: 10px;" class="bi bi-people{{Route::is('admin.membership-application') || Route::is('admin.all.users') || Route::is('admin.members')? '-fill' : ''}} me-2"></i>
                      <p class="fw-7 my-auto {{Route::is('admin.membership-application') || Route::is('admin.all.users') || Route::is('admin.members')? 'fw-bold' : ''}} ">Members</p>
                  </button>
                </p>
                <div id="flush-collapseMember" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <ul class="list-unstyled components ms-4">
                    <li>
                      <a href="{{route('admin.membership-application')}}"  class="fs-7">Membership Applications</a>
                    </li>
                    {{-- show list od all USERS regardless of user type --}}
                    <li>
                      <a href="{{route('admin.all.users')}}" class="fs-7">All Users</a>
                    </li>
                    {{-- show list of all MEMBERS --}}
                    <li>
                      <a href="{{route('admin.members')}}"  class="fs-7">Members</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
          </li>

          <li class="hover-menu">
            <a class="d-flex align-items-center {{Route::is('admin.loan.applications.tracking')? 'fw-bold' : ''}}" href="{{route('admin.loan.applications.tracking', 'mpl')}}">
              <i style="font-size: 20px; color: #FF6F19" class="bi bi-compass{{Route::is('admin.loan.applications.tracking')? '-fill' : ''}} me-2"></i> 
              Tracking Loans
            </a>
          </li>

          <li>
              <h6 class="border-top pt-3 ps-4" style="font-size: 12px; color: #ACACAC;">Loan Applications</h6>
          </li>

          <li class="hover-menu">
            <a class="d-flex align-items-center {{$loanType == 1 ? 'fw-bold' : ''}}" href="{{route('admin.loan.applications' , ['loanType' => 1, 'freeze' => 'table-freeze'])}}">
              <i style="font-size: 20px; color: #0038FF" class="bi bi-layers{{$loanType == 1? '-fill' : ''}} me-2"></i> 
              Multi-purpose Loans
            </a>
          </li>

          <li class="hover-menu">
            <a class="d-flex align-items-center {{$loanType == 2 ? 'fw-bold' : ''}}" href="{{route('admin.loan.applications' , ['loanType' => 2, 'freeze' => 'table-freeze'])}}">
              <i style="font-size: 20px; color: #FF0000" class="bi bi-house{{$loanType == 2 ? '-fill' : ''}} me-2"></i> 
              Housing Loans
            </a>
          </li>

          <li class="border-bottom hover-menu">
            <a class="d-flex align-items-center {{Route::is('admin.ledgers')? 'fw-bold' : ''}}" href="{{route('admin.ledgers')}}">
              {{-- <img src="{{asset('../icons/admin-icons/ledgers.svg')}}" style="width: 1rem;"  class="me-2">  --}}
              <i style="font-size: 20px; color: #00D186" class="bi bi-book{{Route::is('admin.ledgers')? '-half' : ''}} me-2"></i>
              Ledgers</a>
          </li>

          <li class="hover-menu">
            <a class="d-flex align-items-center {{Route::is('admin.remittance')? 'fw-bold' : ''}}" href="{{route('admin.remittance')}}">
              {{-- <img src="{{asset('../icons/admin-icons/remittances.svg')}}" style="width: 1rem;" class="me-2"> --}}
              <i style="font-size: 20px; color: #FF6F19;" class="bi bi-sticky{{Route::is('admin.remittance')? '-fill' : ''}} me-2"></i>
              Remittances</a>
          </li>
          <li class="border-bottom hover-menu">
            <a class="d-flex align-items-center {{Route::is('admin.receivables')? 'fw-bold' : ''}}" href="{{ route('admin.receivables', ['report' => 'quarterly', 'loan_type' => 'mpl']) }}">
              {{-- <img src="{{asset('../icons/admin-icons/receivables.svg')}}" style="width: 1rem;"  class="me-2">  --}}
              <i style="font-size: 20px; color: #4C7EFF;" class="bi bi-hourglass{{Route::is('admin.receivables')? '-split' : ''}} me-2"></i>
              Receivables
            </a>
          </li>
          <li class="mt-4 hover-menu py-2">
            <div class="dropup-center dropup">
              <button class="btn btn-block text-start w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #868686">
                <img class=" me-2 ms-3" src="{{asset('../icons/bars.svg')}}" alt="menu" style="width: 1rem">
                More
              </button>
              <ul class="dropdown-menu w-100 mb-1 border border-dark">
                <li><a class="dropdown-item" href="/logout">Log Out</a></li>
              </ul>
            </div>
          </li>

        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="overflow-x-hidden" style="margin-top: 5rem">
        @yield('content')

      </div>


  </div>

{{-- THE OFF CANVAS --}}
  <div class="offcanvas offcanvas-start  d-lg-none d-md-none" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
      </div>
      <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </div>
    </div>
  </div>
      {{-- HIDE ON SCROLL EVENT --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <script>
      document.addEventListener("DOMContentLoaded", function() {
          document.getElementById("fixedTopElement").classList.remove("hide");
        });

        var lastScrollTop = 0;
        window.addEventListener("scroll", function(){
          var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
          if (currentScroll > lastScrollTop){
            document.getElementById("fixedTopElement").classList.add("hide");
          } else {
            document.getElementById("fixedTopElement").classList.remove("hide");
          }
          lastScrollTop = currentScroll;
        });

        $(document).ready(function() {
            // Initialize Select2 on the dropdown
            $('#loan_id').select2({
                placeholder: 'Select a Loan ID',
                allowClear: true,
            });
            $('.select2-selection--single').css('background-color', '#D9E4E9');
            $('.select2-selection--single').css('height', '38px');
            $('.select2-selection--single').css('border-radius', '10px');
            $('.select2-selection--single').css('border', 'none');
            $('.select2-selection--single').css('padding-top', '5px');
        });
    </script>
      {{-- HIDE ON SCROLL EVENT --}}

    {{-- <script src="{{asset("js/jquery.min.js")}}"></script> --}}
    <!-- <script src="js/popper.js"></script> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="{{asset("js/main.js")}}"></script>

  </body>
</html>
