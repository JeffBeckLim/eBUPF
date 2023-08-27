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
        <div class="col-8">
            <img src="{{asset('assets/HSL-loanapp-logo.png')}}" alt="Logo" height="57px">
        </div>
        <div class="col-4 d-flex align-items-end justify-content-end">
            <img src="{{asset('icons/HSL-mini.svg')}}" alt="Mini Logo" width="57px">
        </div>
        
         <!-- Tooltip -->
         
            <a style="color: #0092D1 !important; font-size: small" href="#" class=" text-decoration-none my-3" data-bs-toggle="tooltip" data-bs-title="More detials here..."><i class="bi bi-info-circle"></i> What is a Multi-Purpose Loan?</a>
        
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
        <form action="/member/hsl-application/" method="POST" >
            @csrf
            <div id="loanForm">
                <p class="text1-design">Loan Details</p>

                <div class="form-group">
                    <label for="loanAmount" class="text2-design">Amount Requested</label>
                    
                    <input type="number" class="form-control comma-input {{$errors->has('principal_amount') ? 'invalid' : '' }}" id="loanAmount" name="principal_amount" placeholder="Loanable amount: ₱50,000.00 to ₱200,000.00" value="{{old('principal_amount')}}">

                    
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
                      @error('term_years')
                        <h6 class="text-danger">{{$message}}</h6>
                      @enderror
                    {{--  min="1" max="5" --}}
                </div>

                <p class="text1-design pt-4">Co-Borrower</p>

                <div class="form-group">
                    <label for="myCoBorrower" class="text2-design">Enter BU email of your Co-Borrower</label>
                    <input type="text" class="form-control {{ $errors->has('email_co_borrower') ? 'invalid' : '' }}" id="myCoBorrower" name="email_co_borrower" value="{{old('email_co_borrower')}}" placeholder="ex. Juanjose.delacruz@bicol-u.edu.ph">
                    @error('email_co_borrower')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>

                <p class="text1-design pt-4">Witnesses</p>


                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('email_witness_1') ? 'invalid' : '' }}" id="myWitness1" name="email_witness_1" placeholder="ex. jeffbeckmendaza.lim@bicol-u.edu.ph" value="{{old('email_witness_1')}}">
                    @error('email_witness_1')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                    <input type="text" class="form-control mt-2 {{ $errors->has('email_witness_2') ? 'invalid' : '' }}" id="myWitness2" name="email_witness_2" placeholder="ex. aaronbarlas.labini@bicol-u.edu.ph" value="{{old('email_witness_2')}}">
                    @error('email_witness_2')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>

                <div class="row d-flex align-items-center justify-content-center">
                    <p class="warning">Based on the information you have provided in your profile, we will use that as your personal details such as your name, age, and other relevant information.</p>
                </div>
                <button type="button" class="btn bu-orange text-light fw-bold w-100" onclick="validateForm()">Proceed</button>
                

            </div>
            
            
        {{--------------------------------------------------------- 
            this includes the next tab which has the details of the loan application for members to review and send request to co-borrower. 
        --------------------------------------------------------}}    
            @include('member-views.hsl-application-form.hsl-details')
            
        {{-- ------------------------------------------------------- --}}
        {{-- <div class="v-stack gap-2">
            <button type="submit" class=" btn bu-orange text-light fw-bold w-100 mt-3">Send Request to Co-Borrower</button>
            <button type="button" class="btn btn-outline-secondary fw-bold w-100 mt-2" onclick="goBack()">Go back</button>
        </div>    
         --}}
         

      


        </form>
        
        
       

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
