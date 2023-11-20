@php
$user_email = Auth::user()->email;
@endphp
<script>
    // Get the button element by its id
    var proceedButton = document.getElementById("proceedButton");
    var targetButton = document.getElementById("submitButton");

    document.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        // Trigger a click on the button
        proceedButton.click();
        event.preventDefault(); // Prevent the form from submitting on Enter key press

    }
});


const emails = @json($member_emails);
const logged_in_email = @json($user_email);
const emailInput = document.getElementById('myCoBorrower');
const resultDiv = document.getElementById('result');

// Function to perform email validation
function validateEmail() {
    const enteredEmail = emailInput.value.trim().toLowerCase();
    const emailExists = emails.includes(enteredEmail);

    // Display result
    if (enteredEmail === '') {
        resultDiv.textContent = ''; // Clear result if input is empty
        emailInput.classList.remove('is-valid', 'is-invalid'); // Remove validation classes
    } else if (emailExists) {

        if(enteredEmail === logged_in_email){
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