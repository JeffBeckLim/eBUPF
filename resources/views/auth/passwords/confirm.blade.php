@extends('home-components.home-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="width: 33%; min-width:335px;">
            <div class="card mt-5 p-3">
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <img src="{{asset('assets/confirm-password.svg')}}" alt="confirm password logo" width="65px">
                </div>
                <div class="card-header border-0 bg-white text-center fw-bold fs-5 pt-2 mb-0">{{ __('Confirm Password') }}</div>

                <div class="card-body">

                    <span class="fs-7 text-secondary">{{ __('Please confirm your password before continuing.') }}</span>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-form-label fs-7">{{ __('Password') }}</label>

                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn w-100 fw-bold text-white" style="background-color: #FF6F19;">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link w-100 text-center" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
