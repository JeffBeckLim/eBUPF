@php
$user_email = Auth::user()->email;
@endphp
{{-- limit input to letters dash and dot --}}
<script>
  document.getElementById('myWitness1').addEventListener('input', function(event) {
      var inputValue = event.target.value;
      var pattern = /^[A-Za-z.\-\s]*$/; // Regular expression pattern

      if (!pattern.test(inputValue)) {
          event.target.value = inputValue.slice(0, -1); // Remove the last entered character
      }
  });
  document.getElementById('myWitness2').addEventListener('input', function(event) {
      var inputValue = event.target.value;
      var pattern = /^[A-Za-z.\-\s]*$/; // Regular expression pattern

      if (!pattern.test(inputValue)) {
          event.target.value = inputValue.slice(0, -1); // Remove the last entered character
      }
  });
</script>
<script>

// avoid decimal input
document.getElementById('loanAmount').addEventListener('input', function() {
      // Remove any decimal points entered by the user
      this.value = this.value.replace(/[.,]/g, '');
    });


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

function validateLoanAmount() {
  const loanInput = document.getElementById('loanAmount');

  function validateInput() {
    const inputValue = parseInt(loanInput.value);
    if (inputValue >= 50000 && inputValue <= 200000) {
      loanInput.classList.add('is-valid');
      loanInput.classList.remove('is-invalid');
    } else {
      loanInput.classList.remove('is-valid');
      loanInput.classList.add('is-invalid');
    }
  }

  loanInput.addEventListener('input', validateInput);
  loanInput.addEventListener('keyup', validateInput);
}

// Call the function to add event listeners
validateLoanAmount();


// Validate Witness Name
    // document.getElementById('myWitness1').addEventListener('input', function() {
    //   const nameValue = this.value.trim();

    //   if (nameValue.length >= 2 && /^[a-zA-Z\s.-]+$/.test(nameValue)) {
        
    //     this.classList.add('is-valid')
    //     this.classList.remove('is-invalid')
    //   } else {
    //     this.classList.remove('is-valid')
    //     this.classList.add('is-invalid')
        
    //   }
    // });
    


    // document.getElementById('myWitness2').addEventListener('input', function() {
    //   const nameValue = this.value.trim();

    //   if (nameValue.length >= 2 && /^[a-zA-Z\s.-]+$/.test(nameValue)) {
        
    //     this.classList.add('is-valid')
    //     this.classList.remove('is-invalid')
    //   } else {
    //     this.classList.remove('is-valid')
    //     this.classList.add('is-invalid')
    //   }
    // });
    



</script>