// Récupère la pop-up
var modal = document.getElementById("myModal");

// Récupère le bouton qui ouvre la pop-up
var btn = document.getElementById("donne_avis");

// Récupère l'élément <span> qui ferme la pop-up
var span = document.getElementsByClassName("close")[0];

// Quand l'utilisateur clique sur le bouton, ouvre la pop-up 
btn.onclick = function() {
  modal.style.display = "block";
}

// Quand l'utilisateur clique sur <span> (x), ferme la pop-up
span.onclick = function() {
  modal.style.display = "none";
}

// Quand l'utilisateur clique n'importe où en dehors de la pop-up, la ferme
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}