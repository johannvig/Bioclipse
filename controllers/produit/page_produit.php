<?php
function page_produit(){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    /*

    Vérification des requêtes

    */

    $searchQuery = filter_input(INPUT_GET, 'ville_producteur', FILTER_SANITIZE_STRING);
    $searchQuery = htmlspecialchars($searchQuery ?? '', ENT_QUOTES, 'UTF-8');
        
    $selector = filter_input(INPUT_GET, 'type_produit', FILTER_SANITIZE_STRING);
    $selector = htmlspecialchars($selector ?? '', ENT_QUOTES, 'UTF-8');

    $nom_produit = filter_input(INPUT_GET, 'nom_produit', FILTER_SANITIZE_STRING);
    $nom_produit = htmlspecialchars($nom_produit ?? '', ENT_QUOTES, 'UTF-8');

    $nom_producteur = filter_input(INPUT_GET, 'nom_producteur', FILTER_SANITIZE_STRING);
    $nom_producteur = htmlspecialchars($nom_producteur ?? '', ENT_QUOTES, 'UTF-8');

    $tri_produit = filter_input(INPUT_GET, 'tri_produit', FILTER_SANITIZE_STRING);
    $tri_produit = htmlspecialchars($tri_produit ?? '', ENT_QUOTES, 'UTF-8');

    $min_prix = filter_input(INPUT_GET, 'min_prix', FILTER_SANITIZE_STRING);
    $min_prix = htmlspecialchars($min_prix ?? '', ENT_QUOTES, 'UTF-8');

    $max_prix = filter_input(INPUT_GET, 'max_prix', FILTER_SANITIZE_STRING);
    $max_prix = htmlspecialchars($max_prix ?? '', ENT_QUOTES, 'UTF-8');



    /*

    Liaison fichiers

    */
    
    require ('models/produit/page_produit.php');
    require_once('lib/database/Database.php');
    require_once ('lib/components/header.php');
    require_once ('views/produit/page_produit.php');
    require_once ('lib/components/footer.php');
}
?>