<?php
require_once __DIR__ . '/../../../vendor/autoload.php'; // Assurez-vous que le chemin est correct

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../..'); // Remonte à la racine où se trouve le fichier .env
$dotenv->load();

// Maintenant, vous pouvez accéder aux variables d'environnement
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASSWORD'];

// Reste du code pour établir la connexion...

    
    // Création de l'objet PDO pour la connexion
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    
    // Définition des attributs PDO pour gérer les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
require_once("../utils.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $sql = "SELECT Id_compte, Adresse_email_compte, Nom_compte, Prenom_compte, Nom_role, Mot_de_passe_compte, Statut_compte, Image_compte,adresse_postal_compte FROM COMPTE INNER JOIN ROLE ON ROLE.Id_role = COMPTE.Id_role WHERE Adresse_email_compte = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', htmlspecialchars($_POST["email"]));
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $line = $stmt->fetch(PDO::FETCH_ASSOC);
        if (checkPassword(htmlspecialchars($_POST["password"]), $line["Mot_de_passe_compte"])) {
            if ($line["Statut_compte"] == 'Validé') {
                $_SESSION["Id_compte"] = $line["Id_compte"];
                $_SESSION["email"] = $line["Adresse_email_compte"];
                $_SESSION["name"] = $line["Nom_compte"];
                $_SESSION["surname"] = $line["Prenom_compte"];
                $_SESSION["role"] = $line["Nom_role"];
                $_SESSION["image"] = $line["Image_compte"];
                $_SESSION["adresse"] = $line["adresse_postal_compte"];
                $_SESSION["adresse_postal"] = $line["Code_postal_compte"];
                $_SESSION["adresse_ville"] = $line["Ville_compte"];
                $stmt->closeCursor();
                header("Location: ../../index.php?action=accueil");
                exit();
            } else {
                $error = "not_validated";
            }
        } else {
            $error = "incorrect_credentials";
        }
    } else {
        $error = "incorrect_credentials";
    }
    header("Location: ../../index.php?action=login&error=$error");
}
