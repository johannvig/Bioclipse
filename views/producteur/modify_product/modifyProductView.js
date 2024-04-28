



function increment(inputId) {
    var input = document.getElementById(inputId);
    input.value = parseInt(input.value, 10) + 1;
    enableSaveButton();
}

function decrement(inputId) {
    var input = document.getElementById(inputId);
    var value = parseInt(input.value, 10);
    if (value > 0) {
      input.value = value - 1;
      enableSaveButton(); 
  }
}




function validateInput(input) {
    // Remplacez tout caractère non numérique par une chaîne vide
    input.value = input.value.replace(/[^0-9]/g, '');
}

document.getElementById('productPrice').addEventListener('input', function (e) {
    this.value = this.value.replace(/[^\d]/g, ''); // Remplace tout ce qui n'est pas un chiffre par une chaîne vide
});



function updateProductDisplay() {
    const productInput = document.getElementById('productName');
    const productDisplay = document.getElementById('productDisplay');
    productDisplay.textContent = productInput.value;
}

document.querySelector('.edit-button').addEventListener('click', function() {
    document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('productImage').src = e.target.result;
            document.getElementById('imagePath').value = e.target.result; // ajout de cette ligne
        }
        reader.readAsDataURL(file);
    }
});



function enableSaveButton() {
  const saveButton = document.querySelector('#update_produit_form button[type="submit"]');
  if (saveButton) {
      saveButton.disabled = false;
  }
}

// Ensure the enableSaveButton function is available globally if it's not already
window.enableSaveButton = enableSaveButton;


document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('update_produit_form');
  const saveButton = form.querySelector('button[type="submit"]');
  
  // Disable the 'Save' button by default
  saveButton.disabled = true;
  
  // Function to enable the 'Save' button when a change is detected
  const enableSaveButton = () => {
    saveButton.disabled = false;
  };
  
  // Add event listeners for the 'stockNumber' and 'stockNumberAlert' fields
  const stockNumber = document.getElementById('stockNumber');
  const stockNumberAlert = document.getElementById('stockNumberAlert');
  
  stockNumber.addEventListener('input', enableSaveButton);
  stockNumberAlert.addEventListener('input', enableSaveButton);
  
  // Add event listeners for any other form fields if necessary
  form.querySelectorAll('input, select, textarea').forEach(input => {
    input.addEventListener('input', enableSaveButton);
  });

  // For the radio buttons and checkboxes, use the 'change' event instead of 'input'
  form.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
      input.addEventListener('change', enableSaveButton);
  });
  
  // Close modal functionality
  var modal = document.getElementById('myModal');
  var span = document.getElementsByClassName('close')[0];
  var btnAnnuler = document.getElementById('btnAnnuler');

  span.onclick = function() {
    modal.style.display = "none";
  };

  btnAnnuler.addEventListener('click', function() {
    modal.style.display = "none";
  });

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  // Open modal functionality - ensure you have a button with id="myBtn" to trigger the modal
  var btnSupprimer = document.getElementById('myBtn');
  btnSupprimer.onclick = function() {
    modal.style.display = "block";
  };

});

  






  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('creation_produit_form');
    const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      let isFormValid = true;
  
      // Supprime les messages d'erreur existants
      form.querySelectorAll('.error-message').forEach(message => {
        message.remove();
      });
  
      // Vérifie chaque champ requis
      requiredFields.forEach(input => {
        if (!input.value.trim()) {
          displayError(input, "Ce champ est requis.");
          isFormValid = false;
        }
      });
  
      // Si le formulaire est valide, soumettre le formulaire
      if (isFormValid) {
        form.submit();
        
      }
    });
  });
  
  function displayError(input, message) {
    const errorSpan = document.createElement('span');
    errorSpan.classList.add('error-message');
    errorSpan.textContent = message;
    input.classList.add('error');
    input.parentNode.insertBefore(errorSpan, input.nextSibling);
  }
  





// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn"); // Make sure this button exists in your HTML

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks on cancel button, close the modal
document.getElementById('btnAnnuler').addEventListener('click', function() {
  modal.style.display = "none";
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
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
