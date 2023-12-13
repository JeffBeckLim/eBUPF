@extends('home-components.login-register-card')
@section('form')
    <form method="POST" action="{{ route('register') }}" id="signUpForm">
        @csrf
            <div class="row" style="margin-top: -30px;">
                <div class="col-6 ">
                    <label for="firstname" class="form-label text-dark">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname')}}" required>
                </div>
                @error('firstname')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror

                <div class="col-6 ">
                    <label for="middlename" class="form-label text-dark">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename')}}">
                </div>
                @error('middlename')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror

                <div class="col-12">
                    <label for="lastname" class="form-label text-dark">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname')}}" required>
                </div>
                @error('lastname')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror

                <div class="col-12">
                    <label for="email" class="form-label text-dark">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <span id="emailDomainValidation" class="invalid-feedback" style="display: none;">
                        <strong>Please use the domain @bicol-u.edu.ph</strong>
                    </span>
                    <span id="emailSuccessValidation" class="valid-feedback" style="display: none;">
                        <strong>Email domain is valid: @bicol-u.edu.ph</strong>
                    </span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <label for="password" class="form-label text-dark mt-2">Password</label>
                <div class="col-12 mb-2 input-group pass-field">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password')}}" required>
                    <span class="input-group-text border-start-0 rounded-end" style="background-color: rgba(255, 0, 0, 0) !important"><button type="button" id="password-toggle" class="btn btn-link p-0 text-dark"><i class="bi bi-eye-slash-fill"></i></button></span>
                    {{-- <small class="text-muted" style="font-size: 12px">Your password must be at least 8 characters long, include at least 1 number, 1 special character, and at least 1 capital letter.</small> --}}
                </div>
                <div class="content">
                    <p>Password must contain at least:</p>
                    <ul class="requirement-list" style="margin-top: -10px;">
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>8 characters length</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>1 number (0...9)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>1 lowercase letter (a...z)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>1 special symbol (!...$)</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle"></i>
                            <span>1 uppercase letter (A...Z)</span>
                        </li>
                    </ul>
                </div>

                <style>
                    .requirement-list li {
                        list-style: none;
                    }
                    .requirement-list li i {
                        width: 20px;
                        color: #aaa;
                        font-size: 0.6rem;
                        margin-left: -20px;
                    }
                    .requirement-list li.valid i {
                        font-size: 1rem;
                         color: #0092D1;
                    }
                    .requirement-list li.valid span {
                        color: #999;
                    }
                 /*    input[type=password]::-ms-reveal,
                    input[type=password]::-ms-clear
                    {
                        display: none;
                    } */

                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const emailField = document.getElementById('email');
                        const emailDomainValidation = document.getElementById('emailDomainValidation');
                        const emailSuccessValidation = document.getElementById('emailSuccessValidation');
                        const validDomain = '@bicol-u.edu.ph';

                        emailField.addEventListener('input', function() {
                            const enteredEmail = emailField.value.trim().toLowerCase();

                            if (enteredEmail.endsWith(validDomain)) {
                                emailDomainValidation.style.display = 'none';
                                emailSuccessValidation.style.display = 'block';
                                emailField.classList.remove('is-invalid');
                                emailField.classList.add('is-valid');
                            } else {
                                emailDomainValidation.style.display = 'block';
                                emailSuccessValidation.style.display = 'none';
                                emailField.classList.remove('is-valid');
                                emailField.classList.add('is-invalid');
                            }
                        });
                    });

                    const passwordInput = document.querySelector(".pass-field input");
                    const eyeIcon = document.querySelector(".pass-field i");
                    const requirementList = document.querySelectorAll(".requirement-list li");

                    // An array of password requirements with corresponding
                    // regular expressions and index of the requirement list item
                    const requirements = [
                        { regex: /.{8,}/, index: 0 }, // Minimum of 8 characters
                        { regex: /[0-9]/, index: 1 }, // At least one number
                        { regex: /[a-z]/, index: 2 }, // At least one lowercase letter
                        { regex: /[^A-Za-z0-9]/, index: 3 }, // At least one special character
                        { regex: /[A-Z]/, index: 4 }, // At least one uppercase letter
                    ]
                    passwordInput.addEventListener("keyup", (e) => {
                        requirements.forEach(item => {
                            // Check if the password matches the requirement regex
                            const isValid = item.regex.test(e.target.value);
                            const requirementItem = requirementList[item.index];

                            // Updating class and icon of requirement item if requirement matched or not
                            if (isValid) {
                                requirementItem.classList.add("valid");
                                requirementItem.firstElementChild.className = "fa-solid fa-check";
                            } else {
                                requirementItem.classList.remove("valid");
                                requirementItem.firstElementChild.className = "fa-solid fa-circle";
                            }
                        });
                    });
                </script>

                @error('password')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror


                <script>
                    const passwordField = document.getElementById('password');
                      const toggleButton = document.getElementById('password-toggle');

                      toggleButton.addEventListener('click', function() {
                          if (passwordField.type === 'password') {
                              passwordField.type = 'text';
                              toggleButton.innerHTML = '<i class="bi bi-eye-fill"></i>'; // Change button icon to show the password
                          } else {
                              passwordField.type = 'password';
                              toggleButton.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'; // Change button icon to hide the password
                          }
                      });
                  </script>

                <div class="col-12">
                    <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                @error('password_confirmation')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror

                <div class="col-12 d-flex justify-content-center mt-4">
                    <div class="row  d-block">
                        <div class="form-check">
                            <input class="form-check-input" style="color: black; border: 1px solid black" type="checkbox" value="1" id="agreeToTermsCheckbox" name="agree_to_terms" @if(old('agree_to_terms') == 1) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                <span> Agree to <a class="text-decoration-none fw-bold bu-text-light-blue" href="{{ route('terms-and-conditions') }}">Terms and Conditions</a>  of BUPF </span>
                            </label>
                            @error('agree_to_terms')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            <style>
                .btn-outline{
                    border-width: 2px;
                    border-color: rgb(64, 132, 235) !important;
                    color: rgb(64,132, 235) !important;
                }
                .btn-outline:hover{
                    background-color: rgb(64, 132, 235) !important;
                    border-width: 2px;
                    border-color: rgb(64, 132, 235) !important;
                    color: rgb(255, 255, 255) !important;
                }
            </style>
            <div class="col-12 borders d-flex justify-content-center pt-3">
                <button type="submit" class="btn btn-outline rounded-pill w-100 fw-bold signUpButton" id="signUpBtn" disabled>Sign Up</button>
            </div>

        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agreeToTermsCheckbox = document.getElementById('agreeToTermsCheckbox');
            const signUpButton = document.querySelector('.signUpButton');
            const firstNameInput = document.getElementById('firstname');
            const lastNameInput = document.getElementById('lastname');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const middleNameInput = document.getElementById('middlename');
            const requirementList = document.querySelectorAll(".requirement-list li");

            function checkInputs() {
                const requiredInputs = [firstNameInput, lastNameInput, emailInput, passwordInput, confirmPasswordInput];

                const anyEmpty = requiredInputs.some(input => {
                    return input.value.trim() === '';
                });

                const passwordValid = checkPassword();

                signUpButton.disabled = anyEmpty || !agreeToTermsCheckbox.checked || !passwordValid;
            }

            function checkPassword() {
                const requirements = [
                    { regex: /.{8,}/ }, // Minimum of 8 characters
                    { regex: /[0-9]/ }, // At least one number
                    { regex: /[a-z]/ }, // At least one lowercase letter
                    { regex: /[^A-Za-z0-9]/ }, // At least one special character
                    { regex: /[A-Z]/ }, // At least one uppercase letter
                ];

                let isValid = true;

                requirements.forEach((item, index) => {
                    const requirementItem = requirementList[index];
                    const isRequirementValid = item.regex.test(passwordInput.value);

                    if (!isRequirementValid) {
                        isValid = false;
                        requirementItem.classList.remove("valid");
                        requirementItem.firstElementChild.className = "fa-solid fa-circle";
                    } else {
                        requirementItem.classList.add("valid");
                        requirementItem.firstElementChild.className = "fa-solid fa-check";
                    }
                });

                return isValid;
            }

            checkInputs();

            agreeToTermsCheckbox.addEventListener('change', checkInputs);

            [firstNameInput, lastNameInput, emailInput, passwordInput, confirmPasswordInput, middleNameInput].forEach(input => {
                input.addEventListener('input', checkInputs);
            });

            passwordInput.addEventListener('input', function() {
                checkInputs();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');

        passwordField.addEventListener('input', function(event) {
            // Prevent spaces from being entered or pasted
            const trimmedValue = event.target.value.replace(/\s/g, '');
            event.target.value = trimmedValue;
        });
    });

    document.getElementById('signUpForm').onsubmit = function() {
        var loginBtn = document.getElementById('signUpBtn');
        loginBtn.disabled = true;
        loginBtn.innerHTML = 'Signing up...';
    };
    </script>

@endsection
