@extends('member-components.member-layout')

@section('content')

<main>

    <div class="container-fluid">
        
        <div class="row  d-flex justify-content-center mt-3 px-2 vh-100">

            <div class="col-lg-6 ">
                @if (session('error'))   
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif    
                <div class="row bg-white border rounded pb-3">
                    <h5 class="py-4 fw-bold">Change Co-borrower</h5>
                    <div class="col-12">
                        <form action="{{route('change.coBorrower.update', $loan->id)}}" method="POST">
                            @csrf
                          
                            <div class="form-group">
                                <label for="myCoBorrower" style="font-size: 12px">Please enter the BU email of your Co-Borrower. Your co-borrower must be a registered member of BUPF Online</label>
                                <input type="text" class="form-control {{ $errors->has('email_co_borrower') ? 'is-invalid' : '' }}" id="myCoBorrower" name="email_co_borrower" value="{{old('email_co_borrower')}}" placeholder="ex. juanjose.delacruz@bicol-u.edu.ph">
            
            
                                <div style="font-size: 12px" class="ms-1 mt-2" id="result"></div>
            
            
                                @error('email_co_borrower')
                                    <h6 class="text-danger">{{$message}}</h6>
                                @enderror
                            </div>
                        
                    </div>
                    <div class="col-12 mt-2 text-end">
                        <a href="{{route('outgoing.request')}}" class="btn btn-outline-secondary">Go back</a>
                        <button id="submit-btn" type="submit" class="btn bu-orange text-light fw-bold disabled">Confirm Change</button>
                    </form>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</main>
<script>

const currentCbEmail = @json($currentCbEmail);
const emails = @json($member_emails);
const logged_in_email = @json($user_email);
const emailInput = document.getElementById('myCoBorrower');
const resultDiv = document.getElementById('result');
const submit_btn = document.getElementById('submit-btn');

function validateEmail() {
    const enteredEmail = emailInput.value.trim().toLowerCase();
    const emailExists = emails.includes(enteredEmail);


    // Display result
    if (enteredEmail === '') {
        resultDiv.textContent = ''; // Clear result if input is empty
        emailInput.classList.remove('is-valid', 'is-invalid'); // Remove validation classes
    } else if (emailExists) {

        if(enteredEmail === currentCbEmail){
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
            resultDiv.textContent = `You cannot enter the same co-borrower`;
            resultDiv.classList.add('text-danger')
            resultDiv.classList.remove('text-success');
        }
        else if(enteredEmail === logged_in_email){
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
            resultDiv.textContent = `You cannot enter your own email address`;
            resultDiv.classList.add('text-danger')
            resultDiv.classList.remove('text-success');
        }
        else{
            emailInput.classList.remove('is-invalid');  
            emailInput.classList.add('is-valid');
            resultDiv.textContent = `${enteredEmail} is a valid member email!`;
            resultDiv.classList.add('text-success')
            resultDiv.classList.remove('text-danger');
            submit_btn.classList.remove('disabled');
        }
    } else {
        emailInput.classList.remove('is-valid');
        emailInput.classList.add('is-invalid');
        resultDiv.textContent = `${enteredEmail} is not a member email.`;
        resultDiv.classList.add('text-danger')
        resultDiv.classList.remove('text-success');
    }
}

// Listen for both 'input' and 'keyup' events
emailInput.addEventListener('input', validateEmail);
emailInput.addEventListener('keyup', validateEmail);
</script>

@endsection
