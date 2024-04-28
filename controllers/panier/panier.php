<?php
function panier(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    require ('models/panier/panier.php');
    require ('models/produit/produit.php');
    require ('models/produit/page_produit.php');
    require_once('lib/database/Database.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_prod"])) {
        if(!empty($_POST["date_retrait"])){
            $date_retrait = $_POST["date_retrait"];
            $id_prod = $_POST["id_prod"];
            $id_commande = Commande($date_retrait);
            $produits = Recupere_produit($id_prod);
            foreach($produits as $produit){
                supprime_produit($produit["id_produit"]);
                ajouter_produit($produit["id_produit"],$id_commande,$produit["quantite_article"]);
            }
        };
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_produit"])) {
        $id_produit = $_POST["id_produit"];
        if (isset($_POST['quantite'.$id_produit])) {
            $quantite = $_POST['quantite'.$id_produit];
        }
        $id_commande = $_POST["id_commande"];
        update_quantite($id_produit, $quantite, $id_commande);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["produit_a_supprimer"])) {
        $id_produit = $_POST["produit_a_supprimer"];
        supprime_produit($id_produit);
        $redirect = true;
    }
    
    require ('lib/components/header.php');
    require ('views/panier/panier.php');
    require_once ('lib/components/footer.php');
}
?>