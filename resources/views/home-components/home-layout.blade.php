<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBicol University Provident Fund Inc.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" defer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <link rel="icon" href="{{ asset('assets/BU-logo.png') }}" type="image/png" alt="Icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" async>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" defer>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" defer/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" defer>

    <meta name="msvalidate.01" content="E66E32D5A8DFCEEB5E1FE5F122741231" />
    <meta name="description" content="eBicol University Provident Fund (eBUPF) - Your trusted financial services resource. Explore now for financial security!">

    {{-- test --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" async></script>
    <link rel="preload" as="image" href="{{ asset('assets/home-blue-bg.webp') }}" >
    <link rel="preload" as="image" href="{{ asset('assets/home-computer.webp') }}">
    <link rel="preload" as="image" href="{{ asset('assets/bu-provident.svg') }}">
</head>

<body class="bg-default">
    <nav class="navbar border-bottom border-2 navbar-expand-lg navbar-light px-2">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/bu-provident.svg')}}" alt="Bicol University Provident Fund Logo" width="230px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="loansDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Loans</a>
                    <div class="dropdown-menu" aria-labelledby="loansDropdown">
                        <a class="dropdown-item" href="{{ route('about-mpl') }}">Multi-Purpose Loan</a>
                        <a class="dropdown-item" href="{{ route('about-hsl') }}">Housing Loan</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about-bupf')}}">About</a>
                </li>
                <li class="nav-item">
                    <div class="nav-link scrollToSection" data-section=".hear-from-you" style="cursor: pointer;">Contact Us</div>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="login-button btn rounded-pill my-1" href="{{route('login')}}" type="button" style="color: white;">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->member->firstname }}
                            {{ Auth::user()->member->lastname }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div>
        <button id="goToTopBtn" title="Go to Top"><i class="bi bi-chevron-up"></i></button>
        @yield('content')
    </div>
    <div>
        @include('home-components.footer')
    </div>
    {{-- DO NOT TOUCH --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    {{-- DO NOT TOUCH --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var goToTopButton = document.getElementById("goToTopBtn");

        // Show or hide the button based on scroll position
        window.addEventListener("scroll", function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                goToTopButton.style.display = "block";
            } else {
                goToTopButton.style.display = "none";
            }
        });

        // Scroll to the top when the button is clicked
        goToTopButton.addEventListener("click", function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    });

    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 50;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);

    $(document).ready(function() {
        $('.scrollToSection').on('click', function() {
            var section = $(this).data('section');
            var windowHeight = $(window).height();
            var sectionHeight = $(section).outerHeight();
            var offset = Math.max(0, (windowHeight - sectionHeight) / 2);

            $('html, body').animate({
                scrollTop: $(section).offset().top - offset
            }, 'slow', 'swing');
        });
    });
    </script>

    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "jsxoah6b55");
    </script>

    <!-- Cloudflare Web Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "e99da14ff9a345488d601843145f614f"}' defer></script><!-- End Cloudflare Web Analytics -->
    <!-- Cloudflare Web Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "4656121e282044cfa51c0e64127f7c3a"}' defer></script><!-- End Cloudflare Web Analytics -->
</body>

</html>
