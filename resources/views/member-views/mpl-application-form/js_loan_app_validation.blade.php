@php
  $member_name = Auth::user()->member->firstname.Auth::user()->member->lastname;
@endphp
<script>
    function preprocessString(str) {
        // Remove white spaces and convert to lowercase
        return str.replace(/\s/g, '').toLowerCase();
    };

    function validateForm() {
      const member_name = @json($member_name);

      const loanForm = document.getElementById('loanForm');
      const inputs = loanForm.querySelectorAll('input[required]');

      const principal_amount = document.getElementById('loanAmount');
      const loan_term = document.getElementById('loanTerm');
      const co_borrower = document.getElementById('myCoBorrower');

      const witness1 = document.getElementById('myWitness1');
      const witness2 = document.getElementById('myWitness2');
      
      var isValid = true;

      if(principal_amount.value != null 
          && principal_amount.value >= 50000 
          && principal_amount.value <= 200000){
          
          principal_amount.classList.remove('is-invalid');
      }
      else{
          principal_amount.classList.add('is-invalid');
          isValid = false;
          
      }

      if(loan_term.value != null 
          && loan_term.value > 0 
          && loan_term.value <= 5){
          
          loan_term.classList.remove('is-invalid');
      }
      else{
          loan_term.classList.add('is-invalid');
          isValid = false;
          
      }

      if (co_borrower.value == '') {
          co_borrower.classList.add('is-invalid');
          isValid = false;
      }
      else if (co_borrower.classList.contains('is-invalid')) {
          isValid = false;
      }

      inputs.forEach(input => {
          if (!input.value) {
              isValid = false;
              input.classList.add('is-invalid');
          } else {
              input.classList.remove('is-invalid');
          }
      });
   

      var witness1Value = witness1.value; 
      if(witness1.value != ''){
        if(witness1Value.length >= 2 &&  /^[a-zA-Z\s.-]+$/.test(witness1Value)){
          witness1.classList.remove('is-invalid');
        }
        else{
            witness1.classList.add('is-invalid');
           isValid = false;
        }
      } 
      else{
        witness2.classList.remove('is-invalid');
      }
      var witness2Value = witness2.value; 
      if(witness2.value != ''){
        if(witness2Value.length >= 2 &&  /^[a-zA-Z\s.-]+$/.test(witness2Value)){
          witness2.classList.remove('is-invalid');
        }
        else{
            witness2.classList.add('is-invalid');
           isValid = false;
        }
      } 
      else{
        witness2.classList.remove('is-invalid');
      }

      // check if both witness name are the same
      if(witness1.value != '' && witness2.value != ''){
        if (preprocessString(witness1.value) == preprocessString(witness2.value)){
              witness1.classList.remove('is-valid');
              witness1.blur();
              witness1.classList.add('is-invalid');
              witness1.setCustomValidity('First and second witness can not be the same.');
              witness1.reportValidity();

              witness2.classList.remove('is-valid');
              witness2.blur();
              witness2.classList.add('is-invalid');
             
              isValid = false;
        }
      }

      if(witness1.value != '' && witness2.value != ''){
        if(preprocessString(witness1.value) == preprocessString(witness2.value)){
              witness1.classList.remove('is-valid');
              witness1.blur();
              witness1.classList.add('is-invalid');
              witness1.setCustomValidity('First and second witness can not be the same.');
              witness1.reportValidity();

              witness2.classList.remove('is-valid');
              witness2.blur();
              witness2.classList.add('is-invalid');
             
              isValid = false;
        }
      }

      // chcek if witness name is same with logged in
      if(preprocessString(member_name) == preprocessString(witness1.value)){
          witness1.classList.remove('is-valid');
          witness1.blur();
          witness1.classList.add('is-invalid');
          isValid = false;
        }
      if(preprocessString(member_name) == preprocessString(witness2.value)){
          witness2.classList.remove('is-valid');
          witness2.blur();
          witness2.classList.add('is-invalid');
          isValid = false;
        }

      // validate witnesses same with witnesses
        var key = document.getElementById('myCoBorrower').value;
      
        $.ajax({
            
            url: '/get/co-borrower?key=' + key,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
              console.log('1 '+isValid);
                var response_name = response;
                var processedResponse = preprocessString(response_name);

                var witness1 = document.getElementById('myWitness1');
                var processedWitness1 = preprocessString(witness1.value);

                var witness2 = document.getElementById('myWitness2');
                var processedWitness2 = preprocessString(witness2.value);
                
                if (processedWitness1 === processedResponse) {
                    witness1.classList.remove('is-valid');
                    witness1.blur();
                    witness1.classList.add('is-invalid');
                    witness1.setCustomValidity('The co-borrower and witness can not be the same person. Please choose different individuals for these roles.');

                    isValid = false;
                }
                if (processedWitness2 === processedResponse) {
                    witness2.classList.remove('is-valid');
                    witness2.blur();
                    witness2.classList.add('is-invalid');
                    witness2.setCustomValidity('The co-borrower and witness can not be the same person. Please choose different individuals for these roles.');
                    witness2.reportValidity();

                    isValid = false;
                }
                console.log('2 '+isValid);

                handleResponse(isValid);
           
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
           
          }); 

          console.log(isValid);
          
  
          // var witness1_fresh = document.getElementById('myWitness1');
          // var witness2_fresh = document.getElementById('myWitness2');
          
          // if(witness1_fresh.classList.contains('is-invalid')){
          //   isValid = false;            
          // }
          // if(witness2_fresh.classList.contains('is-invalid')){
    
          //   isValid = false;
          // }
          
      // if (isValid) {
      //     showNextStep(); // Call your showNextStep function here
      // }
  }
  function handleResponse(isValid){
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

      if (!loanAmount || !loanTerm || !coBorrower) {
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
