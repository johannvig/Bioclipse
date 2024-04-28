<?php

function modify_product(){

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

    


    $productId = isset($_GET["id_produit"]) ? htmlspecialchars($_GET["id_produit"], ENT_QUOTES, 'UTF-8') : null;


    //modification du produit
    if (isset($_POST['submitForm'])) {
        $productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
        $productName = htmlspecialchars($productName, ENT_QUOTES, 'UTF-8');

        $productCategory = filter_input(INPUT_POST, 'productCategory', FILTER_SANITIZE_STRING);
        $productCategory = htmlspecialchars($productCategory, ENT_QUOTES, 'UTF-8');

        $productPrice = filter_input(INPUT_POST, 'productPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $productUnit = filter_input(INPUT_POST, 'productUnit', FILTER_SANITIZE_STRING);
        $productUnit = htmlspecialchars($productUnit, ENT_QUOTES, 'UTF-8');

        $productDescription = filter_input(INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING);
        $productDescription = htmlspecialchars($productDescription, ENT_QUOTES, 'UTF-8');

        $stockNumber = filter_input(INPUT_POST, 'stockNumber', FILTER_SANITIZE_NUMBER_INT);
        $stockNumberAlert = filter_input(INPUT_POST, 'stockNumberAlert', FILTER_SANITIZE_NUMBER_INT);

        
        //gère le téléchargement d'une image de produit en stockant et renommant l'image
        $productNameSanitized = strtolower(str_replace(' ', '-', $productId)); // Replace spaces with hyphens and make lowercase
        $extension = pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION); // Get the extension of the uploaded file

        // Create the new filename using the sanitized product name and the original file's extension.
        $productImageFileName = $productNameSanitized . '.' . $extension;

        // Define the target directory and the target file path.
        $target_dir = "images/produit/";
        if ($extension != "")
            $productImage = $target_dir . $productImageFileName;
        else 
            $productImage = null;


        // Move the uploaded file from the temporary directory to your target directory with the new filename.
        if ($extension != "")
            move_uploaded_file(htmlspecialchars($_FILES['productImage']['tmp_name'], ENT_QUOTES, 'UTF-8'), $productImage);

        updateProductInfo($productName, $productDescription, $productPrice, $stockNumber, $stockNumberAlert, $productUnit, $productImage, $productCategory, $productId);

        header('Location: index.php?action=inventory');
        exit();
    }

    if (isset($_POST['deleteProduct'])) {
        deleteProduct($productId);
        header('Location: index.php?action=inventory');
        exit();
    }

    /*

    Liaison fichiers

    */


    
    require 'views/producteur/modifyProduct.php';

}
