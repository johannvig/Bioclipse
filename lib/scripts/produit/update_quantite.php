<?php

// Vous devrez vous connecter à la base de données ici
include 'db_connect.php'; // db_connect.php contiendrait vos informations de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données POST
    $id_produit = isset($_POST['id_produit']) ? (int) $_POST['id_produit'] : 0;
    $quantite = isset($_POST['quantite']) ? (int) $_POST['quantite'] : 0;
    
    // Assurez-vous que les valeurs sont valides
    if ($id_produit > 0 && $quantite >= 0) {
        // Mettez à jour la quantité dans la base de données
        $query = "UPDATE AJOUTER SET quantite_article = $quantite_produit FROM AJOUTER
        INNER JOIN PRODUIT ON PRODUIT.id_produit = AJOUTER.id_produit
        INNER JOIN COMMANDE ON AJOUTER.id_commande = COMMANDE.id_commande
        INNER JOIN COMPTE ON COMPTE.id_compte = COMMANDE.id_compte
        WHERE COMMANDE.statut_commande = 'en création' AND PRODUIT.id_produit = ?
        AND COMPTE.id_compte = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id_produit, $_SESSION["Id_compte"]);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Quantité mise à jour']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Données invalides']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}

?>
