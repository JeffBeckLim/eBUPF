@extends('home-components.login-register-card')
@section('form')
    <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="row">

                <div class="col-6 ">
                    <label for="firstname" class="form-label text-dark">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname')}}" required>
                </div>
                @error('firstname')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror

                <div class="col-6 ">
                    <label for="lastname" class="form-label text-dark">Last Name</label>
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

                <label for="password" class="form-label text-dark mt-2">Password</label>
                <div class="col-12 mb-2 input-group">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password')}}" required>
                    <span class="input-group-text border-start-0 rounded-end" style="background-color: rgba(255, 0, 0, 0) !important"><button type="button" id="password-toggle" class="btn btn-link p-0 text-dark"><i class="bi bi-eye-slash-fill"></i></button></span>
                    <small class="text-muted" style="font-size: 12px">Your password must be at least 8 characters long, include at least 1 number, 1 special character, and at least 1 capital letter.</small>
                </div>
                @error('password')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror


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



                <div class="col-12">
                    <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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

            <style>
                .btn-outline{
                    border-width: 2px;
                    border-color: rgb(64, 132, 235) !important;
                    color: rgb(64,132, 235) !important;
                }
                .btn-outline:hover{
                    background-color: rgb(64, 132, 235) !important;
                    border-width: 2px;
                    border-color: rgb(64, 132, 235) !important;
                    color: rgb(255, 255, 255) !important;
                }
            </style>
            <div class="col-12 borders d-flex justify-content-center pt-3">
                <button type="submit" class="btn btn-outline rounded-pill w-100 fw-bold">Sign Up</button>
            </div>

        </div>
    </form>
@endsection
