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
        <label for="email" class="form-labeltext-dark">Email address</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <label for="password" class="form-label text-dark">Password</label>
    <div class="mb-3 input-group">

        <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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

    <div class="text-center p-1 pt-5">
        <button type="submit" class="btn rounded-pill w-75 fw-bold bu-orange text-light grow-on-hover" id="loginBtn">Log in</button>
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
