function add_retire_quantite(change, quantite_max, id_produit) {
    var quantiteElement = document.getElementById("quantite_article"+id_produit);
    var quantiteActuelle = parseInt(quantiteElement.value); // Convertit la valeur en nombre
    console.log(quantiteActuelle);
    var nouvelleQuantite = quantiteActuelle + change;
    console.log(nouvelleQuantite);
    if (nouvelleQuantite < 0) {
        nouvelleQuantite = 0;
    } else if (nouvelleQuantite > quantite_max) {
        nouvelleQuantite = quantite_max;
    }
    console.log(nouvelleQuantite);
    quantiteElement.value = nouvelleQuantite; // Met à jour la valeur dans l'élément du DOM
}
 