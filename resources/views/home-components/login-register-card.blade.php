@extends('home-components.no-navbar-and-footer')

@section('content')

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 20px;">
    <main class="container mt-2 pb-5">
      <section class="d-flex justify-content-center align-items-center">

        <div class="card rounded-4 shadow-sm" style="width: 60rem;">
          <div class="row g-0  h-100">
            <div class="col-6 d-none d-md-block" style="height: auto">
              <div class=" bu-low-gradient my-3 ms-3 rounded-4 d-flex" style="height: 95%;">

                <section class="w-100  h-100">
                  <img style="pointer-events: none;" class="overlay-image" src="assets/BUBG.jpg" alt="bicol university">
                   <div class="row g-0  d-flex justify-content-center pb-lg-3 pt-lg-1 px-lg-5 px-md-2">
                        <div class="d-flex justify-content-center pt-3 fade-in">
                            <a href="/"><img src="assets/BU-pill.svg" alt="BUPF" style="width: 95%; pointer-events: none"></a>
                        </div>
                   </div>

                  <div class="d-flex justify-content-center">
                    <section class="mt-5 fade-in">
                      <div class="d-flex justify-content-center">
                        <div class="col-8 text-center">
                          <h1 class="text-center text-light fw-bolder fs-2">PROVIDENT FUND INC.</h1>
                        </div>

                      </div>

                      <div class=" border-top border-3 mx-5 ">
                        <p class="mt-1 text-center text-light fw-bold">LOAN MANAGEMENT SYSTEM</p>
                      </div>
                    </section>
                  </div>

                  <div class="d-flex justify-content-center align-items-end " style="height: 15rem;">
                      <p class="fw-7 text-light">Bicol Unviversity Provident Fund 2023</p>
                  </div>

                </section>


              </div>
            </div>
            <div class="col" style="padding: 2rem;">

              @if(request()->route()->getName() === 'login')

              <div class="col-12  mb-5">
                <h4 class="fw-bolder ">
                  Sign In to <span class="bu-text-orange">e</span>BUPF!
                </h4>
                <p style="font-size: small">
                  or create an account to access our Membership forms and learn more about BUPF
                </p>
              </div>

              @else
              <div class="col-12  mb-5 pt-md-2">
                <h4 class="fw-bolder ">
                  Sign Up for <span class="bu-text-orange">e</span>BUPF!
                </h4>
                <p style="font-size: small">
                  Create an account to access our Membership forms and learn more about BUPF
                </p>
              </div>
              @endif

              <div class="col-12">
                @yield('form')
              </div>


            </div>
          </div>
        </div>

      </section>
    </main>
    <script>
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
</div>
@endsection
