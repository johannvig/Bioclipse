console.log('Chargement du script page_produit.js');
// Get the filter button and filter menu elements
var filterButton = document.getElementById('filterMenuButton');
var filterMenu = document.getElementById('filterMenu');

// Add click event listener to the filter button
filterButton.addEventListener('click', function() {
    // Toggle the filter menu visibility
    if (filterMenu.classList.contains('hidden')) {
        filterMenu.classList.remove('hidden');
        filterMenu.classList.add('visible');
    } else {
        filterMenu.classList.remove('visible');
        filterMenu.classList.add('hidden');
    }
});

document.getElementById('nom_produit').addEventListener('change', function() {
    console.log('Changement de producteur');
    document.getElementById('producteurForm').submit();
});





function redirectToPage(select) {
    var value = select.value;
    if (value === "") {
        window.location.href = "index.php?action=produits"; 
    } else if (value === "page_producteurs") {
        window.location.href = "index.php?action=all_prod"; 
    }
}




function submitFormWithAllParameters() {
    // Récupération des valeurs de chaque champ
    var info_action = document.getElementById('action') ? document.getElementById('action').value : 'produits';
    var nomProduit = document.getElementById('nom_produit') ? document.getElementById('nom_produit').value : '';
    var nomProducteur = document.getElementById('nom_producteur') ? document.getElementById('nom_producteur').value : '';
    var minPrix = document.getElementById('min_prix') ? document.getElementById('min_prix').value : '';
    var maxPrix = document.getElementById('max_prix') ? document.getElementById('max_prix').value : '';
    var distanceProduit = document.getElementById('distance_produit') ? document.getElementById('distance_produit').value : '';
    var typeProduit = document.getElementById('type_produit') ? document.getElementById('type_produit').value : '';
    var villeProducteur = document.getElementById('ville_producteur') ? document.getElementById('ville_producteur').value : '';
    var triProduit = document.getElementById('tri_produit') ? document.getElementById('tri_produit').value : '';

    // Création d'un formulaire et ajout des champs cachés
    var searchForm = document.createElement('form');
    searchForm.method = "get";
    searchForm.action = window.location.pathname;

    // Ajout des champs de recherche sous forme de champs cachés
    addHiddenField(searchForm, 'action', info_action);
    addHiddenField(searchForm, 'nom_produit', nomProduit);
    addHiddenField(searchForm, 'nom_producteur', nomProducteur);
    addHiddenField(searchForm, 'min_prix', minPrix);
    addHiddenField(searchForm, 'max_prix', maxPrix);
    addHiddenField(searchForm, 'distance_produit', distanceProduit);
    addHiddenField(searchForm, 'type_produit', typeProduit);
    addHiddenField(searchForm, 'ville_producteur', villeProducteur);
    addHiddenField(searchForm, 'tri_produit', triProduit);

    // Ajout du formulaire au document et soumission
    document.body.appendChild(searchForm);
    searchForm.submit();
}

// Fonction pour ajouter un champ caché au formulaire
function addHiddenField(form, name, value) {
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    form.appendChild(input);
}

// Ajout des écouteurs d'événements pour chaque formulaire
document.getElementById('search_nom_produit').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

document.getElementById('search_bar').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

document.getElementById('search_min_prix').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

document.getElementById('search_max_prix').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

document.getElementById('producteurDistanceForm').addEventListener('change', submitFormWithAllParameters);
document.getElementById('producteurForm').addEventListener('change', submitFormWithAllParameters);
document.getElementById('produitTriForm').addEventListener('change', submitFormWithAllParameters);
document.getElementById('search_bar').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

