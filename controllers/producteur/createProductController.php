<?php

function create_product(){

    require_once('lib/database/Database.php');
    require 'models/producteur/productManagement.php';
    require 'models/producteur/retailManagement.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //vérification si l'utilisateur est connecté
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }

    /*

    Vérification des requêtes

    */


    // Vérifiez si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productName = isset($_POST["productName"]) ? htmlspecialchars($_POST["productName"], ENT_QUOTES, 'UTF-8') : null;
    $productImage = isset($_POST["productImage"]) ? htmlspecialchars($_POST["productImage"], ENT_QUOTES, 'UTF-8') : null;
    $productCategory = isset($_POST["productCategory"]) ? htmlspecialchars($_POST["productCategory"], ENT_QUOTES, 'UTF-8') : null;
    $productPrice = isset($_POST["productPrice"]) ? htmlspecialchars($_POST["productPrice"], ENT_QUOTES, 'UTF-8') : null;
    $productUnit = isset($_POST["productUnit"]) ? htmlspecialchars($_POST["productUnit"], ENT_QUOTES, 'UTF-8') : null;
    $productDescription = isset($_POST["productDescription"]) ? htmlspecialchars($_POST["productDescription"], ENT_QUOTES, 'UTF-8') : null;
    $stockNumber = isset($_POST["stockNumber"]) ? htmlspecialchars($_POST["stockNumber"], ENT_QUOTES, 'UTF-8') : null;
    $stockNumberAlert = isset($_POST["stockNumberAlert"]) ? htmlspecialchars($_POST["stockNumberAlert"], ENT_QUOTES, 'UTF-8') : null;


    //gère le téléchargement d'une image de produit en stockant et renommant l'image
    $productNameSanitized = strtolower(str_replace(' ', '-', $productName)); // Replace spaces with hyphens and make lowercase
    $extension = pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION); // Get the extension of the uploaded file

    // Create the new filename using the sanitized product name and the original file's extension.
    $productImageFileName = $productNameSanitized . '.' . $extension;

    // Define the target directory and the target file path.
    $target_dir = "images/produit/";
    $productImage = $target_dir . $productImageFileName;


    // Move the uploaded file from the temporary directory to your target directory with the new filename.
    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $productImage)) {
        echo "The file has been uploaded and renamed to: " . htmlspecialchars($productImageFileName);
    }

    // Assurez-vous que toutes les valeurs requises sont fournies avant d'insérer
    if ($productName && $productCategory && $productPrice && $productUnit && $productDescription) {

        insertProduct($productName, $productDescription, $productPrice, $stockNumber,$stockNumberAlert,$productUnit,$productImage,$productCategory);
        // Redirigez vers la même page pour afficher le message
        header('Location: index.php?action=inventory');
        exit();
    } 
}


    /*

    Liaison fichiers

    */

    
    
    require 'views/producteur/create_product/createProductView.php';
}