<script>
    function validateForm() {
      const loanForm = document.getElementById('loanForm');
      const inputs = loanForm.querySelectorAll('input[required]');

      const principal_amount = document.getElementById('loanAmount');
      const loan_term = document.getElementById('loanTerm');
      const co_borrower = document.getElementById('myCoBorrower');

      const witness1 = document.getElementById('myWitness1');
      const witness2 = document.getElementById('myWitness2');
      

      let isValid = true;

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
    //   else{
    //       witness1.classList.add('is-invalid');
    //       isValid = false;
          
    //   }

    //   var witness2Value = witness2.value; 
    //   if(witness2.value != '' && witness2Value.length >= 2 &&  /^[a-zA-Z\s.-]+$/.test(witness2Value)){
    //       witness2.classList.remove('is-invalid');
    //   }
    //   else{
    //       witness2.classList.add('is-invalid');
    //       isValid = false;
          
    //   }

      
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
