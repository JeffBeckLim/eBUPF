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
            y[i].classList.add("invalid"); // Add "invalid" class
            valid = false;
        } 
        else if (y[i].value == "") {
            // For other input fields, if empty...
            y[i].classList.add("invalid"); // Add "invalid" class
            valid = false;

            // Add the "shake" class to the invalid input
            y[i].classList.add("shake");
            setTimeout(function() {
                y[i].classList.remove("shake");
            }, 500);
        } else {
            // Remove the "invalid" class and shake animation if the field has a value
            y[i].classList.remove("invalid");
            y[i].classList.remove("shake");
        }
    }

    // CHECK CONTACT NUMBER
    const contactNumberInput = document.getElementById('contact_num');
    const value = contactNumberInput.value;
    
        if (value.length != 10 || value[0] != 9) {    
            contactNumberInput.classList.add("invalid");
            contactNumberInput.setCustomValidity('Please enter valid PH sim number format');
            contactNumberInput.reportValidity();
            valid = false;
        } else {
            contactNumberInput.classList.remove("invalid");
            contactNumberInput.setCustomValidity('');
            
        }

    ;

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {

        document.getElementsByClassName("step")[currentTab].className += " finish";
    } else {
        window.scrollTo(0, 0); // Scroll to the top of the page
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
    var selectElement = document.getElementsByClassTagName("select");
    selectElement.selectedIndex = -1;
});


