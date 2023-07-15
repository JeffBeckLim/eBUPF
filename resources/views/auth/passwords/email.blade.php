@extends('home-components.verify-layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div style="width: 30%; min-width:335px;">
            <div class="card rounded-0 shadow-sm p-4">
                <div class="d-flex justify-content-center align-items-center m-2">
                    <img src="{{asset('icons/reset-password.svg')}}" alt="logo" width="65px">
                </div>
                <div class="card-header border-0 bg-white text-center fw-bold fs-5 pt-2 pb-2">{{ __('Reset Password') }}</div>
                <span class="fs-7 text-secondary mb-2">{{ __('To reset your password, please provide your email address to receive a password reset link.') }}</span>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-form-label fs-7">{{ __('Email Address') }}</label>
                        <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2" style="margin-top: -5px;">
                        <div class="col-12">
                            <button type="submit" class="btn w-100 fw-bold text-white" style="background-color: #FF6F19;">
                                {{ __('Send Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
