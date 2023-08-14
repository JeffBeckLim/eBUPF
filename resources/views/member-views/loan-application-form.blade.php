@extends('member-components.member-layout')

@section('content')

<div class="row m-3 mx-2 d-flex justify-content-center">
  <div class="card border p-4" style="width: 30rem">
    <div class="row d-flex">
        <div class="col-8">
            <img src="{{asset('assets/MPL-loanapp-logo.png')}}" alt="Logo" height="57px">
        </div>
        <div class="col-4 d-flex align-items-end justify-content-end">
            <img src="{{asset('icons/MPL-mini.svg')}}" alt="Mini Logo" width="57px">
        </div>
         <!-- Tooltip -->
         
            <a style="color: #0092D1 !important;" href="#" class="text-dark  text-decoration-none fw-bold my-3" data-bs-toggle="tooltip" data-bs-title="A multi-purpose loan is a versatile financial product that provides borrowers with the flexibility to use the funds for various personal needs, such as debt consolidation, home improvements, education, or medical expenses."><i class="bi bi-info-circle"></i> What is a Multi-Purpose Loan?</a>
        
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
         <!-- Tooltip -->


        <form action="#" method="POST" id="loanForm">

            <p class="text1-design">Loan Details</p>

            <div class="form-group">
                <label for="loanAmount" class="text2-design">Amount Requested</label>
                <input type="number" class="form-control" id="loanAmount" name="loanAmount" min="50000" max="200000" required>
            </div>

            <div class="form-group">
                <label for="loanTerm" class="text2-design">Years to Pay</label>
                <input type="number" class="form-control" id="loanTerm" name="loanTerm" min="1" max="5" required>
            </div>

            <p class="text1-design pt-4">Co-Borrower</p>

            <div class="form-group">
                <label for="myCoBorrower" class="text2-design">Choose Your Co-Borrower</label>
                <input type="text" class="form-control" id="myCoBorrower" name="myCoBorrower" required>
            </div>

            <p class="text1-design pt-4">Witnesses</p>

            <div class="form-group">
                <input type="text" class="form-control" id="myWitness1" name="myWitness1" placeholder="Select your first witness" required>
                <input type="text" class="form-control mt-2" id="myWitness2" name="myWitness2" placeholder="Select your second witness" required>
            </div>

            <div class="row d-flex align-items-center justify-content-center">
                <p class="warning">Based on the information you have provided in your profile, we will use that as your personal details such as your name, age, and other relevant information.</p>
            </div>

            <button type="button" class="btn bu-orange text-light fw-bold w-100" onclick="showNextStep()">Proceed</button>

        </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
