<div id="nextStep" style="display: none;">
    <p class="h6 text-center fw-bold">Loan Application details</p>

    <div class="row">

        <div class="col-6">
            <p class="fw-bold text3-design mt-3">Amount Requested</p>
            <span class="loan-input" id="displayLoanAmount"></span>
        </div>

        <div class="col-6">
            <p class="fw-bold text3-design mt-3">Years To Pay</p>
            <span class="loan-input" id="displayLoanTerm"></span>
        </div>

    </div>

    <div class="row">

        <div class="col-6">
            <p class="fw-bold text3-design mt-3">Co-Borrower</p>
            <div class="row">
                {{-- <div class="col-3">
                    <img class="co-borrower-dp" src="{{asset('assets/hooman.png')}}" alt="Man">
                </div> --}}
                <div class="col-9">
                    <span class="text4-design fw-bold" id="displayCoBorrower"></span>
                </div>
            </div>

        </div>

        <div class="col-6">
            <p class="fw-bold text3-design mt-3">Witnesses</p>
            <span class="text4-design" id="displayWitness1"></span>
            <br>
            <span class="text4-design" id="displayWitness2"></span>
        </div>

    </div>

    <p class="h6 text-center fw-bold mt-4">Your Personal Information</p>

    <div class="row">
        <div class="col-6">
            <p class="fw-bold text3-design mt-2">Name</p>
            <span class="text4-design">{{Auth::user()->member->firstname}} {{Auth::user()->member->lastname}}</span>
        </div>
        <div class="col-6">
            <p class="fw-bold text3-design mt-2">Unit</p>
            <span class="text4-design">{{Auth::user()->member->units->unit_code}}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p class="fw-bold text3-design mt-4">Address</p>
            <span class="text4-design">{{Auth::user()->member->address}}</span>
        </div>
        <div class="col-6">
            <p class="fw-bold text3-design mt-4">Office</p>
            <span class="text4-design">{{Auth::user()->member->units->campuses->campus_code}}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p class="fw-bold text3-design mt-4">Date of Birth</p>
            <span class="text4-design">{{Auth::user()->member->date_of_birth}}</span>
        </div>
        <div class="col-6">
            <p class="fw-bold text3-design mt-4">Tin</p>
            <span class="text4-design">{{Auth::user()->member->tin_num}}</span>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <p class="fw-bold text3-design mt-4">Contact Number</p>
            <span class="text4-design">{{Auth::user()->member->contact_num}}</span>
        </div>
    </div>
    <div class="v-stack gap-2">
        <button type="submit" class=" btn bu-orange text-light fw-bold w-100 mt-3">Send Request to Co-Borrower</button>
        <button type="button" class="btn btn-outline-secondary fw-bold w-100 mt-2" onclick="goBack()">Go back</button>
    </div>    
    
</div>

<script>
      function validateForm() {
        const loanForm = document.getElementById('loanForm');
        const inputs = loanForm.querySelectorAll('input[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (isValid) {
            showNextStep(); // Call your showNextStep function here
        }
    }
    
    function showNextStep() {
        // Get form input values
        const loanAmount = document.getElementById('loanAmount').value;
        const loanTerm = document.getElementById('loanTerm').value;
        const coBorrower = document.getElementById('myCoBorrower').value;
        const witness1 = document.getElementById('myWitness1').value;
        const witness2 = document.getElementById('myWitness2').value;

        if (!loanAmount || !loanTerm || !coBorrower || !witness1 || !witness2) {
            alert('Please fill out all the required fields.');
            return;
        }

        // Display the values in the next step 
        document.getElementById('displayLoanAmount').textContent = loanAmount;
        document.getElementById('displayLoanTerm').textContent = loanTerm;
        document.getElementById('displayCoBorrower').textContent = coBorrower;
        document.getElementById('displayWitness1').textContent = witness1;
        document.getElementById('displayWitness2').textContent = witness2;

        // Hide the form and show the next step
        document.getElementById('loanForm').style.display = 'none';
        document.getElementById('nextStep').style.display = 'block';
    }
    function goBack(){
        document.getElementById('loanForm').style.display = 'block';
        document.getElementById('nextStep').style.display = 'none';
    }

    // function showNewCard() {
    //     document.getElementById("main-remove").style.display = "none";
    //     document.getElementById("newCardContainer").style.display = "block";
    // }
</script>
