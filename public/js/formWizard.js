var editAddress =  document.getElementById("edit_address");
var showBtn =  document.getElementById("show_btn");
var hideBtn =  document.getElementById("hide_btn");

function showEditAddress(){
    editAddress.classList.remove("d-none");
    showBtn.classList.add("d-none");
    hideBtn.classList.remove("d-none");

    // clear input when edit is hidden
    var dropdown = document.getElementById("region");
    var dropdown1 = document.getElementById("city");
    var dropdown2 = document.getElementById("province");
    var dropdown3 = document.getElementById("barangay");
    dropdown.selectedIndex = 0;
    dropdown.classList.remove("invalid","shake");

    dropdown1.selectedIndex = 0;
    dropdown1.classList.remove("invalid","shake");

    dropdown2.selectedIndex = 0;
    dropdown2.classList.remove("invalid","shake");

    dropdown3.selectedIndex = 0;
    dropdown3.classList.remove("invalid","shake");
}   
function HideEditAddress(){
    editAddress.classList.add("d-none");
    hideBtn.classList.add("d-none");
    showBtn.classList.remove("d-none")
}


var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";

    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
        // document.getElementById("nextBtn").type = "submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        // document.getElementById("regForm").submit();
        document.getElementById("nextBtn").type = "submit";
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByClassName("validate");

    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].type === "checkbox" && !y[i].checked) {
            // For checkboxes, check if it's not checked
            y[i].classList.add("invalid"); // Add "is-invalid" class
            valid = false;
        } 
        else if (y[i].value == "") {
            // For other input fields, if empty...
            y[i].classList.add("is-invalid"); // Add "is-invalid" class
            valid = false;

            // Add the "shake" class to the is-invalid input
            y[i].classList.add("shake");
            setTimeout(function() {
                y[i].classList.remove("shake");
            }, 500);
        } else {
            // Remove the "is-invalid" class and shake animation if the field has a value
            y[i].classList.remove("is-invalid");
            y[i].classList.remove("shake");
        }
    }
      // name validation
     
        // name validation
        const firstname = document.getElementById('firstname');
        const middlename = document.getElementById('middlename'); 
        const lastname = document.getElementById('lastname');
        if (validateName(firstname.value)){
            firstname.classList.remove("is-invalid");
            firstname.setCustomValidity('');
        } else {
            firstname.classList.add("is-invalid");
            firstname.setCustomValidity('Name should contain only letters and single spaces.');
            firstname.reportValidity();
            valid = false;   
        }

        

        if(middlename.value != ''){
            if (validateName(middlename.value)) {
                middlename.classList.remove("is-invalid");
                middlename.setCustomValidity('');
            } else {
                middlename.classList.add("is-invalid");
                middlename.setCustomValidity('Name should contain only letters and single spaces.');
                middlename.reportValidity();
                valid = false;   
            }
        }
        if (validateName(lastname.value)) {
            lastname.classList.remove("is-invalid");
            lastname.setCustomValidity('');
        } else {
            lastname.classList.add("is-invalid");
            lastname.setCustomValidity('Name should contain only letters and single spaces.');
            lastname.reportValidity();
            valid = false;   
        }

    // CHECK CONTACT NUMBER
    const contactNumberInput = document.getElementById('contact_num');
    const value = contactNumberInput.value;
    
        if (value.length != 10 || value[0] != 9) {    
            contactNumberInput.classList.add("is-invalid");
            contactNumberInput.setCustomValidity('Please enter valid PH sim number format');
            contactNumberInput.reportValidity();
            valid = false;
        } else {
            contactNumberInput.classList.remove("is-invalid");
            contactNumberInput.setCustomValidity('');
        }

    // CHECK ADDRESS
        if(!editAddress.classList.contains("d-none")){
            const regionSelector = document.getElementById('region');
            const provinceSelector = document.getElementById('province');
            const citySelector = document.getElementById('city');
            const barangaySelector = document.getElementById('barangay');

            if(regionSelector.value === 'Choose Region'){
                regionSelector.classList.add("is-invalid","shake");
                valid = false;
            }
            else{
                regionSelector.classList.remove("is-invalid","shake");
            }

            if(provinceSelector.value === 'Choose State/Province' || provinceSelector.value === '' ){
                provinceSelector.classList.add("is-invalid","shake");
                valid = false;
            }
            else{
                provinceSelector.classList.remove("is-invalid","shake");
            }


            if(citySelector.value === 'Choose city/municipality' || citySelector.value === '' ){
                citySelector.classList.add("is-invalid","shake");
                valid = false;
            }
            else{
                citySelector.classList.remove("is-invalid","shake");
            }

            if(barangaySelector.value === 'Choose barangay' || barangaySelector.value === '' ){
                barangaySelector.classList.add("is-invalid","shake");
                valid = false;
            }
            else{
                barangaySelector.classList.remove("is-invalid","shake");
            }
         }

         const dobInput = document.getElementById('date_of_birth');
         // Get the value from the input field
         const dob = new Date(dobInput.value);
         const today = new Date();
         
         // Calculate the difference in years
         const age = today.getFullYear() - dob.getFullYear();
         const monthsDiff = today.getMonth() - dob.getMonth();
      
         // Check if the user is at least 18 years old (considering month difference)
         if(age > 65){
            console.log('age is old');
            dobInput.classList.add("is-invalid");
            dobInput.setCustomValidity('You need to be at least below the retirement age of 65');
            dobInput.reportValidity();
            valid = false;
         }
         else if (age > 18 || (age === 18 && monthsDiff >= 0)) {
            // console.log('yes');
            dobInput.classList.remove("is-invalid");
            dobInput.setCustomValidity('');
         } 
         else {
            // console.log('no');
            dobInput.classList.add("is-invalid");
            dobInput.setCustomValidity('You need to be at least 18');
            dobInput.reportValidity();
            valid = false;
         }

       
        //  name validation for beneficiary\
        const beneficiary0_name = document.getElementById('beneficiary0');              

        if(beneficiary0_name.value != ''){
            if ( validateName(beneficiary0_name.value)) {
                beneficiary0_name.classList.remove("is-invalid");
                beneficiary0_name.setCustomValidity('');
            } else {

                beneficiary0_name.classList.add("is-invalid");
                beneficiary0_name.setCustomValidity('Name should contain only letters and single spaces.');
                beneficiary0_name.reportValidity();
                valid = false;   
            }
        }      
        
        const beneficiary1_name = document.getElementById('beneficiary1');
        if(beneficiary1_name.value.trim() !== ''){

                if ( validateName(beneficiary1_name.value)) {
                    beneficiary1_name.classList.remove("is-invalid");
                    beneficiary1_name.setCustomValidity('');
                } else {
    
                    beneficiary1_name.classList.add("is-invalid");
                    beneficiary1_name.setCustomValidity('Name should contain only letters and single spaces.');
                    beneficiary1_name.reportValidity();
                    valid = false;   
                }
 
        }else if(beneficiary1_name.value.trim() === '')
        {
            beneficiary1_name.classList.remove("is-invalid");
            beneficiary1_name.setCustomValidity('');
        }

        const beneficiary2_name = document.getElementById('beneficiary2');
        if(beneficiary2_name.value.trim() !== ''){

                if ( validateName(beneficiary2_name.value)) {
                    beneficiary2_name.classList.remove("is-invalid");
                    beneficiary2_name.setCustomValidity('');
                } else {
    
                    beneficiary2_name.classList.add("is-invalid");
                    beneficiary2_name.setCustomValidity('Name should contain only letters and single spaces.');
                    beneficiary2_name.reportValidity();
                    valid = false;   
                }
 
        }else if(beneficiary2_name.value.trim() === '')
        {
            beneficiary2_name.classList.remove("is-invalid");
            beneficiary2_name.setCustomValidity('');
        }


        const beneficiary3_name = document.getElementById('beneficiary3');
        if(beneficiary3_name.value.trim() !== ''){

                if ( validateName(beneficiary3_name.value)) {
                    beneficiary3_name.classList.remove("is-invalid");
                    beneficiary3_name.setCustomValidity('');
                } else {
    
                    beneficiary3_name.classList.add("is-invalid");
                    beneficiary3_name.setCustomValidity('Name should contain only letters and single spaces.');
                    beneficiary3_name.reportValidity();
                    valid = false;   
                }
 
        }else if(beneficiary3_name.value.trim() === '')
        {
            beneficiary3_name.classList.remove("is-invalid");
            beneficiary3_name.setCustomValidity('');
        }

         const beneficiary4_name = document.getElementById('beneficiary4');
        if(beneficiary4_name.value.trim() !== ''){

                if ( validateName(beneficiary4_name.value)) {
                    beneficiary4_name.classList.remove("is-invalid");
                    beneficiary4_name.setCustomValidity('');
                } else {
    
                    beneficiary4_name.classList.add("is-invalid");
                    beneficiary4_name.setCustomValidity('Name should contain only letters and single spaces.');
                    beneficiary4_name.reportValidity();
                    valid = false;   
                }
 
        }else if(beneficiary4_name.value.trim() === '')
        {
            beneficiary4_name.classList.remove("is-invalid");
            beneficiary4_name.setCustomValidity('');
        }
        
        // FOR TAB 2 
        if(currentTab == 1){
            // validate tin num
            const tin_num = document.getElementById('tin_num');
            const tin_num_value = tin_num.value;

            if ( validateTin(tin_num_value)) {  
                tin_num.classList.add("is-valid");
                tin_num.setCustomValidity('');
             } 
             else {
                tin_num.classList.add("is-invalid");
                tin_num.setCustomValidity('Valid tin format is xxx-xxx-xxx-xxx or xxx-xxx-xxx');
                tin_num.reportValidity();
                valid = false;   
            }

            const employee_num = document.getElementById('employee_num');
            const employee_num_value = employee_num.value;
            if(employee_num_value != ''){
                if ( validateEmployeeNum(employee_num_value)) {  
                    employee_num.classList.add("is-valid");
                    employee_num.setCustomValidity('');
                } 
                else {
                    employee_num.classList.add("is-invalid");
                    employee_num.setCustomValidity('Invalid format, format is YEAR-xxx-x');
                    employee_num.reportValidity();
                    valid = false;   
                }
            }

            const monthly_salary = document.getElementById('monthly_salary');
            const monthly_salary_value = monthly_salary.value;
            if ( monthly_salary_value >=1 ) {

                monthly_salary.classList.add("is-valid");
                monthly_salary.setCustomValidity('');
             } 
             else {
                
                monthly_salary.classList.add("is-invalid");
                monthly_salary.setCustomValidity('Must have a value');
                monthly_salary.reportValidity();
                valid = false;   
            }

            const  monthly_contribution = document.getElementById('monthly_contribution');
            const  monthly_contribution_value =  monthly_contribution.value;
            if (  monthly_contribution_value >= 1 ) {

                 monthly_contribution.classList.add("is-valid");
                 monthly_contribution.setCustomValidity('');
             } 
             else {
                 monthly_contribution.classList.add("is-invalid");
                 monthly_contribution.setCustomValidity('Must have a value');
                 monthly_contribution.reportValidity();
                 valid = false;   
            }

            
            // validate appointment date must not be in the future
            var appointment_date = document.getElementById('bu_appointment_date');           
            if (isDateNotGreaterThanToday(appointment_date.value)) {
                appointment_date.classList.add("is-valid");
                 appointment_date.setCustomValidity('');
            } else {
                appointment_date.classList.add("is-invalid");
                appointment_date.setCustomValidity('Invalid date');
                appointment_date.reportValidity();
                valid = false;   
            }
            function isDateNotGreaterThanToday(inputDate) {
                // Get the current date
                var currentDate = new Date();
              
                // Parse the input date
                var inputDateObj = new Date(inputDate);
              
                // Check if the input date is not greater than the current date
                return inputDateObj <= currentDate;
              }


              function containsLetter(input) {
                    // Regular expression to check for at least one letter
                    const letterPattern = /[a-zA-Z]/;
                
                    // Check if the input string contains at least one letter
                    return letterPattern.test(input);
                }
                
                // Must contain at least a letter
                const positionInput = document.getElementById('position'); // Get the input value from an input field
                if (containsLetter(positionInput.value)) {
                    // positionInput.classList.add("is-valid");
                    positionInput.classList.remove("is-invalid");
                    positionInput.setCustomValidity('');
                } else {
                    positionInput.classList.add("is-invalid");
                    positionInput.setCustomValidity('Invalid Value / Must contain a letter');
                    positionInput.reportValidity();
                    valid = false;   
                }


        }
        function validateTin(input) {
            const cleanNumber = input.replace(/-/g, ''); // Remove dashes
            const isValidFormat = /^(\d{3}-\d{3}-\d{3}-\d{3}|\d{3}-\d{3}-\d{3})$/.test(input); // Validate format
            const isValidLength = cleanNumber.length >= 9 && cleanNumber.length <= 12; // Validate length
            
            return isValidFormat && isValidLength;
          }
        function validateEmployeeNum(input) {
            const cleanNumber = input.replace(/-/g, ''); // Remove dashes
            const isValidFormat = /^\d{4}-\d{3}-\d$/.test(input);// Validate format
            const isValidLength = cleanNumber.length == 8; // Validate length
            
            return isValidFormat && isValidLength;
          }
        
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {

        document.getElementsByClassName("step")[currentTab].className += " finish";
    }

    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}


function enableSpouseInput() {
    var maritalStatus = document.getElementById("civilStatus");
    var spouseInput = document.getElementById("spouseName");

    if (maritalStatus.value === "married") {
        spouseInput.disabled = false;
        spouseInput.classList.add("validate"); // Add "validate" class
    } else {
        spouseInput.disabled = true;
        spouseInput.value = ""; // Clear the input value when disabled
        spouseInput.classList.remove("validate", "is-invalid"); // Remove "validate" class
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var selectElement = document.getElementsByTagName("select");
    selectElement.selectedIndex = -1;
});


function validateName(name) {
    // Regular expression to match only letters (uppercase and lowercase) and spaces
    const nameRegex = /^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*\s*$/;
    // Test if the name matches the regex pattern
    return nameRegex.test(name);
}

