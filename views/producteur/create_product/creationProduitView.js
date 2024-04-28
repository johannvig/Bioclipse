// Increases the numeric value of an input field
function increment(inputId) {
  var input = document.getElementById(inputId);
  input.value = parseInt(input.value, 10) + 1;
}

// Decreases the numeric value of an input field but not below zero
function decrement(inputId) {
  var input = document.getElementById(inputId);
  var value = parseInt(input.value, 10);
  if (value > 0) {
      input.value = value - 1;
  }
}

// Ensures that only numeric input is entered
function validateInput(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
}

// Numeric input validation for product price
document.getElementById('productPrice').addEventListener('input', function (e) {
  this.value = this.value.replace(/[^\d]/g, '');
});

// Updates displayed product name on input
function updateProductDisplay() {
  const productInput = document.getElementById('productName');
  const productDisplay = document.getElementById('productDisplay');
  productDisplay.textContent = productInput.value;
}

// Triggers file input when edit button is clicked
document.querySelector('.edit-button').addEventListener('click', function() {
  document.getElementById('imageInput').click();
});

// Updates product image preview on file selection
document.getElementById('imageInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
          document.getElementById('productImage').src = e.target.result;
          document.getElementById('imagePath').value = e.target.result;
      }
      reader.readAsDataURL(file);
  }
});

// Initialization when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('creation_produit_form');
  const saveButton = form.querySelector('button[type="submit"]');

  // Checks if the required fields are filled to enable the save button
  const checkFormValidity = () => {
      const productName = document.getElementById('productName').value.trim();
      const productCategory = document.getElementById('productCategory').value.trim();
      const productPrice = document.getElementById('productPrice').value.trim();
      const stockNumber = document.getElementById('stockNumber').value.trim();

      saveButton.disabled = !(productName && productCategory && productPrice && stockNumber);
  };

  // Adds input event listeners to all required fields
  form.querySelectorAll('input[required], select[required], textarea[required]').forEach(input => {
      input.addEventListener('input', checkFormValidity);
  });

  checkFormValidity(); // Run initially in case fields are pre-populated
});

// Form validation and error message display on form submission
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('creation_produit_form');
  const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');

  form.addEventListener('submit', function(event) {
      event.preventDefault();
      let isFormValid = true;

      // Remove existing error messages
      form.querySelectorAll('.error-message').forEach(message => {
          message.remove();
      });

      // Check each required field for a value
      requiredFields.forEach(input => {
          if (!input.value.trim()) {
              displayError(input, "Ce champ est requis.");
              isFormValid = false;
          }
      });

      // Submit the form if all validations pass
      if (isFormValid) {
          form.submit();
      }
  });
});

// Displays an error message next to an input field
function displayError(input, message) {
  const errorSpan = document.createElement('span');
  errorSpan.classList.add('error-message');
  errorSpan.textContent = message;
  input.classList.add('error');
  input.parentNode.insertBefore(errorSpan, input.nextSibling);
}




document.addEventListener('DOMContentLoaded', function(){
  var infoIcon = document.querySelector('.info-icon');
  var popup = document.getElementById('infoPopup');

  infoIcon.addEventListener('mouseenter', function() {
      popup.style.display = 'block';
  });

  infoIcon.addEventListener('mouseleave', function() {
      popup.style.display = 'none';
  });
});
