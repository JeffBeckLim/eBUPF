@extends('home-components.home-layout')

@section('content')
<style>
    label{
        font-size: small !important;
    }
    .text-danger{
        font-size: 14px;
        margin: 0px;
    }

</style>
<main class="container">
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-5 col-sm-12 col-md-8 card px-4 pt-3 pb-1 mt-2 mb-5" >

            <!-- CAPSULE -->
            {{-- <div class="row  bu-low-gradient-x d-flex justify-content-center p-3 rounded-2">
                <div class="col-9" style="width: 15rem;">
                    <div class="row d-flex ">
                        <img src="{{asset('assets/BU-pill.svg')}}" alt="Bicol University" oncontextmenu="return false;">
                    </div>
                </div>
            </div> --}}
            <!-- CAPSULE -->

            <div class="row justify-content-center pb-1 pt-3 " >
                <div class="col-lg-10 col-md-9 col-sm-9 ">
                    <div class="row ">
                        <div class="col-2 ">
                            <img src="{{asset('icons/pencil.svg')}}" alt="" style="width: 3rem;">
                        </div>
                        <div class="col">
                            <h5 class="text-start fw-bold "> Edit Provident Fund, Inc. Membership Form</h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center pb-4" style="font-size: small">
                Please check and ensure that all the inputs are accurate.
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div class="text-center" style="scale: .8">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
            @error('profile_picture')
                <div class="alert alert-danger" role="alert">
                    <p class="text-danger mt-1"><i style="color: rgb(226, 78, 78)" class="bi bi-exclamation-circle"></i>  {{$message}}</p>
                </div>
            @enderror
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <p class="text-danger mt-1"><i style="color: rgb(226, 78, 78)" class="bi bi-exclamation-circle"></i> {{ session('error') }}</p>
                </div>
            @endif
            <form method="POST" action="/member/application/edit/{{Auth::user()->member->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-0">
                    <!-- One "tab" for each step in the form: -->
                    @include('member-views.membership-form-edit.tab-1-edit')
                    @include('member-views.membership-form-edit.tab-2-edit')
                    @include('member-views.membership-form-edit.tab-3-edit')
                    @include('member-views.membership-form-edit.tab-4-edit')
                </div>
                    <div class=" d-flex justify-content-end my-3">

                        <button class="btn btn-secondary fw-bold me-1 text-light" type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                        <button style="width: 11rem;" class="btn bu-orange text-light fw-bold" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

                    </div>
                    
            </form>

            <script src="{{asset('js/formWizard.js')}}"></script>
            </div>
        </div>
</main>

@endsection
