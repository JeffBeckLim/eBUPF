@extends('member-components.member-layout')

@section('content')

<div class="row m-3 mx-2 d-flex justify-content-center">
    @if (session('message'))
        <div class="alert alert-primary">
            <i class="bi bi-hand-thumbs-up-fill"></i> {{ session('message') }}
        </div>
    @endif
  <div class="card border p-4" style="width: 35rem">
    <div class="row d-flex">
        <div class="col">
            <img src="{{asset('assets/MPL-loanapp-logo.png')}}" alt="Logo" style="height: 55px;">
        </div>
        <div class="col-2 d-md-block d-none">
            <img src="{{asset('assets/MPL-mini.svg')}}" alt="Mini Logo" style="height: 55px;">
        </div>

         <!-- Tooltip -->

            <a style="color: #0092D1 !important; font-size: small" href="#" class=" text-decoration-none my-3" data-bs-toggle="tooltip" data-bs-title="A multi-purpose loan is a versatile financial product that provides borrowers with the flexibility to use the funds for various personal needs, such as debt consolidation, home improvements, education, or medical expenses."><i class="bi bi-info-circle"></i> What is a Multi-Purpose Loan?</a>

        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
         <!-- Tooltip -->

         @if (session('email_error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i> {{ session('email_error') }}
            </div>
        @endif
        <form action="/member/loan-application/1" method="POST" >
            @csrf
            <div id="loanForm">
                <p class="text1-design">Loan Details</p>

                <div class="form-group">
                    <label for="loanAmount" class="text2-design">Amount Requested</label>

                    <input type="number" class="form-control comma-input {{$errors->has('principal_amount') ? 'invalid' : '' }}" id="loanAmount" name="principal_amount" placeholder="Loanable amount: ₱50,000.00 to ₱200,000.00" value="{{old('principal_amount')}}">

                    <div id="validationLoanAmountFeedBack" class="invalid-feedback">
                        Loan amount must be at least 50,000 Php or max value of 200,000 Php
                      </div>

                    {{-- min="50000" max="200000" --}}
                    @error('principal_amount')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>


                <div class="form-group">
                    {{--
                    <input type="number" class="form-control" id="loanTerm" name="term_years" > --}}
                    <label for="loanTerm" class="text2-design">Years to Pay</label>
                    <select class="form-control form-select mt-2 {{ $errors->has('term_years') ? 'invalid' : '' }}" aria-label="Default select example" id="loanTerm" name="term_years" value="{{old('term_years')}}">
                        <option value="" selected disabled>Choose loan term: 1-5 years</option>
                        @for ($years = 1; $years < 6; $years++)
                            @if ($years == 1)
                                <option value="{{$years}}" {{old('term_years') == $years ? 'selected' : '' }}>{{$years}} year</option>
                            @else
                                <option value="{{$years}}" {{old('term_years') == $years ? 'selected' : '' }}>{{$years}} years</option>
                            @endif
                        @endfor

                      </select>

                      <div id="validationLoanTermFeedBack" class="invalid-feedback">
                            Please choose a loan term
                      </div>
                      @error('term_years')
                        <h6 class="text-danger">{{$message}}</h6>
                      @enderror
                    {{--  min="1" max="5" --}}
                </div>

                <p class="text1-design pt-4">Co-Borrower</p>
                <div class="form-group">
                    <label for="myCoBorrower" style="font-size: 12px">Please enter the BU email of your Co-Borrower. Your co-borrower must be a registered member of BUPF Online</label>
                    <input type="text" class="form-control {{ $errors->has('email_co_borrower') ? 'invalid' : '' }}" id="myCoBorrower" name="email_co_borrower" value="{{old('email_co_borrower')}}" placeholder="ex. juanjose.delacruz@bicol-u.edu.ph">

                
                    <div style="font-size: 12px" class="ms-1 mt-2" id="result"></div>
                 

                    @error('email_co_borrower')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>

                <p class="text1-design pt-4">Witnesses</p>
                <p class="text-secondary" style="font-size: 12px">Please enter the names of your witnesses, these are required.</p>

                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('witness_name_1') ? 'invalid' : '' }}" id="myWitness1" name="witness_name_1" placeholder="ex. Jeff Beck M. Lim" value="{{old('witness_name_1')}}">
                    @error('witness_name_1')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                    <input type="text" class="form-control mt-2 {{ $errors->has('witness_name_2') ? 'invalid' : '' }}" id="myWitness2" name="witness_name_2" placeholder="ex. Aaron B. Labini" value="{{old('witness_name_2')}}">
                    @error('witness_name_2')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>

                <div class="row d-flex align-items-center justify-content-center">
                    <p class="warning">Based on the information you have provided in your profile, we will use that as your personal details such as your name, age, and other relevant information.</p>
                </div>
                <button  id="proceedButton" type="button" class="btn bu-orange text-light fw-bold w-100" onclick="validateForm()">Proceed</button>


            </div>


        {{---------------------------------------------------------
            this includes the next tab which has the details of the loan application for members to review and send request to co-borrower.
        --------------------------------------------------------}}
            @include('member-views.mpl-application-form.mpl-details')

        {{-- ------------------------------------------------------- --}}
        </form>



       
    </div>
  </div>
</div>
{{-- scripts used in validation --}}
@include('member-views.mpl-application-form.js_in_form_script')

@endsection
