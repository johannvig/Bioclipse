<?php
function produit(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // ouvre la session si elle n'est pas déjà ouverte
    }

    require ('models/produit/produit.php');
    require ('models/produit/page_produit.php');
    require ('models/message/message.php');
    require_once('lib/database/Database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_panier"])) {
        if (!isset($_SESSION["Id_compte"])) {
            header("Location: index.php?action=login");
            exit();
        }
        if($_SESSION["role"]!="Client"){
            header("Location: index.php?action=accueil");
            exit();
        }
        $quantite = isset($_POST['quantite']) ? (int)$_POST['quantite'] : 0;
        add_retire_quantite($_GET["id_produit"],$quantite);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["converser"])){
        if (!isset($_SESSION["Id_compte"])) {
            header("Location: index.php?action=login");
            exit();
        }
        $id_produit = $_GET["id_produit"];
        $id_compte = $_SESSION["Id_compte"];
        $id_conversation = check_conversation($id_produit, $id_compte);
        if ($id_conversation) {
            header("Location: index.php?action=messagerie&correspondant=".$id_conversation);
            exit();
        } else {
            $vendeurs = qui_a_produit($id_produit);
            foreach($vendeurs as $vendeur){
                $id_vendeur = $vendeur["id_compte"];
            }                            
            add_contact($id_compte,$id_vendeur );
            header("Location: index.php?action=messagerie&correspondant=".check_conversation($id_produit, $id_compte));
            exit();
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["favoris"])) {
        if (!isset($_SESSION["Id_compte"])) {
            header("Location: index.php?action=login");
            exit();
        }
        $isFavorite = checkIfFavorite($_GET["id_produit"]);
        if(!$isFavorite){
            add_favoris($_GET["id_produit"]);
        }
        else{
            delete_fav($_GET["id_produit"]);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_avis"])) {
        if (!isset($_SESSION["Id_compte"])) {
            echo "<script type='text/javascript'>alert('Vous n'êtes pas connecter');</script>";
        }else{
            $id_produit = $_GET["id_produit"];
            $note_avis = $_POST["rating"];
            $commentaire_avis = htmlspecialchars($_POST["commentaire_avis"], ENT_QUOTES, 'UTF-8'); 
            add_avis($id_produit, $note_avis, $commentaire_avis);
        }
    }
    require_once ('lib/components/header.php');
    require_once ('views/produit/produit.php');
}?>