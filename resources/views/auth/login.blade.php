@extends('home-components.login-register-card')

@section('form')

@if(session('message'))
    <div class="alert alert-dismissible fade show fw-bold" role="alert" style=" color: #259a0e;">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- login form  -->

<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-labeltext-dark">Bicol University Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <label for="password" class="form-label text-dark">Password</label>
    <div class="mb-3 input-group">

        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <span class="input-group-text border-start-0" style="background-color: rgba(255, 0, 0, 0) !important"><button type="button" id="password-toggle" class="btn btn-link p-0 text-dark"><i class="bi bi-eye-slash-fill"></i></button></span>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <script>
      const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('password-toggle');

        toggleButton.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.innerHTML = '<i class="bi bi-eye-fill"></i>'; // Change button icon to show the password
            } else {
                passwordField.type = 'password';
                toggleButton.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'; // Change button icon to hide the password
            }
        });
    </script>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>
<style>
    .google-login-button .google-icon svg {
        height: 20px;
        display: flex;
        margin-right: 10px;
    }
    .google-login-button {
        color: #333;
        border: 1px solid grey;
        cursor: pointer;
    }
    .rounded-button {
        display: flex;
        text-decoration: none;
        padding: 8px 20px;
        box-sizing: border-box;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
        align-items: center;
        transition: linear 0.2s;
    }
    .rounded-button:hover {
        box-shadow: 0px 0px 4px 0px grey;
    }

</style>

    <div class="text-center p-1 pt-3">
        <button type="submit" class="btn rounded-pill w-75 fw-bold bu-orange text-light grow-on-hover" id="loginBtn">Log in</button>
       {{--  <button type="button" onclick="window.location.href='{{ url('/auth/google') }}'"
        class="btn w-75 fw-bold bu-orange text-light grow-on-hover mt-2">
            Login with Google
        </button> --}}
        <div class="d-flex justify-content-center align-items-center mt-2">
            <a class="rounded-button google-login-button w-75 rounded-pill" onclick="window.location.href='{{ url('/auth/google') }}'">
                <span class="google-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M113.47 309.408L95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z" fill="#fbbb00" />
                    <path d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z" fill="#518ef8" />
                    <path d="M416.253 455.624l.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z" fill="#28b446" />
                    <path d="M419.404 58.936l-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z" fill="#f14336" />
                  </svg></span>
                <span>Login with google</span>
              </a>
        </div>

        <div class="mt-3 border-bottom border-1">
            <p class="fw-7"><a class="text-decoration-none bu-text-light-blue" href="{{ route('password.request') }}">Forgot Password?</a></p>
        </div>
    </div>
</form>

<div class=" text-center mt-4">
    <p class="fw-7">Don’t have an account? <span><a class="text-decoration-none fw-bold text-dark" href="/register" >Sign Up</a></span></p>
</div>

<script>
     document.getElementById('loginForm').onsubmit = function() {
        var loginBtn = document.getElementById('loginBtn');
        loginBtn.disabled = true;
        loginBtn.innerHTML = 'Logging in...';
    };
</script>
@endsection
