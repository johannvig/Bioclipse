console.log("hello world");

// Récupère toutes les pop-ups de classe "modal"
var modal = document.getElementById("createProductModal");

// Récupère tous les boutons qui ouvrent une pop-up
var btns = document.querySelectorAll(".modal");

// Ajoute un gestionnaire d'événements pour chaque bouton pour ouvrir la modale correspondante
btns.forEach(function(btn) {
  btn.onclick = function() {
    // Récupère la valeur de l'attribut data-value du bouton cliqué
    var commandeId = this.getAttribute("data-value");
    console.log("Commande ID:", commandeId); // Vous pouvez l'utiliser pour afficher des données spécifiques dans la modale
    
    // Ouvre la modale
    modal.style.display = "flex";
  }
});

// Ferme la modale quand l'utilisateur clique en dehors de celle-ci
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
