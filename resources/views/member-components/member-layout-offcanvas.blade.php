
  <!-- AUTOMATICALLY CLOSE OFFCANVAS ON MEDIUM-UP SCREEN -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var offcanvasElement = document.getElementById('offcanvasWithBackdrop');
        var offcanvas = new bootstrap.Offcanvas(offcanvasElement);

        function closeOffcanvasOnLargeScreens() {
            if (offcanvasElement.classList.contains('show') && window.innerWidth >= 768) {
                offcanvas.hide();
            }
        }

        window.addEventListener('resize', closeOffcanvasOnLargeScreens);
        offcanvasElement.addEventListener('hidden.bs.offcanvas', closeOffcanvasOnLargeScreens);
    });
</script>
<style>
/* Ensure that backdrop covers all screen for offcanvas sidebar */
    /* .offcanvas-backdrop {
      width: 100%;
      height: 100%;
      } */
</style>
<!-- AUTOMATICALLY CLOSE OFFCANVAS ON MEDIUM-UP SCREEN -->
{{-- OFFCANVAS --}}

<div class="row d-block d-lg-none p-3 shad bg-white" >
    <div class="nav">
        <div class="col">
            <button class="navbar-toggler ms-3 border p-2 rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                <img src="{{asset('assets/admin-icons/bars.svg')}}" alt="">
              </button>

            <a href="#"><img class="img-fluid ps-2" src="{{asset('assets/bu-provident.svg')}}" alt="BU Provident" style="width: 11rem;"></a>
        </div>


    </div>
