@extends('home-components.home-layout')

@section('content')
<style>
    label{
        font-size: small !important;
    }
</style>
<main class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-5 col-sm-12 col-md-8 card px-4 pt-3 pb-1 mt-2 mb-5" >

            <!-- CAPSULE -->
            <div class="row  bu-low-gradient-x d-flex justify-content-center p-3 rounded-2">
                <div class="col-9" style="width: 15rem;">
                    <div class="row d-flex ">
                        <img src="{{asset('assets/BU-pill.svg')}}" alt="Bicol University" oncontextmenu="return false;">
                    </div>
                </div>
            </div>
            <!-- CAPSULE -->

            <div class="row justify-content-center pb-1 pt-3">
                <div class="col-lg-10 col-md-9 col-sm-9">
                    <h5 class="text-center fw-bold ">Provident Fund, Inc. Membership Form</h5>
                </div>

            </div>
            <div class="text-center pb-4" style="font-size: small">
                Let's get you started on your journey to becoming a member!
            </div>
            @error('profile_picture')
                <div class="alert alert-danger" role="alert">
                    <p class="text-danger mt-1"><i style="color: rgb(226, 78, 78)" class="bi bi-exclamation-circle"></i>  {{$message}}</p>
                </div>
            @enderror
            <form method="POST" action="/member/application/{{Auth::user()->member->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-0">
                    <!-- One "tab" for each step in the form: -->
                    @include('member-views.membership-form.tab-1')
                    @include('member-views.membership-form.tab-2')
                    @include('member-views.membership-form.tab-3')
                    @include('member-views.membership-form.tab-4')
                </div>
                    <div class=" d-flex justify-content-end my-3">

                        <button class="btn btn-secondary fw-bold me-1 text-light" type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                        <button style="width: 11rem;" class="btn bu-orange text-light fw-bold" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div class="text-center" style="scale: .8">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
            </form>

            <script src="{{asset('js/formWizard.js')}}"></script>
            </div>
        </div>
</main>

@endsection
