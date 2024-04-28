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

document.getElementById('nom_producteur').addEventListener('change', function() {
    console.log('Changement de producteur');
    document.getElementById('producteurForm').submit();
});


function redirectToPage(select) {
    var value = select.value;
    if (value === "page_producteurs") {
        window.location.href = "index.php?action=all_prod"; 
    } else if (value === "page_produits") {
        window.location.href = "index.php?action=produits"; 
    }
}



function submitFormWithAllParameters() {
    var searchForm = document.createElement('form');
    searchForm.method = "get";
    searchForm.action = window.location.pathname;

    // Récupération des valeurs de chaque champ
    var info_action = document.getElementById('action') ? document.getElementById('action').value : 'all_prod';
    var villeProducteur = document.getElementById('ville_producteur') ? document.getElementById('ville_producteur').value : '';
    var nomProducteur = document.getElementById('nom_producteur') ? document.getElementById('nom_producteur').value : '';
    var typeProducteur = document.getElementById('type_producteur') ? document.getElementById('type_producteur').value : '';

    // Ajout des champs de recherche sous forme de champs cachés
    addHiddenField(searchForm, 'action', info_action);
    addHiddenField(searchForm, 'ville_producteur', villeProducteur);
    addHiddenField(searchForm, 'nom_producteur', nomProducteur);
    addHiddenField(searchForm, 'type_producteur', typeProducteur);

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
document.getElementById('search_bar').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});

document.getElementById('producteurForm').addEventListener('submit', function(event) {
    event.preventDefault();
    submitFormWithAllParameters();
});
