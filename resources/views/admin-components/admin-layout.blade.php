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

     <!-- Data tables -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
     <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
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

      <nav id="sidebar" style="padding-top: 60px" class="d-none d-sm-block">
        <ul class="list-unstyled components mb-5" style="scale: 0.95;">
          <li>

            <a href="#"><img src="{{asset('../icons/profile-holder.png')}}" class="rounded-5 me-2" style="width: 1.5rem;">
              {{ Auth::user()->member->firstname }}
              {{ Auth::user()->member->lastname }}</a>

          </li>
          <li class="active">
            <a style="color: #868686" href="#"><img src="{{asset('../icons/admin-icons/dashboard.svg')}}" style="width: 1rem;"  class="me-2"> Dashboard</a>
          </li>
          <li>

            <div class="accordion accordion-flush" id="accordionFlushExample" >

              <div class="accordion-item">
                <p class="accordion-header fw-7">
                  <button class="accordion-button text-start collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseMember" aria-expanded="false" aria-controls="flush-collapseMember">

                    <img src="{{asset('../icons/admin-icons/members.svg')}}" style="width: 1.1rem; margin-left: 10px;">

                      <p class="fw-7 my-auto ms-2">Members</p>
                  </button>
                </p>
                <div id="flush-collapseMember" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <ul class="list-unstyled components ms-4">
                    <li>
                      <a href="/admin/membership-applications"  class="fs-7">Membership Applications</a>
                    </li>
                    {{-- show list od all USERS regardless of user type --}}
                    <li>
                      <a href="/admin/all-users" class="fs-7">All Users</a>
                    </li>
                    {{-- show list of all MEMBERS --}}
                    <li>
                      <a href="/admin/members"  class="fs-7">Members</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>



              {{-- <a href="#"><img src="../icons/admin-icons/members.svg" style="width: 1.2rem;"  class="me-2">Members</a> --}}
          </li>
          <li>
            <a href="#"><img src="{{asset('../icons/admin-icons/ledgers.svg')}}" style="width: 1rem;"  class="me-2"> Ledgers</a>
          </li>
          <li>
            <div class="accordion accordion-flush" id="accordionFlushExample" >

              <div class="accordion-item">
                <p class="accordion-header fw-7">
                  <button class="accordion-button text-start collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">

                    <img src="{{asset('../icons/admin-icons/pesos.svg')}}" style="width: 1.1rem; margin-left: 10px;">

                      <p class="fw-7 my-auto ms-2">Loans</p>
                  </button>
                </p>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <ul class="list-unstyled components ms-4">
                    <li>
                      <a href="" class="fs-7">Multi-purpose Loans</a>
                    </li>
                    <li>
                      <a href=""  class="fs-7">Housing Loans</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
          </li>
          <li>

            <div class="accordion accordion-flush" id="accordionFlushExample" >

              <div class="accordion-item">
                <p class="accordion-header fw-7">
                  <button class="accordion-button text-start collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <img src="{{asset('../icons/admin-icons/loan-applications.svg')}}" style="width: 1.3rem; margin-left: 5px;">
                      <p class="fw-7 my-auto ms-2">Loan Applications</p>
                  </button>
                </p>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <ul class="list-unstyled components ms-4">
                    <li>
                      <a href="{{route('admin.mpl.applications')}}" class="fs-7">Multi-purpose Loans</a>
                    </li>
                    <li>
                      <a href="{{route('admin.hsl.applications')}}"  class="fs-7">Housing Loans</a>
                    </li>
                  </ul>
                </div>
              </div>

            </div>


          </li>
          <li>
            <a href="{{route('admin.remittance')}}"><img src="{{asset('../icons/admin-icons/remittances.svg')}}" style="width: 1rem;" class="me-2"> Remittances</a>
          </li>
          <li class="border-bottom">
            <a href="#"><img src="{{asset('../icons/admin-icons/receivables.svg')}}" style="width: 1rem;"  class="me-2"> Receivables</a>
          </li>
          <li class="mt-4">
            <div class="dropup-center dropup">
              <button class="btn btn-block text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #868686">
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

    </script>
      {{-- HIDE ON SCROLL EVENT --}}

    {{-- <script src="{{asset("js/jquery.min.js")}}"></script> --}}
    <!-- <script src="js/popper.js"></script> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="{{asset("js/main.js")}}"></script>

  </body>
</html>
