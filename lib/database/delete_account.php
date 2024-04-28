<?php
require_once("Database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    $conn = Database::getConnection();
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    } else if (isset($_GET['email'])) {
        $email = htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8');
    } else {
        header("Location: ../../index.php?action=admin_producteurs");
        exit();
    }
    $stmt = $conn->prepare("SELECT Id_compte FROM COMPTE WHERE Adresse_email_compte = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $id = $stmt->fetch(PDO::FETCH_ASSOC)['Id_compte'];
    //AFFILIER
    $stmt = $conn->prepare("DELETE FROM AFFILIER WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //PRODUIT
    $stmt = $conn->prepare("SELECT * FROM PRODUIT WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($produits as $id_produit) {
        $stmt = $conn->prepare("DELETE FROM AJOUTER WHERE Id_produit = :id");
        $stmt->bindParam(':id', $id_produit);
        $stmt->execute();
    }
    foreach ($produits as $id_produit) {
        $stmt = $conn->prepare("DELETE FROM FAVORIS WHERE Id_produit = :id");
        $stmt->bindParam(':id', $id_produit);
        $stmt->execute();
    }
    foreach ($produits as $id_produit) {
        $stmt = $conn->prepare("DELETE FROM AVIS WHERE Id_produit = :id");
        $stmt->bindParam(':id', $id_produit);
        $stmt->execute();
    }
    $stmt = $conn->prepare("DELETE FROM PRODUIT WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //AJOUTER
    $commandes = $conn->prepare("SELECT Id_commande FROM COMMANDE WHERE Id_compte = :id");
    $commandes->bindParam(':id', $id);
    $commandes->execute();
    $commandes = $commandes->fetchAll(PDO::FETCH_COLUMN);
    foreach ($commandes as $id_commande) {
        $stmt = $conn->prepare("DELETE FROM AJOUTER WHERE Id_commande = :id");
        $stmt->bindParam(':id', $id_commande);
        $stmt->execute();
    }
    //COMMANDE
    $stmt = $conn->prepare("DELETE FROM COMMANDE WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //AVIS
    $stmt = $conn->prepare("DELETE FROM AVIS WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //FAVORIS
    $stmt = $conn->prepare("DELETE FROM FAVORIS WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //MESSAGE
    $stmt = $conn->prepare("DELETE FROM MESSAGE WHERE Id_compte = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    //COMPTE
    $stmt = $conn->prepare("DELETE FROM COMPTE WHERE Adresse_email_compte = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($email === $_SESSION['email']) {
        require_once("../account/logout.php");
    } else {
        header("Location: ../../index.php?action=admin_producteurs");
    }
    exit();
}
