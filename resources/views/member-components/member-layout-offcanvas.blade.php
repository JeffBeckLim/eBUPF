
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
<!-- AUTOMATICALLY CLOSE OFFCANVAS ON MEDIUM-UP SCREEN -->
{{-- OFFCANVAS --}}
<div class="row d-block d-md-none p-3 border-bottom" style="background-color: #ffffff;">
    <div class="nav">
        <div class="col">
            <button class="navbar-toggler ms-3 border p-2 rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                <img src="{{asset('icons/bars.svg')}}" alt="">
              </button>

            <a href="#"><img class="img-fluid ps-2" src="{{asset('assets/bu-provident.svg')}}" alt="BU Provident" style="width: 11rem;"></a>
        </div>

        
    </div>
</div>
<div class="offcanvas offcanvas-start d-block d-md-none" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="width: 320px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-secondary" id="offcanvasWithBackdropLabel">eBUPF</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column" style="margin-bottom: 0;">

            <li class="nav-items py-3 grow-on-hover ">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="icon img-fluid" src="{{asset('icons/profile-holder.png')}}" alt="">
                    </div>
                    <div class="col  d-flex align-items-center">
                        <span class="fw-bold fs-7 text-secondary">Profile</span>
                    </div>
                </div>
            </li>


            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="img-fluid" src="{{asset('icons/home.svg')}}" alt="">
                    </div>
                    <div class="col ">
                        <span class="fw-bold fs-7 text-secondary">Home</span>
                    </div>
                </div>
            </li>

            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <i class="ps-1 fa-sharp fa-solid fa-peso-sign fa-lg" style="color: #ff6767;"></i>
                    </div>
                    <div class="col ">
                        <span class="fw-bold fs-7  text-secondary">Loans</span>
                    </div>
                </div>
            </li>

            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1 img-fluid" src="{{asset('icons/calculator.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class=" fw-bold fs-7 text-secondary">Calculator</span>
                    </div>
                </div>
            </li>


            <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1 img-fluid" src="{{asset('icons/receipt.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class="fw-bold fs-7  text-secondary">Transactions</span>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item  py-3 grow-on-hover">
                <div class="row g-0">
                    <div class="col-3 text-center ">
                        <img class="mb-1 img-fluid" src="{{asset('icons/envelope.svg')}}" alt="">
                    </div>
                    <div class="col-9  ">
                        <span class="fw-bold fs-7 text-secondary">Requests</span>
                    </div>
                </div>
            </li> --}}
            <li class="nav-item grow-on-hover">
                <div class="accordion rounded" id="accordionRequests">
                    <div class="accordion-item border-0">
                      <h5 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            <div class="row g-0">
                                <div class="col-3 text-center ">
                                    <img class="pe-5 ms-1" src="{{asset('icons/envelope.svg')}}" alt="">
                                </div>
                                <div class="col-9 ps-2">
                                    <span class="fw-bold fs-7 text-secondary">Requests</span>
                                </div>
                            </div>
                        </button>
                      </h5>
                      <div id="collapseRequests" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ms-3 rounded">

                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="">Your Requests</a>
                                </div>
                                
                                <div class="co-12  p-2">
                                    <a class="text-decoration-none text-dark" href="">Incoming Requests</a>
                                </div>
                                
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </li>

        </ul>

    </div>
</div>