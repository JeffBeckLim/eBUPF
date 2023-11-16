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
            y[i].classList.add("is-invalid"); // Add "is-invalid" class
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

            console.log(barangaySelector.value);

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
         if (age > 18 || (age === 18 && monthsDiff >= 0)) {
            console.log('yes');
            dobInput.classList.remove("is-invalid");
            dobInput.setCustomValidity('');

         } else {
            console.log('no');
            dobInput.classList.add("is-invalid");
            dobInput.setCustomValidity('You need to be at least 18');
            dobInput.reportValidity();
            valid = false;
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
        spouseInput.classList.remove("validate"); // Remove "validate" class
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var selectElement = document.getElementsByTagName("select");
    selectElement.selectedIndex = -1;
});


