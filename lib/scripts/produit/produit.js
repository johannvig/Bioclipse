console.log("Hello world !!!!");
function add_retire_quantite(change, quantite_max) {
    var quantiteElement = document.getElementById("quantite_article");
    var quantiteActuelle = parseInt(quantiteElement.value); // Convertit la valeur en nombre

    var nouvelleQuantite = quantiteActuelle + change;

    if (nouvelleQuantite < 0) {
        nouvelleQuantite = 0;
    } else if (nouvelleQuantite > quantite_max) {
        nouvelleQuantite = quantite_max;
    }

    quantiteElement.value = nouvelleQuantite; // Met à jour la valeur dans l'élément du DOM
}









// Récupère la pop-up
var modal = document.getElementById("createProductModal");

// Récupère le bouton qui ouvre la pop-up
var btn = document.getElementById("btnCreateAvis");

// Récupère le bouton "Annuler"
var btnCancel = document.getElementById("btnAnnuler");

// Ouvre la pop-up quand l'utilisateur clique sur le bouton
btn.onclick = function() {
  modal.style.display = "block";
}

// Ferme la pop-up quand l'utilisateur clique sur "Annuler"
btnCancel.onclick = function() {
  modal.style.display = "none";
}

// Ferme la pop-up quand l'utilisateur clique en dehors de celle-ci
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}




// étoile 

const ratingStars = document.querySelectorAll('.rating input');

ratingStars.forEach(star => {
    star.addEventListener('change', function() {
        console.log('Note sélectionnée :', this.value);
        // Vous pouvez ajouter ici le code pour envoyer la note à votre serveur
    });
});

// Slider
console.log("Hello world !!!!");




// ... Votre code existant ...

document.addEventListener('DOMContentLoaded', function() {
  var container = document.getElementById('containeur_produit');
  console.log(container.offsetWidth); // largeur + bordures + padding (si border-box)
  console.log(container.clientWidth); // largeur + padding (pas de bordures, pas de scrollbar)
  console.log(window.getComputedStyle(container).width); // largeur définie en CSS
// Mesurer la largeur y compris les marges
console.log(container.getBoundingClientRect().width);

  let autoSlideInterval;
  let animationFrameId; // Variable pour stocker l'ID de la requête d'animation
  const ANIMATION_DURATION = 1000; // Durée de l'animation en millisecondes

  function animateScroll(targetScroll) {
      if (animationFrameId) {
          cancelAnimationFrame(animationFrameId); // Annuler l'animation en cours si elle existe
      }
      clearInterval(autoSlideInterval); // Arrêter le défilement automatique pendant l'animation
      let start = container.scrollLeft,
          change = targetScroll - start,
          startTime = null;
      
      function animateScrollStep(timestamp) {
          if (startTime === null) startTime = timestamp;
          const timeElapsed = timestamp - startTime;
          const progress = Math.min(timeElapsed / ANIMATION_DURATION, 1); // S'assurer que le progrès ne dépasse pas 1
          
          container.scrollLeft = start + change * Math.easeInOutQuad(progress);

          if (timeElapsed < ANIMATION_DURATION) {
              animationFrameId = requestAnimationFrame(animateScrollStep);
          } else {
              autoSlideInterval = setInterval(slideRight, 5000); // Redémarrer le défilement automatique après l'animation
          }
      }
      animationFrameId = requestAnimationFrame(animateScrollStep);
  }

  Math.easeInOutQuad = function (t) {
      return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
  };

  function slideLeft() {
    let targetScroll = container.scrollLeft - container.offsetWidth;

    if (targetScroll <= -container.offsetWidth) {
        // Si targetScroll est égal ou inférieur à -container.offsetWidth, aller à l'autre bout
        targetScroll = container.scrollWidth - container.offsetWidth;
    } else if (targetScroll < 0) {
        // Si targetScroll est négatif mais supérieur à -container.offsetWidth, remettre à 0
        targetScroll = 0;
    }

    console.log("Défilement cible après ajustement : ", targetScroll);
    animateScroll(targetScroll);
  }


  function slideRight() {
      let targetScroll = container.scrollLeft + container.offsetWidth; // ajustement pour les marges
      console.log(targetScroll);
      if (targetScroll >= container.scrollWidth) {
          targetScroll = 0;
      }
      animateScroll(targetScroll);
  }

  // Boutons flèches
  document.getElementById('slide-left').addEventListener('click', slideLeft);
  document.getElementById('slide-right').addEventListener('click', slideRight);

  // Défilement automatique
  autoSlideInterval = setInterval(slideRight, 10000); // Le slider bougera toutes les 10 secondes
});






function updateButtonState() {
    var quantite = parseInt(document.getElementById('quantite_article').value);
    var btnAjouter = document.getElementById('submit_panier');

    if (quantite <= 0) {
        btnAjouter.disabled = true;
        btnAjouter.classList.add('disabled');
    } else {
        btnAjouter.disabled = false;
        btnAjouter.classList.remove('disabled');
    }
}

// Appeler cette fonction au chargement de la page et chaque fois que la quantité change
document.addEventListener('DOMContentLoaded', updateButtonState);
document.getElementById('btn_moins').addEventListener('click', updateButtonState);
document.getElementById('btn_plus').addEventListener('click', updateButtonState);
