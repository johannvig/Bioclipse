<?php
require_once("Database.php");
require_once("../utils.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $user = array();
    $user['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $user['surname'] = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
    $user['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $user['adress'] = htmlspecialchars($_POST['adress'], ENT_QUOTES, 'UTF-8');
    $user['postal_code'] = htmlspecialchars($_POST['postal_code'], ENT_QUOTES, 'UTF-8');
    $user['city'] = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $user['phone'] = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
    $user['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $user['password_confirmation'] = htmlspecialchars($_POST['password_confirmation'], ENT_QUOTES, 'UTF-8');
    $user['image'] = "images/profil_pic/profil.png";
    if (validateParams($user) == false) {
        $error = "empty_fields";
        header("Location: ../../index.php?action=registration&error=$error");
        exit();
    }
    $user['producer_name'] = isset($_POST['producer_name']) ? htmlspecialchars($_POST['producer_name'], ENT_QUOTES, 'UTF-8') : null;
    $user['siret_number'] = isset($_POST['siret_number']) ? htmlspecialchars($_POST['siret_number'], ENT_QUOTES, 'UTF-8') : null;
    $user['id_category'] = isset($_POST['category']) ? htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8') : null;
    $user['is_producer'] = isset($_POST['is_producer']) ? htmlspecialchars($_POST['is_producer'], ENT_QUOTES, 'UTF-8') : false;
    if ($user['is_producer'] == true) {
        $user['id_role'] = 2;
    } else {
        $user['id_role'] = 1;
    }
    if ($user['password'] != $user['password_confirmation']) {
        $error = "passwords_dont_match";
        header("Location: ../../index.php?action=registration&error=$error");
        exit();
    }
    if (verifyEmail($user['email'])) {
        $error = "email_already_used";
        header("Location: ../../index.php?action=registration&error=$error");
        exit();
    }
    if (verifyPhone($user['phone'])) {
        $error = "phone_already_used";
        header("Location: ../../index.php?action=registration&error=$error");
        exit();
    }
    $stmt = $pdo->prepare("INSERT INTO COMPTE (Nom_compte,Prenom_compte,Adresse_email_compte,
    Num_tel_compte,Mot_de_passe_compte,Adresse_postal_compte,Ville_compte,Code_postal_compte,Image_compte,Nom_producteur,Num_siret_producteur,Id_role,Id_categorie,Statut_compte)
    VALUES(:name,:surname,:email,:phone,:password,:adress,:city,:postal_code,:image,:producer_name,:siret_number,:id_role,:id_category,:statut)");


    $stmt->bindParam(':name', $user['name']);
    $stmt->bindParam(':surname', $user['surname']);
    $stmt->bindParam(':email', $user['email']);
    $stmt->bindParam(':phone', $user['phone']);
    $password = hashPassword($user['password']);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':adress', $user['adress']);
    $stmt->bindParam(':city', $user['city']);
    $stmt->bindParam(':postal_code', $user['postal_code']);
    $stmt->bindParam(':image', $user['image']);
    $stmt->bindParam(':id_role', $user['id_role']);
    $stmt->bindParam(':producer_name', $user['producer_name']);
    $stmt->bindParam(':siret_number', $user['siret_number']);
    $stmt->bindParam(':id_category', $user['id_category']);
    if ($user['is_producer'] == true) {
        $statut = "En attente";
    } else {
        $statut = "Validé";
    }
    $stmt->bindParam(':statut', $statut);
    $stmt->execute();
    if ($user['is_producer'] == false) {
        $id_compte = $pdo->lastInsertId();
        $stmt = $pdo->prepare ("INSERT INTO COMMANDE (Date_commande, Date_retrait_commande, Id_compte, Statut_commande) VALUES (:date_commande,:date_retrait,:id_compte,:statut_commande)");
        $date_commande = date("Y-m-d");
        $date_retrait = date("Y-m-d");
        $statut_commande = "en création";
        $stmt->bindParam(':date_commande', $date_commande);
        $stmt->bindParam(':date_retrait', $date_retrait);
        $stmt->bindParam(':id_compte', $id_compte);
        $stmt->bindParam(':statut_commande', $statut_commande);
        $stmt->execute();
    }
    require_once("connect.php");
}

function validateParams($params)
{
    foreach ($params as $param) {
        if (empty($param)) {
            return false;
        }
    }
    return true;
}

function verifyEmail($email)
{
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
    $stmt = $pdo->prepare("SELECT * FROM COMPTE WHERE Adresse_email_compte = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    }
    return false;
}

function verifyPhone($phone)
{
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
    $stmt = $pdo->prepare("SELECT * FROM COMPTE WHERE Num_tel_compte = :phone");
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    }
    return false;
}
