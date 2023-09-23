@extends('member-components.member-layout')

@section('content')

    <div style="border-radius: 20px; background: #F4F4F4; margin-top: 15px;">
        <div class="d-flex align-items-center p-2 gap-3">
            <img src="{{asset('icons/calculator.svg')}}" alt="calculator logo" width="30px" height="50px">
            <span style="font-size: 20px; font-weight: bold; color: #000834;">Loan Calculator</span>
        </div>
        <div style="margin-left: 100px; margin-top: -10px; font-size: 0.9rem;">
           proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit
        </div>

        <div class="row gap-md-5 mx-4 mt-3">
            <div class="col-md-4 bg-white rounded-3">
                {{-- Input for Loan Category and Loan amount and loan term --}}
                <form action="#">
                    <div class="p-3">
                        <span class="fw-bold fs-6">Loan Category</span> <br>
                        <div style="padding: 5px 0 0 13px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="radio" id="mpl" name="loan_category" value="mpl">
                                    <label for="mpl" class="fs-7">Multi-Purpose</label>
                                </div>
                                <div class="col-lg-5">
                                    <input type="radio" id="hsl" name="loan_category" value="hsl">
                                    <label for="hsl" class="fs-7">Housing</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7 bg-white rounded-3">

            </div>
        </div>
    </div>

@endsection
