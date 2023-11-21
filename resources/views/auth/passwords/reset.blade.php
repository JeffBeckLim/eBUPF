@extends('home-components.verify-layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div style="width: 30%; min-width:335px;">
            <div class="card">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <img src="{{asset('assets/reset-password.svg')}}" alt="logo" width="65px">
                </div>
                <div class="card-header border-0 bg-white text-center fw-bold fs-5 pt-2 pb-2">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-1">
                            <label for="email" class="col-form-label fs-7">{{ __('Email Address') }}</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <p class="text-secondary" style="font-size: 12px">
                            Make sure your password is atleast 8 characters, has a number, a special character, and a capital letter.
                          </p>
                        <div class="row mb-1">
                            <label for="password" class="col-form-label fs-7">{{ __('New Password') }}</label>

                            <div class="col-12 input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                                <span class="input-group-text border-start-0" style="background-color: rgba(255, 0, 0, 0) !important"><button type="button" id="password-toggle-new" class="btn btn-link p-0 text-dark"><i class="bi bi-eye-slash-fill"></i></button></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-form-label fs-7">{{ __('Confirm Password') }}</label>

                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn w-100 fw-bold text-white" style="background-color: #FF6F19;">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    togglePasswordField('password', 'password-toggle-new');


   function togglePasswordField(inputFieldId, toggleButtonId) {
    const passwordField = document.getElementById(inputFieldId);
    const toggleButton = document.getElementById(toggleButtonId);

    toggleButton.addEventListener('click', function() {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.innerHTML = '<i class="bi bi-eye-fill"></i>'; // Change button icon to show the password
        } else {
            passwordField.type = 'password';
            toggleButton.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'; // Change button icon to hide the password
        }
    });
}
</script>

@endsection
