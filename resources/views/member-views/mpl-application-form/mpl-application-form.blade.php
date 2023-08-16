@extends('member-components.member-layout')

@section('content')

<div class="row m-3 mx-2 d-flex justify-content-center">
  <div class="card border p-4" style="width: 35rem">
    <div class="row d-flex">
        <div class="col-8">
            <img src="{{asset('assets/MPL-loanapp-logo.png')}}" alt="Logo" height="57px">
        </div>
        <div class="col-4 d-flex align-items-end justify-content-end">
            <img src="{{asset('icons/MPL-mini.svg')}}" alt="Mini Logo" width="57px">
        </div>
        
         <!-- Tooltip -->
         
            <a style="color: #0092D1 !important; font-size: small" href="#" class=" text-decoration-none my-3" data-bs-toggle="tooltip" data-bs-title="A multi-purpose loan is a versatile financial product that provides borrowers with the flexibility to use the funds for various personal needs, such as debt consolidation, home improvements, education, or medical expenses."><i class="bi bi-info-circle"></i> What is a Multi-Purpose Loan?</a>
        
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
         <!-- Tooltip -->


        <form action="/member/mpl-application/" method="POST" >
            @csrf
            <div id="loanForm">
                <p class="text1-design">Loan Details</p>

                <div class="form-group">
                    <label for="loanAmount" class="text2-design">Amount Requested</label>
                    <input type="number" class="form-control" id="loanAmount" name="principal_amount" placeholder="Loanable amount: ₱50,000.00 to ₱200,000.00" value="{{old('principal_amount')}}">
                    {{-- min="50000" max="200000" --}}
                    @error('principal_amount')
                        <h6 class="text-danger">{{$message}}</h6>
                    @enderror
                </div>

                <div class="form-group">
                    {{-- 
                    <input type="number" class="form-control" id="loanTerm" name="term_years" > --}}
                    <label for="loanTerm" class="text2-design">Years to Pay</label>
                    <select class="form-control form-select mt-2" aria-label="Default select example" id="loanTerm" name="term_years" value="{{old('term_years')}}">
                        <option selected disabled>Choose loan term: 1-5 years</option>
                        @for ($years = 1; $years < 6; $years++)
                            @if ($years == 1 )
                                <option value="{{$years}}">{{$years}} year</option>
                            @else 
                                <option value="{{$years}}">{{$years}} years</option>
                            @endif
                        @endfor
                    
                      </select>
                    {{--  min="1" max="5" --}}
                </div>

                <p class="text1-design pt-4">Co-Borrower</p>

                <div class="form-group">
                    <label for="myCoBorrower" class="text2-design">Choose Your Co-Borrower</label>
                    <input type="text" class="form-control" id="myCoBorrower" name="coBorrower_id" value="{{old('coBorrower_id')}}">
                    @error('coBorrower_id')
                        <h6 class="text-danger">Please choose a co-borrower</h6>
                    @enderror
                </div>

                <p class="text1-design pt-4">Witnesses</p>

                <div class="form-group">
                    <input type="text" class="form-control" id="myWitness1" name="wittness_1" placeholder="Select your first witness" value="{{old('wittness_1')}}">
                    @error('wittness_1')
                        <h6 class="text-danger">Please choose a two witnesses</h6>
                    @enderror
                    <input type="text" class="form-control mt-2" id="myWitness2" name="wittness_2" placeholder="Select your second witness" >
                    @error('wittness_2')
                        <h6 class="text-danger">Please choose a two witnesses</h6>
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
            @include('member-views.mpl-application-form.mpl-details')
            
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
