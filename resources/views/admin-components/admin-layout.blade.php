<!doctype html>
<html lang="en">
  <head>
  	<title>eBUPF</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="{{ asset('assets/BU-logo.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Jquery - used by: datatables, select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- Data tables -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
     <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

    {{-- STICKY COLUMNS FOR DATA TABLES --}}
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

    {{-- CHARTS .js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

    li a{
      text-decoration: none;
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
          <img src="{{asset('assets/admin-icons/bars.svg')}}" alt="menu" style="width: 1rem">
        </button>

        {{-- THE OFF CANVAS BUTTON ---- Show only on small screen --}}
        <button class="btn ms-3 d-block d-sm-none border" style="background-color: #EEF6F8;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          <img src="{{asset('assets/admin-icons/bars.svg')}}" alt="menu" style="width: 1rem">
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
        @include('admin-components.admin-sidebar-items')
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="overflow-x-hidden" style="margin-top: 5rem">
        @yield('content')

      </div>


  </div>

{{-- THE OFF CANVAS --}}
  <div class="offcanvas offcanvas-start  d-lg-none d-md-none rounded" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="width: 90%">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-secondary" id="offcanvasExampleLabel" style="font-size: 14px">eBUPF</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-0 p-0">

      <nav id="sidebar-sm" >
        @include('admin-components.admin-sidebar-items')
      </nav>

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
                placeholder: 'Select a Loan Code',
                allowClear: true,
            });
            $('.select2-selection--single').css('background-color', '#D9E4E9');
            $('.select2-selection--single').css('height', '38px');
            $('.select2-selection--single').css('border-radius', '10px');
            $('.select2-selection--single').css('border', 'none');
            $('.select2-selection--single').css('padding-top', '5px');
        });
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });

    </script>
      {{-- HIDE ON SCROLL EVENT --}}

    {{-- <script src="{{asset("js/jquery.min.js")}}"></script> --}}
    <!-- <script src="js/popper.js"></script> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="{{asset("js/main.js")}}"></script>

  </body>
</html>
