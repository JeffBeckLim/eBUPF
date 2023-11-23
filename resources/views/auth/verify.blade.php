@extends('home-components.home-layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-10">
            <div class="card rounded-0 shadow-sm">
                <div class="row p-5 g-0 d-flex justify-content-center ">
                    <img src="{{asset('assets/undraw_mail_sent.svg')}}" style="width: 8rem;">


                </div>

                <div class="card-header fw-bold bg-white border-0 text-center fs-5">
                    {{ __('Verify Your Email Address') }}
                    <h6>
                        {{Auth::user()->email}}
                    </h6>
                </div>
                <div class="row border g-0 mx-4 ">

                        <a  href="https://mail.google.com/" target="blank" class="btn btn-light rounded-0">

                                <i class="fab fa-google" style="color: #eb4132;"></i>
                                <span class="ps-2">Open Gmail</span>

                        </a>
                </div>
                <div class="card-body border m-4">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check" style="color: #207a1a;"></i>
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline fw-bold">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
