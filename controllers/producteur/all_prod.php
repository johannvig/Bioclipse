<?php

function all_prod(){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    /*

    Vérification des requêtes

    */

    $searchQuery = filter_input(INPUT_GET, 'ville_producteur', FILTER_SANITIZE_STRING);
    $searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8');
    
    $selector = filter_input(INPUT_GET, 'type_producteur', FILTER_SANITIZE_STRING);
    $selector = htmlspecialchars($selector, ENT_QUOTES, 'UTF-8');

    $nom_producteur = filter_input(INPUT_GET, 'nom_producteur', FILTER_SANITIZE_STRING);
    $nom_producteur = htmlspecialchars($nom_producteur ?? '', ENT_QUOTES, 'UTF-8');

    /*

    Liaison fichiers

    */

    require ('models/produit/page_produit.php');
    require_once('lib/database/Database.php');
    require_once ('lib/components/header.php');
    require_once ('views/producteur/all_prod.php');
    require_once ('lib/components/footer.php');
}