</div>
<div class="offcanvas offcanvas-start d-block d-lg-none rounded-end-4" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="width: 320px">
    <div class="offcanvas-header">
        <a href="{{route('home')}}">
            <img class="img-fluid" src="{{asset('assets/bu-provident.svg')}}" alt="" style="width: 12rem;">
        </a>
        {{-- <h5 class="offcanvas-title text-secondary" id="offcanvasWithBackdropLabel">eBUPF</h5> --}}
        {{-- <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> --}}
        <button type="button" class=" btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
            <h3><i class="bi bi-x"></i></h3> </button>
    </div>
    <div class="offcanvas-body">

        <ul class="nav flex-column" >

            <a class="text-decoration-none" href="{{ route('member.profile') }}">
                <li class="nav-items py-3 grow-on-hover {{ Route::is('member.profile') ? 'bg-selected fade-in  rounded-4':' '}}  ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="icon" src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="icon">
                        </div>
                        <div class="col d-flex align-items-center text-secondary">
                            <span class="fw-bold fs-7">{{ Auth::user()->member->firstname }} {{ Auth::user()->member->lastname }}</span>
                        </div>
                    </div>
                </li>
            </a>


            <a class="text-decoration-none" href="{{ route('home') }}">
                <li class="nav-item  py-3 grow-on-hover {{ Route::is('member-dashboard') ? 'bg-selected fade-in  rounded-4':' '}} ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img src="{{asset('assets/home.svg')}}" alt="">
                        </div>
                        <div class="col-9">
                            <span class="fw-bold fs-7 text-secondary">Home</span>
                        </div>
                    </div>
                </li>
            </a>


            <a class="text-decoration-none" href="{{route('member.loans', 1)}}">
                <li class="nav-item  py-3 grow-on-hover {{ Route::is('member.loans') ? 'bg-selected fade-in  rounded-4':' '}} ">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <i class="fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                        </div>
                        <div class="col-9">
                            <span class="fw-bold fs-7 text-secondary">Loans</span>
                        </div>
                    </div>
                </li>
            </a>


            <li class="nav-item grow-on-hover mb-2">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">

                        <button style="padding-left: 13px  !important;" class="accordion-button collapsed {{ Route::is('mpl.application','hsl.application') ? 'bg-selected fade-in  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoans" aria-expanded="false" aria-controls="collapseLoans">
                            <div class="row g-0 w-100">
                                <div class="col-3 text-center pe-2">
                                    <img src="{{asset('assets/loan-options.svg')}}" alt="">
                                </div>
                                <div class="col-9 ">
                                    <span class="fw-bold fs-7 text-secondary">Loan Options</span>
                                </div>
                            </div>
                        </button>

                      <div id="collapseLoans" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{ Route::is('mpl.application') ? 'fw-bold' : '' }}" href="{{ route('mpl.application') }}"
                                        @if ($mplDisabled)
                                            disabled
                                            style="pointer-events: none; opacity: 0.6;"
                                        @endif
                                    >
                                        Apply for MPL
                                    </a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{ Route::is('hsl.application') ? 'fw-bold' : '' }}" href="{{ route('hsl.application') }}"
                                        @if ($hslDisabled)
                                            disabled
                                            style="pointer-events: none; opacity: 0.6;"
                                        @endif
                                    >
                                        Apply for HSL
                                    </a>
                                </div>

                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>


            <li class="nav-item grow-on-hover">
                <div class="accordion" id="accordionRequests">
                    <div class="accordion-item  border-0">

                        <button style="padding-left: 13px  !important;" class="accordion-button collapsed {{ Route::is('loan.applications','loan.applications.all','loan.applications.evaluated','outgoing.request') ? 'bg-selected fade-in  rounded-4':' '}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLoanApplications" aria-expanded="false" aria-controls="collapseLoanApplications">
                            <div class="row g-0 w-100">
                                <div class="col-3 text-center pe-2">
                                    <i style="font-size: 23px; color: #FF6F19;" class="bi bi-file-earmark-check-fill"></i>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <span class="fw-bold fs-7 text-secondary">Applications</span>
                                </div>
                            </div>
                        </button>

                      <div id="collapseLoanApplications" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('loan.applications') ? 'fw-bold' : ''}} " href="{{ route('loan.applications.all')}}">Loan Applications</a>
                                </div>

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-secondary {{Route::is('outgoing.request')? 'fw-bold': ''}}" href="/member/Your/coBorrower/requests/">Your Requests</a>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>





            <a class="text-decoration-none" href="{{route('incoming.request')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('incoming.request') ? 'bg-selected fade-in fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center">
                            <i style="font-size: 23px; color: #D100B0;" class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="col-9  d-flex align-items-center">
                            <span class="fw-bold fs-7 text-secondary">Co-borrower Request</span>
                        </div>
                    </div>
                </li>
            </a>

            <a class="text-decoration-none" href="{{route('member.transactions')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('member.transactions') ? 'bg-selected fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center ">
                            <img class="mb-1" src="{{asset('assets/receipt.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class="fw-bold fs-7  text-secondary">Transactions</span>
                        </div>
                    </div>
                </li>
            </a>

            <a class="text-decoration-none" href="{{route('calculator')}}">
                <li class="nav-item  py-3 grow-on-hover {{Route::is('calculator') ? 'bg-selected fade-in fade-in rounded-4' : '' }}">
                    <div class="row g-0">
                        <div class="col-3 text-center  ">
                            <img src="{{asset('assets/calculator.svg')}}" alt="">
                        </div>
                        <div class="col-9  ">
                            <span class=" fw-bold fs-7 text-secondary">Calculator</span>
                        </div>
                    </div>
                </li>
            </a>


        <div class="ms-3 d-flex align-items-end mt-1">
            <div class="row g-0  w-100">
                <div class="col-12 border-top">
                    {{--  <i class="bi bi-list pe-4" style="color: #1030DA"></i> --}}
                    <div class="dropdown">
                    <a class="btn dropdown w-100 text-start" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list pe-4" style="color: #1030DA"></i>More
                    </a>

                    <ul class="dropdown-menu border p-2" style="width: 110%">
                        <li><a class="dropdown-item rounded" href="/logout">Log out</a></li>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
