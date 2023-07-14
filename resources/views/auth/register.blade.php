@extends('home-components.login-register-card')
@section('form')
  <form method="POST" action="{{ route('register') }}">
      @csrf
        <div class="row">
          <div class="col-6 ">
            <label for="firstname" class="form-label text-dark">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname')}}" required>
          </div>
          @error('firstname')
          <p class="text-danger mt-1">{{$message}}</p>
          @enderror
          <div class="col-6 ">
            <label for="lastname" class="form-label text-dark">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname')}}" required>
          </div>
          @error('lastname')
          <p class="text-danger mt-1">{{$message}}</p>
          @enderror
          <div class="col-12">
            <label for="email" class="form-label text-dark">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

          <div class="col-12">
            <label for="password" class="form-label text-dark">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password')}}" required>
          </div>
          @error('password')
          <p class="text-danger mt-1">{{$message}}</p>
          @enderror
          <div class="col-12">
            <label for="password" class="form-label text-dark">Confirm Password</label>
            <input type="password" class="form-control" id="password" name="password_confirmation" required>
          </div>
          @error('password_confirmation')
          <p class="text-danger mt-1">{{$message}}</p>
          @enderror
          <div class="col-12 d-flex justify-content-center mt-4">

            <div class="row  d-block">
              <div class="form-check ">
                <input class="form-check-input" style="color: black" type="checkbox" value="1" id="flexCheckDefault" name="agree_to_terms" @if(old('agree_to_terms')==1) checked @endif >

                <label class="form-check-label" for="flexCheckDefault">
                  <span> Agree to <a class="text-decoration-none fw-bold bu-text-light-blue" href="#">Terms and Conditions</a>  of BUPF </span>
                </label>
                @error('agree_to_terms')
                <p class="text-danger mt-1">{{$message}}</p>
                @enderror
              </div>
            </div>

          </div>
          <div class="col-12 borders d-flex justify-content-center pt-3">
            <button type="submit" class="btn btn-outline-bu rounded-pill w-100 fw-bold  grow-on-hover">Sign Up</button>
          </div>
        </div>
  </form>
@endsection
