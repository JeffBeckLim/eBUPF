@extends('home-components.login-register-card')

@section('form')

@if(session('message'))
    <div class="alert alert-dismissible fade show fw-bold" role="alert" style=" color: #259a0e;">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- login form  -->

<form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-labeltext-dark">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label text-dark">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>

  <div class="text-center p-1 pt-5">
    <button type="submit" class="btn rounded-pill w-75 fw-bold bu-orange text-light grow-on-hover">Log in</button>
    <div class="mt-3 border-bottom border-1">
      <p class="fw-7"><a class="text-decoration-none bu-text-light-blue" href="">Forgot Password?</a></p>
    </div>
  </div>
</form>

<div class=" text-center mt-4">
  <p class="fw-7">Don’t have an account? <span><a class="text-decoration-none fw-bold text-dark" href="/register" >Sign Up</a></span></p>
</div>
@endsection