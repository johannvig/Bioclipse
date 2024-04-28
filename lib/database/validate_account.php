<?php
require_once("Database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_instance = Database::getInstance();

    // Get the PDO connection from the instance
    $pdo = $db_instance->getConnection();
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $stmt = $conn->prepare("UPDATE COMPTE SET Statut_compte = 'Validé' WHERE Adresse_email_compte = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    header("Location: ../../index.php?action=admin_producteurs");
    exit();
}
