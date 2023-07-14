@extends('home-components.login-register-card')

@section('form')

@if(session('message'))
    <div class="alert alert-dismissible fade show fw-bold" role="alert" style=" color: #259a0e;">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- login form  -->

<form method="POST" action="{{ route('login') }}">
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

    <div class="mb-3">
        <label for="password" class="form-label text-dark">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

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
        <button type="submit" class="btn rounded-pill w-75 fw-bold bu-orange text-light grow-on-hover">Log in</button>
        <div class="mt-3 border-bottom border-1">
            <p class="fw-7"><a class="text-decoration-none bu-text-light-blue" href="{{ route('password.request') }}">Forgot Password?</a></p>
        </div>
    </div>
</form>

<div class=" text-center mt-4">
    <p class="fw-7">Don’t have an account? <span><a class="text-decoration-none fw-bold text-dark" href="/register" >Sign Up</a></span></p>
</div>
@endsection
